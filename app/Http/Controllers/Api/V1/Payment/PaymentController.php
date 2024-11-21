<?php

namespace App\Http\Controllers\Api\V1\Payment;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Payment\PaymentService;
use App\Repository\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        private PaymentService $payment,
    )
    {
        $this->middleware('auth:api');
    }
}
