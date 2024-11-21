<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\SubUserRequest;
use App\Http\Requests\Api\V1\User\UserPasswordRequest;
use App\Http\Requests\Api\V1\User\UserRequest;
use App\Http\Services\Api\V1\User\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $user,
    )
    {
        $this->middleware('auth:api');
    }

    public function getDetails() {
        return $this->user->getDetails();
    }

    public function updateMainData(UserRequest $request)
    {
        return $this->user->updateMainData($request);
    }

    public function updatePassword(UserPasswordRequest $request)
    {
        return $this->user->updatePassword($request);
    }

    public function createSubUser(SubUserRequest $request)
    {
        return $this->user->createSubUser($request);
    }
}
