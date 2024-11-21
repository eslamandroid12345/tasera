<?php

namespace App\Http\Controllers\Dashboard\LoyaltyPoint;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Subscription\SubscriptionRequest;
use App\Http\Services\Dashboard\LoyaltyPoint\LoyaltyPointService;
use App\Http\Services\Dashboard\Payment\Subscription\SubscriptionService;
use Illuminate\Http\Request;

class LoyaltyPointController extends Controller
{
    public function __construct(private LoyaltyPointService $service)
    {
        $this->middleware('permission:loyalty-points-read')->only('index');
        $this->middleware('permission:loyalty-points-update')->only('toggle');
    }
    public function index(){
        return $this->service->index();
    }
    public function show(string $id)
    {
        return $this->service->show($id);
    }

    public function update(string $id)
    {
        return $this->service->update($id);
    }
}
