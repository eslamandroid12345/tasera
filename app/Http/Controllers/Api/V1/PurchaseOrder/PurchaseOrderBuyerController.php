<?php

namespace App\Http\Controllers\Api\V1\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderApprovalRequest;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderDelayRequest;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderFilterRequest;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderInquiryRequest;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderRequest;
use App\Http\Services\Api\V1\PurchaseOrder\PurchaseOrderBuyerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderBuyerController extends Controller
{
    public function __construct(
        private readonly PurchaseOrderBuyerService $purchaseOrder
    )
    {
        $this->middleware('auth:api');
    }

    public function getFilteredPurchaseOrders(PurchaseOrderFilterRequest $request) {
        return $this->purchaseOrder->getFilteredPurchaseOrders($request);
    }

    public function getMyStatistics() {
        return $this->purchaseOrder->getMyStatistics();
    }

    public function create(PurchaseOrderRequest $request) {
        return $this->purchaseOrder->create($request);
    }

    public function show($referenceId) {
        return $this->purchaseOrder->show($referenceId);
    }

    public function update(PurchaseOrderRequest $request, $referenceId)
    {
        return $this->purchaseOrder->update($request, $referenceId);
    }

    public function approve(PurchaseOrderApprovalRequest $request, $referenceId) {
        return $this->purchaseOrder->approve($request, $referenceId);
    }

    public function replyInquiry(PurchaseOrderInquiryRequest $request, $purchaseOrderId, $inquiryId)
    {
        return $this->purchaseOrder->replyInquiry($request, $purchaseOrderId, $inquiryId);
    }

    public function delay(PurchaseOrderDelayRequest $request, $purchaseOrderId)
    {
        return $this->purchaseOrder->delay($request, $purchaseOrderId);
    }
}
