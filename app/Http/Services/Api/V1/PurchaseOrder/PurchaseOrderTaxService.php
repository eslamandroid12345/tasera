<?php

namespace App\Http\Services\Api\V1\PurchaseOrder;

use App\Http\Resources\V1\PurchaseOrder\PurchaseOrderTaxResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\PurchaseOrderTaxRepositoryInterface;

class PurchaseOrderTaxService
{
    public function __construct(
        private readonly PurchaseOrderTaxRepositoryInterface $purchaseOrderTaxRepository,
        private readonly GetService $get,
    )
    {
    }

    public function getInfo()
    {
        return $this->get->handle(PurchaseOrderTaxResource::class, $this->purchaseOrderTaxRepository);
    }

}
