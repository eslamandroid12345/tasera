<?php

namespace App\Http\Controllers\Dashboard\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\PurchaseOrder\PurchaseOrderDemandUnitService;
use App\Http\Services\Dashboard\PurchaseOrder\PurchaseOrderOfferService;
use Illuminate\Http\Request;

class PurchaseOrderDemandUnitController extends Controller
{
    public function __construct(private PurchaseOrderDemandUnitService $service){
        $this->middleware('permission:purchase-orders-demand-unit-delete')->only('destroy');
    }

    public function destroy($id){
        return $this->service->destroy($id);
    }
}
