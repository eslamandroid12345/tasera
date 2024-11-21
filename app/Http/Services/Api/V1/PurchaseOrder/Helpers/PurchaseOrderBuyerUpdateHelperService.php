<?php

namespace App\Http\Services\Api\V1\PurchaseOrder\Helpers;

use App\Http\Enums\PurchaseOrderStatus;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\FieldPurchaseOrderRepositoryInterface;
use App\Repository\PurchaseOrderDemandUnitRepositoryInterface;
use App\Repository\PurchaseOrderRepositoryInterface;

class PurchaseOrderBuyerUpdateHelperService
{
    public function __construct(
        private readonly PurchaseOrderRepositoryInterface           $purchaseOrderRepository,
        private readonly FieldPurchaseOrderRepositoryInterface      $fieldPurchaseOrderRepository,
        private readonly PurchaseOrderDemandUnitRepositoryInterface $purchaseOrderDemandUnitRepository,
        private readonly FileManagerService $fileManager,
    )
    {
    }

    public function updatePurchaseOrderBase(PurchaseOrderRequest $request, $purchaseOrderId)
    {
        $purchaseOrderData = $request->only(['type', 'title', 'delivery_city_id', 'closes_at', 'delivery_duration', 'payment_duration', 'description']);
        $purchaseOrderData['status'] = PurchaseOrderStatus::UNDER_REVIEW->value;
        $purchaseOrderData['is_updated_before'] = true;

        return $this->purchaseOrderRepository->update($purchaseOrderId, $purchaseOrderData);
    }

    public function reassignPurchaseOrderFields(PurchaseOrderRequest $request, $purchaseOrderId)
    {
        $fields = $request->input('fields');

        $this->fieldPurchaseOrderRepository->deleteByPurchaseOrder($purchaseOrderId);

        foreach ($fields as $fieldId) {
            $this->fieldPurchaseOrderRepository->create([
                'field_id' => $fieldId,
                'purchase_order_id' => $purchaseOrderId
            ]);
        }
    }

    public function reassignPurchaseOrderDemandUnits(PurchaseOrderRequest $request, $purchaseOrderId)
    {
        $demandUnits = $request->input('demand_units');

        $this->purchaseOrderDemandUnitRepository->deleteByPurchaseOrder($purchaseOrderId);

        $i = 0;

        foreach ($demandUnits as $demandUnit) {
            $this->purchaseOrderDemandUnitRepository->create([
                'purchase_order_id' => $purchaseOrderId,
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
