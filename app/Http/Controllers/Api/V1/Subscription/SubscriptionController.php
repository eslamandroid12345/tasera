<?php

namespace App\Http\Controllers\Api\V1\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Subscription\SubscriptionRequest;
use App\Http\Services\Api\V1\Subscription\SubscriptionService;
use App\Repository\SubscriptionRepositoryInterface;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct(
        private readonly SubscriptionService $subscription,
    )
    {
        $this->middleware('auth:api');
    }

    public function initiate(SubscriptionRequest $request)
    {
        return $this->subscription->initiate($request);
    }

    public function getDetails()
    {
        return $this->subscription->getDetails();
    }
}
