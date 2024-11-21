<?php

namespace App\Http\Controllers\Dashboard\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\PurchaseOrder\PurchaseOrderDemandUnitOfferService;
use Illuminate\Http\Request;

class PurchaseOrderDemandUnitOfferController extends Controller
{
    public function __construct(private PurchaseOrderDemandUnitOfferService $service){
        $this->middleware('permission:purchase-orders-offers-units-delete')->only('destroy');
    }

    public function destroy($id){
        return $this->service->destroy($id);
    }
}
