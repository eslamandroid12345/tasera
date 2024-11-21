<?php

namespace App\Repository\Eloquent;

use App\Http\Enums\CompanyType;
use App\Models\PurchaseOrderOffer;
use App\Repository\PurchaseOrderOfferRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderOfferRepository extends Repository implements PurchaseOrderOfferRepositoryInterface
{
    protected Model $model;

    public function __construct(PurchaseOrderOffer $model)
    {
        parent::__construct($model);
    }

    public function ensureOtherOffersNotApproved($purchaseOrderId, $approvedOfferId)
    {
        return $this->model::query()
            ->where('purchase_order_id', $purchaseOrderId)
            ->where('id', '!=', $approvedOfferId)
            ->update(['is_approved' => false]);
    }

    public function approve($referenceId)
    {
        $offer = $this->first('reference_id', $referenceId);
        return $offer->update(['is_approved' => true]);
        // return $this->model::query()->where('reference_id', $referenceId)->update(['is_approved' => true]);
    }

    public function getFiltered(
        ?string $keyword = null,
        ?string $sort = 'desc',
        ?array $statuses = null,
        ?array $fields = null,
        ?string $published_from = null,
        ?string $published_to = null,
        bool $mine = false
    ) {
        return $this->model::query()
            ->where(function ($query) use ($mine) {
                $query->when($mine && auth('api')->check(), function ($query) {
                    $query->where('company_id', auth('api')->user()->company_id);
                });
            })
            ->whereHas('purchaseOrder', function ($query) use ($keyword, $sort, $statuses, $fields, $published_from, $published_to) {
//                $query->when($mine && auth('api')->check(), function ($query) {
//                    if (auth('api')->user()->company?->type == CompanyType::BUYER->value) {
//                        $query->where('company_id', auth('api')->user()->company_id);
//                    }
//
//                    if (auth('api')->user()->company->type == CompanyType::SUPPLIER->value) {
//                        $query->whereHas('offers', function ($query) {
//                            $query->where('company_id', auth('api')->user()->company_id);
//                        });
//                    }
//                });

                $query->when($keyword, function ($query) use ($keyword) {
                    $query->where(function ($query) use ($keyword) {
                        $query->where('title', 'like', '%' . $keyword . '%')
                            ->orWhere('description', 'like', '%' . $keyword . '%');
                    });
                });

                $query->when($statuses, function ($query) use ($statuses) {
                    $query->whereIn('status', $statuses);
                });

                $query->when($fields, function ($query) use ($fields) {
                    $query->whereHas('fields', function ($query) use ($fields) {
                        $query->whereIn('fields.id', array_values($fields));
                    });
                });

                $query->when($published_from && $published_to, function ($query) use ($published_from, $published_to) {
                    $query->whereBetween('created_at', [$published_from, $published_to]);
                });
            })
            ->orderBy('id', $sort ?? 'desc')
            ->paginate(9);
    }

    public function getNotPublished()
    {
        return $this->model::query()->where('is_published', false)->orderByDesc('id')->paginate(20);
    }
}
