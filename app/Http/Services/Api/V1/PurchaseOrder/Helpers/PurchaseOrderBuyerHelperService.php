<?php

namespace App\Http\Services\Api\V1\PurchaseOrder\Helpers;

use App\Http\Enums\PurchaseOrderStatus;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\FieldPurchaseOrderRepositoryInterface;
use App\Repository\PurchaseOrderDemandUnitRepositoryInterface;
use App\Repository\PurchaseOrderInquiryRepositoryInterface;
use App\Repository\PurchaseOrderRepositoryInterface;

class PurchaseOrderBuyerHelperService
{
    public function __construct(
        private readonly PurchaseOrderRepositoryInterface        $purchaseOrderRepository,
        private readonly PurchaseOrderBuyerCreateHelperService   $create,
        private readonly PurchaseOrderBuyerUpdateHelperService   $update,
    )
    {
    }

    public function buildPurchaseOrder(PurchaseOrderRequest $request)
    {
        $initiatedPurchaseOrder = $this->create->initiatePurchaseOrder($request);

        $this->create->assignPurchaseOrderFields($request, $initiatedPurchaseOrder);

        $this->create->assignPurchaseOrderDemandUnits($request, $initiatedPurchaseOrder);

        return $initiatedPurchaseOrder;
    }

    public function updatePurchaseOrder(PurchaseOrderRequest $request, $referenceId)
    {
        $purchaseOrder = $this->purchaseOrderRepository->getMyOrder($referenceId);

        $this->update->updatePurchaseOrderBase($request, $purchaseOrder->id);

        $this->update->reassignPurchaseOrderFields($request, $purchaseOrder->id);

        $this->update->reassignPurchaseOrderDemandUnits($request, $purchaseOrder->id);
    }
}
