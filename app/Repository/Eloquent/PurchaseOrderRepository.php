<?php

namespace App\Repository\Eloquent;

use App\Http\Enums\CompanyType;
use App\Http\Enums\PurchaseOrderStatus;
use App\Models\PurchaseOrder;
use App\Repository\PurchaseOrderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderRepository extends Repository implements PurchaseOrderRepositoryInterface
{
    protected Model $model;

    public function __construct(PurchaseOrder $model)
    {
        parent::__construct($model);
    }

    public function getFiltered(
        ?string $keyword = null,
        ?string $sort = 'desc',
        ?array $statuses = null,
        ?array $fields = null,
        ?string $published_from = null,
        ?string $published_to = null,
        bool $mine = false,
        int $perPage = 9,
    ) {
        return $this->model::query()
            ->where(function ($query) use ($mine) {
                if (!$mine)
                    $query->where('status', '!=', PurchaseOrderStatus::UNDER_REVIEW->value);
            })
            ->when($mine && auth('api')->check(), function ($query) {
                if (auth('api')->user()->company?->type == CompanyType::BUYER->value) {
                    $query->where('company_id', auth('api')->user()->company_id);
                }

                if (auth('api')->user()->company?->type == CompanyType::SUPPLIER->value) {
                    $query->whereHas('offers', function ($query) {
                        $query->where('company_id', auth('api')->user()->company_id);
                    });
                }
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('description', 'like', '%' . $keyword . '%');
                });
            })
            ->when($statuses, function ($query) use ($statuses) {
                $query->whereIn('status', $statuses);
            })
            ->when($fields, function ($query) use ($fields) {
                $query->whereHas('fields', function ($query) use ($fields) {
                    $query->whereIn('fields.id', array_values($fields));
                });
            })
            ->when($published_from && $published_to, function ($query) use ($published_from, $published_to) {
                $query->whereBetween('created_at', [$published_from, $published_to]);
            })
            ->orderBy('updated_at', $sort)
            ->paginate($perPage);
    }

    public function getMyOrder($referenceId)
    {
        return $this->model::query()
            ->where('reference_id', $referenceId)
            ->where('company_id', auth('api')->user()->company_id)
            ->first();
    }

    public function isMyOrder($referenceId)
    {
        return $this->model::query()
            ->where('reference_id', $referenceId)
            ->where('company_id', auth('api')->user()->company_id)
            ->where('status', '!=', PurchaseOrderStatus::UNDER_REVIEW->value)
            ->exists();
    }

    public function approve($referenceId)
    {
        return $this->model::query()->where('reference_id', $referenceId)->update(['status' => PurchaseOrderStatus::APPROVED->value, 'closes_at' => Carbon::now()]);
    }

    public function delay($referenceId, $delayDate)
    {
        return $this->model::query()->where('reference_id', $referenceId)->update([
            'closes_at' => $delayDate,
        ]);
    }

    public function getLatest()
    {
        return $this->model::query()
            ->where('status', '!=', PurchaseOrderStatus::UNDER_REVIEW->value)
            ->latest()
            ->limit(6)
            ->get();
    }

    public function settleAvailableOrders()
    {
        return $this->model::query()
            ->where('status', PurchaseOrderStatus::AVAILABLE->value)
            ->where('closes_at', '<=', Carbon::now())
            ->update([
                'status' => PurchaseOrderStatus::EXPIRED->value,
            ]);
    }

    public function getlatestItem()
    {
        return $this->model::query()->latest()->first();
    }
}
