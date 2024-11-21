<?php

namespace App\Repository\Eloquent;

use App\Models\PurchaseOrderDemandUnitType;
use App\Repository\PurchaseOrderDemandUnitTypeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDemandUnitTypeRepository extends Repository implements PurchaseOrderDemandUnitTypeRepositoryInterface
{
    protected Model $model;

    public function __construct(PurchaseOrderDemandUnitType $model)
    {
        parent::__construct($model);
    }
}
