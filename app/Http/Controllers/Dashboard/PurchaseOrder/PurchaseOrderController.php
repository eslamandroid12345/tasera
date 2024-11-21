<?php

namespace App\Http\Controllers\Dashboard\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PurchaseOrder\PurchaseOrderRequest;
use App\Http\Services\Dashboard\PurchaseOrder\PurchaseOrderService;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function __construct(private PurchaseOrderService $service)
    {
        $this->middleware('permission:purchase-orders-read')->only('index','show');
        $this->middleware('permission:purchase-orders-update')->only('edit','update');
        $this->middleware('permission:purchase-orders-delete')->only('destroy');
    }
    public function index(){
        return $this->service->index();
    }
    public function show($id){
        return $this->service->show($id);
    }
    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(PurchaseOrderRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
}
