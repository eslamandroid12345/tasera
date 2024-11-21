<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PaymentRequest;
use App\Http\Services\Dashboard\Payment\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $service)
    {
        $this->middleware('permission:payments-read')->only('index','show');
        $this->middleware('permission:payments-update')->only('update');
    }
    public function index(){
        return $this->service->index();
    }
    public function show(string $id)
    {
        return $this->service->show($id);
    }

    public function update(PaymentRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }
}
