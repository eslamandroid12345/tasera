<?php

namespace App\Http\Services\Api\V1\Auth;

use App\Http\Requests\Api\V1\Auth\SignInRequest;
use App\Http\Requests\Api\V1\Auth\SignUpRequest;
use App\Http\Requests\Api\V1\Otp\OtpRequest;
use App\Http\Requests\Api\V1\Otp\OtpVerifyRequest;
use App\Http\Requests\Api\V1\User\UserPasswordResetRequest;
use App\Http\Resources\V1\User\UserResource;
use App\Http\Services\Api\V1\Auth\Helpers\AuthHelperService;
use App\Http\Services\Api\V1\Otp\OtpService;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Mail\ResetPasswordOtp;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\OtpRepositoryInterface;
use App\Repository\StructureRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Mail\SignUpOtp;

abstract class AuthService
{
    use Responser;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly CompanyRepositoryInterface $companyRepository,
        private readonly OtpRepositoryInterface $otpRepository,
        private readonly StructureRepositoryInterface $structureRepository,
        private readonly AuthHelperService $helper,
        private readonly OtpService $otp,
        private readonly FileManagerService $fileManager,
        private readonly GetService $get,
    )
    {

    }

    public function signUp(SignUpRequest $request, $type)
    {
        DB::beginTransaction();
        try
        {
            $company = $this->helper->createCompany($request, $type);
            $user = $this->helper->createUser($request, $company->id);

            DB::commit();
            return $this->responseSuccess(message: __('messages.created successfully'), data: new UserResource($user, false));
        }
        catch (Exception $e)
        {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function sendSignUpOtp(OtpRequest $request)
    {
        $infos = json_decode($this->structureRepository->structure('infos')->content, true);
        return $this->otp->send($request, new SignUpOtp($request, $infos), false, false, true);
    }

    public function verifySignUpOtp(OtpVerifyRequest $request)
    {
        return $this->otp->verify($request, false);
    }

    public function sendResetPasswordOtp(OtpRequest $request)
    {
        return $this->otp->send($request, new ResetPasswordOtp($request), true, true);
    }

    public function verifyResetPasswordOtp(OtpVerifyRequest $request, $token)
    {
        return $this->otp->verify($request, false, $token);
    }

    public function resetPassword(UserPasswordResetRequest $request, $token)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $this->userRepository->updatePasswordByEmail($data['email'], $data['password']);

            $this->otp->remove($data['email']);

            DB::commit();
            return $this->responseSuccess(message: __('messages.Password updated successfully'));
        } catch (Exception $e) {
            DB::rollBack();
//            dd($e);
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function signIn(SignInRequest $request) {
        $credentials = $request->only('email', 'password');
        $token = auth('api')->attempt($credentials);
        if ($token) {
            if (auth('api')->user()->is_active == 0)
                return $this->responseFail(status: 401, message: __('messages.Your account is not activated yet'));
            return $this->responseSuccess(message: __('messages.Successfully authenticated'), data: new UserResource(auth('api')->user(), true));
        }

        return $this->responseFail(status: 401, message: __('messages.wrong credentials'));
    }

    public function signOut() {
        auth('api')->logout();
        return $this->responseSuccess(message: __('messages.Successfully loggedOut'));
    }

}
