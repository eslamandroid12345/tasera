<?php

namespace App\Repository\Eloquent;

use App\Models\FieldPurchaseOrder;
use App\Repository\FieldPurchaseOrderRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FieldPurchaseOrderRepository extends Repository implements FieldPurchaseOrderRepositoryInterface
{
    protected Model $model;

    public function __construct(FieldPurchaseOrder $model)
    {
        parent::__construct($model);
    }

    public function deleteByPurchaseOrder($purchaseOrderId)
    {
        return $this->model::query()->where('purchase_order_id', $purchaseOrderId)->delete();
    }
}
