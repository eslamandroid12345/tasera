<?php

namespace App\Repository\Eloquent;

use App\Models\PurchaseOrderInquiry;
use App\Repository\PurchaseOrderInquiryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderInquiryRepository extends Repository implements PurchaseOrderInquiryRepositoryInterface
{
    protected Model $model;

    public function __construct(PurchaseOrderInquiry $model)
    {
        parent::__construct($model);
    }

    public function isRepliable($inquiryId)
    {
        return $this->model::query()
            ->whereNull('parent_id')
            ->whereHas('purchaseOrder', function ($query) {
                $query->where('user_id', auth('api')->id());
            })
            ->exists();
    }

    public function getNotPublished()
    {
        return $this->model::query()->whereNull('parent_id')->where('is_published', false)->orderByDesc('id')->paginate(20);
    }
}
