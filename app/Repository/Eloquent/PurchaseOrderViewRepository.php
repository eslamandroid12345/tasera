<?php

namespace App\Repository\Eloquent;

use App\Models\PurchaseOrderView;
use App\Repository\PurchaseOrderViewRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderViewRepository extends Repository implements PurchaseOrderViewRepositoryInterface
{
    protected Model $model;

    public function __construct(PurchaseOrderView $model)
    {
        parent::__construct($model);
    }

    public function increment($purchaseOrderId)
    {
        return $this->model::query()->firstOrCreate([
            'company_id' => auth('api')->user()?->company_id,
            'purchase_order_id' => $purchaseOrderId,
        ]);
    }
}
