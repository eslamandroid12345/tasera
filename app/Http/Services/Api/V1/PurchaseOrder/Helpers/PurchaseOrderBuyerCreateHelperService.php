<?php

namespace App\Http\Services\Api\V1\PurchaseOrder\Helpers;

use App\Http\Enums\PurchaseOrderStatus;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\FieldPurchaseOrderRepositoryInterface;
use App\Repository\PurchaseOrderDemandUnitRepositoryInterface;
use App\Repository\PurchaseOrderInquiryRepositoryInterface;
use App\Repository\PurchaseOrderRepositoryInterface;

class PurchaseOrderBuyerCreateHelperService
{
    public function __construct(
        private readonly PurchaseOrderRepositoryInterface           $purchaseOrderRepository,
        private readonly FieldPurchaseOrderRepositoryInterface      $fieldPurchaseOrderRepository,
        private readonly PurchaseOrderDemandUnitRepositoryInterface $purchaseOrderDemandUnitRepository,
        private readonly FileManagerService $fileManager,
    )
    {
    }

    public function initiatePurchaseOrder(PurchaseOrderRequest $request)
    {
        $initiatedPurchaseOrderData = $request->only(['type', 'title', 'delivery_city_id', 'closes_at', 'delivery_duration', 'payment_duration', 'description']);

        $initiatedPurchaseOrderData['user_id'] = auth('api')->id();
        $initiatedPurchaseOrderData['company_id'] = auth('api')->user()->company_id;
        $initiatedPurchaseOrderData['status'] = PurchaseOrderStatus::UNDER_REVIEW->value;

        return $this->purchaseOrderRepository->create($initiatedPurchaseOrderData);
    }

    public function assignPurchaseOrderFields(PurchaseOrderRequest $request, $initiatedPurchaseOrder)
    {
        $fields = $request->input('fields');

        foreach ($fields as $fieldId) {
            $this->fieldPurchaseOrderRepository->create([
                'field_id' => $fieldId,
                'purchase_order_id' => $initiatedPurchaseOrder->id
            ]);
        }
    }

    public function assignPurchaseOrderDemandUnits(PurchaseOrderRequest $request, $initiatedPurchaseOrder)
    {
        $demandUnits = $request->input('demand_units');

        $i = 0;

        foreach ($demandUnits as $demandUnit) {
            $this->purchaseOrderDemandUnitRepository->create([
                'purchase_order_id' => $initiatedPurchaseOrder->id,
                'name' => $demandUnit['name'],
                'details' => $demandUnit['details'],
                'type_id' => $demandUnit['type_id'],
                'quantity' => $demandUnit['quantity'],
                'attachment' => $request->hasFile('demand_units.' . $i . '.attachment') ? $this->fileManager->handle('demand_units.' . $i . '.attachment', 'purchase_orders/demand_units') : null
            ]);

            $i++;
        }
    }

}
