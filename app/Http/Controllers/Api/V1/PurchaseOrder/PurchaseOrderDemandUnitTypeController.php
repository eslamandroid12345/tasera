<?php

namespace App\Http\Controllers\Api\V1\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\PurchaseOrder\PurchaseOrderDemandUnitTypeService;
use Illuminate\Http\Request;

class PurchaseOrderDemandUnitTypeController extends Controller
{
    public function __construct(
        private readonly PurchaseOrderDemandUnitTypeService $purchaseOrderDemandUnit,
    )
    {
    }

    public function getInfo()
    {
        return $this->purchaseOrderDemandUnit->getInfo();
    }
}
