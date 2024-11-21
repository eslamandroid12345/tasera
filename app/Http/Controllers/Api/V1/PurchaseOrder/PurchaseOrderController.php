<?php

namespace App\Http\Controllers\Api\V1\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderFilterRequest;
use App\Http\Services\Api\V1\PurchaseOrder\PurchaseOrderService;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function __construct(
        private readonly PurchaseOrderService $purchaseOrder
    )
    {
    }

    public function getFilteredPurchaseOrders(PurchaseOrderFilterRequest $request) {
        return $this->purchaseOrder->getFilteredPurchaseOrders($request);
    }

    public function show($referenceId) {
        return $this->purchaseOrder->show($referenceId);
    }

    public function getLatestPurchaseOrders()
    {
        return $this->purchaseOrder->getLatestPurchaseOrders();
    }
}
