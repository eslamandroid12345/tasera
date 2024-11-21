<?php

namespace App\Http\Controllers\Dashboard\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\PurchaseOrder\PurchaseOrderInquiryService;
use Illuminate\Http\Request;

class PurchaseOrderInquiryController extends Controller
{
        public function __construct(private PurchaseOrderInquiryService $service){
            $this->middleware('permission:purchase-orders-inquiries-delete')->only('destroy');
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
