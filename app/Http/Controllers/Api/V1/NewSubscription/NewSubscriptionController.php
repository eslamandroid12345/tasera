<?php

namespace App\Http\Controllers\Api\V1\NewSubscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\NewSubscription\NewSubscriptionRequest;
use App\Http\Services\Api\V1\NewSubscription\NewSubscriptionService;
use App\Repository\SubscriptionRepositoryInterface;
use Illuminate\Http\Request;

class NewSubscriptionController extends Controller
{
    public function __construct(
        private readonly NewSubscriptionService $newSubscription,
    )
    {
        $this->middleware('auth:api');
    }

    public function sendDetails(NewSubscriptionRequest $request)
    {
        return $this->newSubscription->sendDetails($request);
    }
}
