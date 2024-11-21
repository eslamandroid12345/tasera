<?php

namespace App\Http\Controllers\Api\V1\PurchaseOrder;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\PurchaseOrder\PurchaseOrderTaxService;
use Illuminate\Http\Request;

class PurchaseOrderTaxController extends Controller
{
    public function __construct(
        private readonly PurchaseOrderTaxService $purchaseOrderTax,
    )
    {
    }

    public function getInfo()
    {
        return $this->purchaseOrderTax->getInfo();
    }
}
