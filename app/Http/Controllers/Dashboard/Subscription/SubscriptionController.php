<?php

namespace App\Http\Controllers\Dashboard\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Subscription\SubscriptionRequest;
use App\Http\Services\Dashboard\Payment\Subscription\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct(private SubscriptionService $service)
    {
        $this->middleware('permission:subscriptions-read')->only('index');
        $this->middleware('permission:subscriptions-update')->only('toggle');
    }
    public function index(){
        return $this->service->index();
    }
    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(SubscriptionRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }
    public function toggle(){
        return $this->service->toggle();
    }

}
