<?php

namespace App\Repository\Eloquent;

use App\Models\PurchaseOrderDemandUnit;
use App\Repository\PurchaseOrderDemandUnitRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDemandUnitRepository extends Repository implements PurchaseOrderDemandUnitRepositoryInterface
{
    protected Model $model;

    public function __construct(PurchaseOrderDemandUnit $model)
    {
        parent::__construct($model);
    }

    public function deleteByPurchaseOrder($purchaseOrderId)
    {
        $demandUnits = $this->get('purchase_order_id', $purchaseOrderId, ['attachment']);
        foreach ($demandUnits as $demandUnit) {
            if ($demandUnit->attachment !== null) {
                $this->deleteFile($demandUnit->attachment);
            }
        }

        return $this->model::query()->where('purchase_order_id', $purchaseOrderId)->delete();
    }
}
