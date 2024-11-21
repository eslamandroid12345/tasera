<?php

namespace App\Http\Services\Api\V1\Otp;

use App\Http\Requests\Api\V1\Otp\OtpRequest;
use App\Http\Requests\Api\V1\Otp\OtpVerifyRequest;
use App\Http\Traits\Responser;
use App\Repository\OtpRepositoryInterface;
use App\Repository\PasswordResetTokenRepositoryInterface;
use App\Repository\StructureRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Exception;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OtpService
{
    use Responser;

    public function __construct(
        private readonly OtpRepositoryInterface $otpRepository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    )
    {
    }

    public function send(OtpRequest $request, Mailable $mailable = null, $tokenize = false, $shouldBeUser = false, $shouldBeUnique = false)
    {
        DB::beginTransaction();
        try
        {
            $data = $request->validated();
            $user = $this->userRepository->first('email', $data['email']);

            if ($shouldBeUser && is_null($user))
                return $this->responseFail(message: __('messages.This email is not existed'));

            if ($shouldBeUnique && !is_null($user))
                return $this->responseFail(message: __('messages.This email was used before'));

            $otp = $this->otpRepository->generate($data['email'], $tokenize);

            $token = $tokenize ? ['token' => $otp->token] : [];

            $infos = json_decode($this->structureRepository->structure('infos')->content, true);

            $data = [
                'otp' => $otp,
                'infos' => $infos,
            ];

            if ($mailable !== null)
                Mail::send(new $mailable($data));

            DB::commit();
            return $this->responseSuccess(message: __('messages.OTP code has been sent'), data: $token);
        }
        catch (Exception $e)
        {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function verify(OtpVerifyRequest $request, bool $delete = false, $token = null)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            if ($this->otpRepository->check($data['email'], $data['code'], $token)) {
                $this->otpRepository->verify($data['email'], $token);

                if ($delete)
                    $this->otpRepository->remove($data['email']);

                DB::commit();
                return $this->responseSuccess(message: __('messages.Your email has been verified successfully'));
            } else {
                return $this->responseFail(message: __('messages.Wrong OTP code'));
            }
        } catch (Exception $e) {
            DB::rollBack();
//            dd($e);
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function remove($email)
    {
        return $this->otpRepository->remove($email);
    }

}
