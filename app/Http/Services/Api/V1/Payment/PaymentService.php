<?php

namespace App\Http\Services\Api\V1\Payment;

use App\Http\Enums\PaymentMethod;
use App\Http\Enums\PaymentStatus;
use App\Http\Requests\Api\V1\Subscription\SubscriptionRequest;
use App\Http\Services\Api\V1\Payment\Helpers\PaymentHelperService;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\Responser;
use App\Repository\PaymentRepositoryInterface;

class PaymentService
{
    use Responser;

    public function __construct(
        private readonly PaymentRepositoryInterface $paymentRepository,
        private readonly PaymentHelperService $helper,
        private readonly FileManagerService $fileManager,
    )
    {
    }

    public function initiate(SubscriptionRequest $request)
    {
        $paymentData = $request->only(['method', 'bank_account_name', 'bank_account_number', 'from_bank', 'to_bank', 'transfer_date', 'transfer_time']);

        $paymentData['company_id'] = auth('api')->user()->company_id;
        $paymentData['amount'] = $this->helper->fetchPackagePrice($request->input('package_id'));
        $paymentData['status'] = PaymentStatus::PENDING->value;
        $paymentData['transfer_image'] = $this->fileManager->handle('transfer_image', 'payments/bank_transfers');

        $payment = $this->paymentRepository->create($paymentData);

        $this->helper->{PaymentMethod::from($payment->method)->invokable()}($payment); // TODO: payment gateway here

        return $this->paymentRepository->getById($payment->id);
    }


}
