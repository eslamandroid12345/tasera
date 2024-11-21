<?php

namespace App\Http\Services\Api\V1\User;

use App\Http\Requests\Api\V1\User\SubUserRequest;
use App\Http\Requests\Api\V1\User\UserPasswordRequest;
use App\Http\Requests\Api\V1\User\UserRequest;
use App\Http\Resources\V1\User\UserResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService
{
    use Responser;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserHelperService $helper,
        private readonly GetService $get,
    )
    {
    }

    public function getDetails()
    {
        return $this->get->handle(UserResource::class, $this->userRepository, 'getById', [auth('api')->id()], true, resource_parameters: [true]);
    }

    public function updateMainData(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $this->userRepository->update(auth('api')->id(), $data);

            DB::commit();
            return $this->responseSuccess(message: __('messages.updated successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function updatePassword(UserPasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['password']);

            $this->userRepository->update(auth('api')->id(), $data);

            DB::commit();
            return $this->responseSuccess(message: __('messages.updated successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function createSubUser(SubUserRequest $request)
    {
        if (auth('api')->user()?->company?->can_add_sub_user)
        {
            return $this->helper->createSubUser($request);
        }
        else
        {
            return $this->responseFail(401, __('messages.You are not authorized to access this resource'));
        }
    }

}
