<?php

namespace App\Http\Controllers\Api\V1\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderFilterRequest;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderInquiryRequest;
use App\Http\Requests\Api\V1\PurchaseOrder\PurchaseOrderOfferRequest;
use App\Http\Services\Api\V1\PurchaseOrder\PurchaseOrderSupplierService;
use Illuminate\Http\Request;

class PurchaseOrderSupplierController extends Controller
{
    public function __construct(
        private readonly PurchaseOrderSupplierService $purchaseOrder,
    )
    {
        $this->middleware('auth:api');
    }

    public function getMyFilteredOffers(PurchaseOrderFilterRequest $request) {
        return $this->purchaseOrder->getMyFilteredOffers($request);
    }

    public function getMyStatistics() {
        return $this->purchaseOrder->getMyStatistics();
    }

    public function show($referenceId)
    {
        return $this->purchaseOrder->show($referenceId);
    }

    public function inquire(PurchaseOrderInquiryRequest $request, $referenceId)
    {
        return $this->purchaseOrder->inquire($request, $referenceId);
    }

    public function offer(PurchaseOrderOfferRequest $request, $referenceId)
    {
        return $this->purchaseOrder->offer($request, $referenceId);
    }
}
