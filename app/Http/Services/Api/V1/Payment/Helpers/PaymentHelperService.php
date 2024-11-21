<?php

namespace App\Http\Services\Api\V1\Payment\Helpers;

use App\Http\Enums\PaymentStatus;
use App\Repository\PackageRepositoryInterface;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;

class PaymentHelperService
{

    public function __construct(
        private readonly PaymentRepositoryInterface $paymentRepository,
        private readonly PackageRepositoryInterface $packageRepository,
    )
    {

    }

    public function fetchPackagePrice($packageId)
    {
        return $this->packageRepository->getById($packageId, ['price'])?->price;
    }

    public function card($payment)
    {
        $this->paymentRepository->update($payment->id, ['status' => PaymentStatus::CONFIRMED->value]); // TODO: change it in production to payment gateway configs
    }

    public function applePay($payment)
    {
        $this->paymentRepository->update($payment->id, ['status' => PaymentStatus::CONFIRMED->value]); // TODO: change it in production to payment gateway configs
    }

    public function bankTransfer($payment)
    {
        $this->paymentRepository->update($payment->id, ['status' => PaymentStatus::BEING_REVIEWED->value]);
    }

    public function mada($payment)
    {
        $this->paymentRepository->update($payment->id, ['status' => PaymentStatus::CONFIRMED->value]); // TODO: change it in production to payment gateway configs
    }

}
