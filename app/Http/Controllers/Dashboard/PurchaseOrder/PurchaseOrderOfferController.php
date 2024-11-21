<?php

namespace App\Http\Controllers\Dashboard\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\PurchaseOrder\PurchaseOrderOfferService;
use Illuminate\Http\Request;

class PurchaseOrderOfferController extends Controller
{
    public function __construct(private PurchaseOrderOfferService $service){
        $this->middleware('permission:purchase-orders-offers-delete')->only('destroy');
        $this->middleware('permission:purchase-orders-offers-read')->only('show');
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function destroy($id){
        return $this->service->destroy($id);
    }

    public function approve(Request $request, $id)
    {
        return $this->service->approve($request, $id);
    }
}
