<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\SignInRequest;
use App\Http\Requests\Api\V1\Auth\SignUpRequest;
use App\Http\Requests\Api\V1\Otp\OtpRequest;
use App\Http\Requests\Api\V1\Otp\OtpVerifyRequest;
use App\Http\Requests\Api\V1\User\UserPasswordResetRequest;
use App\Http\Services\Api\V1\Auth\AuthService;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $auth,
    )
    {
        $this->middleware('auth:api')->only(['signOut', 'getDetails']);
    }

    public function signUp(SignUpRequest $request, $type) {
        return $this->auth->signUp($request, $type);
    }

    public function sendSignUpOtp(OtpRequest $request)
    {
        return $this->auth->sendSignUpOtp($request);
    }

    public function verifySignUpOtp(OtpVerifyRequest $request)
    {
        return $this->auth->verifySignUpOtp($request);
    }

    public function sendResetPasswordOtp(OtpRequest $request)
    {
        return $this->auth->sendResetPasswordOtp($request);
    }

    public function verifyResetPasswordOtp(OtpVerifyRequest $request, $token)
    {
        return $this->auth->verifyResetPasswordOtp($request, $token);
    }

    public function resetPassword(UserPasswordResetRequest $request, $token)
    {
        return $this->auth->resetPassword($request, $token);
    }

    public function signIn(SignInRequest $request) {
        return $this->auth->signIn($request);
    }

    public function signOut() {
        return $this->auth->signOut();
    }
}
