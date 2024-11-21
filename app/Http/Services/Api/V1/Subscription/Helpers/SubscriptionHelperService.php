<?php

namespace App\Http\Services\Api\V1\Subscription\Helpers;

use App\Http\Enums\PaymentStatus;
use App\Http\Requests\Api\V1\Subscription\SubscriptionRequest;
use App\Http\Services\Api\V1\Payment\PaymentService;
use App\Http\Traits\Responser;
use App\Repository\PackageRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class SubscriptionHelperService
{
    use Responser;

    public function __construct(
        private readonly SubscriptionRepositoryInterface $subscriptionRepository,
        private readonly PaymentService $payment,
        private readonly PackageRepositoryInterface $packageRepository,
    )
    {

    }

    public function handle(SubscriptionRequest $request)
    {
        DB::beginTransaction();
        try {
            $payment = $this->payment->initiate($request);

            return $this->{PaymentStatus::from($payment->status)->invokable()}($payment->id, $request->input('package_id'));

        } catch (Exception $e) {
            DB::rollBack();
//            dd($e);
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    private function initiateActiveSubscription($paymentId, $packageId)
    {
        $package = $this->packageRepository->getById($packageId, ['id', 'subscription_months']);

        $this->subscriptionRepository->create([
            'package_id' => $packageId,
            'company_id' => auth('api')->user()->company_id,
            'payment_id' => $paymentId,
            'ends_at' => Carbon::now()->addMonths($package->subscription_months),
            'is_active' => true
        ]);

        DB::commit();

        return $this->responseSuccess(message: __('messages.Your payment and subscription have been completed successfully'));
    }

    private function initiateNonActiveSubscription($paymentId, $packageId)
    {
        $this->subscriptionRepository->create([
            'package_id' => $packageId,
            'company_id' => auth('api')->user()->company_id,
            'payment_id' => $paymentId,
            'ends_at' => null,
            'is_active' => false
        ]);
        DB::commit();

        return $this->responseSuccess(message: __('messages.Your subscription will be activated after reviewing the payment details'));
    }

    private function failSubscription()
    {
        DB::commit();

        return $this->responseFail(400, __('messages.Payment failed'));
    }

}
