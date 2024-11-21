<?php

namespace App\Http\Services\Api\V1\PurchaseOrder;

use App\Http\Resources\V1\PurchaseOrder\PurchaseOrderDemandUnitTypeResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\PurchaseOrderDemandUnitTypeRepositoryInterface;

class PurchaseOrderDemandUnitTypeService
{
    public function __construct(
        private readonly PurchaseOrderDemandUnitTypeRepositoryInterface $purchaseOrderDemandUnitTypeRepository,
        private readonly GetService $get,
    )
    {
    }

    public function getInfo()
    {
        return $this->get->handle(PurchaseOrderDemandUnitTypeResource::class, $this->purchaseOrderDemandUnitTypeRepository);
    }
}
