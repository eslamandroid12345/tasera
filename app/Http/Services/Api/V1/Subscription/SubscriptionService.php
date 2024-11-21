<?php

namespace App\Http\Services\Api\V1\Subscription;

use App\Http\Enums\PaymentStatus;
use App\Http\Requests\Api\V1\Subscription\SubscriptionRequest;
use App\Http\Resources\V1\Subscription\SubscriptionResource;
use App\Http\Services\Api\V1\Payment\PaymentService;
use App\Http\Services\Api\V1\Subscription\Helpers\SubscriptionHelperService;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\SubscriptionRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class SubscriptionService
{
    use Responser;

    public function __construct(
        private readonly SubscriptionRepositoryInterface $subscriptionRepository,
        private readonly SubscriptionHelperService $helper,
        private readonly FileManagerService $fileManager,
        private readonly GetService $get,
    )
    {
    }

    public function initiate(SubscriptionRequest $request)
    {
        if (Gate::allows('can-subscribe')) {

            return $this->helper->handle($request);

        } else {
            return $this->responseFail(401, __('messages.You are already subscribed to a Package'));
        }
    }
    public function getDetails()
    {
        $subscription = auth('api')?->user()?->company?->activeSubscription;

        if (Gate::denies('can-subscribe') && $subscription !== null) {
            return $this->get->handle(SubscriptionResource::class, $this->subscriptionRepository, 'getById', [$subscription->id], true);
        } else {
            return $this->responseFail(401, __('messages.You are not authorized to access this resource'));
        }
    }
}
