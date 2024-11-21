<?php

namespace App\Http\Services\Api\V1\NewSubscription;

use App\Http\Enums\PaymentStatus;
use App\Http\Requests\Api\V1\Subscription\SubscriptionRequest;
use App\Http\Resources\V1\Subscription\SubscriptionResource;
use App\Http\Services\Api\V1\Payment\PaymentService;
use App\Http\Services\Api\V1\Subscription\Helpers\SubscriptionHelperService;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\SubscriptionRepositoryInterface;
use App\Repository\StructureRepositoryInterface;
use App\Repository\PackageRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Mail;
use App\Mail\NewSubscriptionMail;

class NewSubscriptionService
{
    use Responser;

    public function __construct(
        private readonly SubscriptionRepositoryInterface $subscriptionRepository,
        private readonly SubscriptionHelperService $helper,
        private readonly FileManagerService $fileManager,
        private readonly GetService $get,
        private readonly PackageRepositoryInterface $packageRepository,
        private readonly StructureRepositoryInterface $structureRepository,
        private readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    public function sendDetails($request)
    {
        $user = $this->userRepository->getById(auth('api')->user()->id);
        $package = $this->packageRepository->getById($request->package_id);

        $infos = json_decode($this->structureRepository->structure('infos')->content, true);
        $details1 = [
                        'infos' => $infos,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'package' => $package,
                        'user' => $user,
                        'type' => 2,
                    ];
        $details = [
                        'infos' => $infos,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'package' => $package,
                        'user' => $user,
                        'type' => 1,
                    ];
        if($request->type == '1')
        {
            $this->sendEmail($user->email,$details);
            return $this->responseSuccess(message: __('messages.Your_email_has_been_send_successfully'));
        }
        else
        {
            $this->sendEmail($user->email,$details1);
            return $this->responseSuccess(message: __('messages.Your_email_has_been_send_successfully'));
        }
    }

    public function sendEmail($email,$details)
    {
        Mail::to(config('mail.from_new_subscribe.address'))->send(new NewSubscriptionMail($email,$details));
    }
}
