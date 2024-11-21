<?php

namespace App\Http\Services\Api\V1\User;

use App\Http\Requests\Api\V1\User\SubUserRequest;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class UserHelperService
{
    use Responser;

    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    public function createSubUser(SubUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['company_id'] = auth('api')->user()->company_id;
            $data['is_sub'] = true;

            $this->userRepository->create($data);

            DB::commit();
            return $this->responseSuccess(message: __('messages.updated successfully'));
        } catch (Exception $e) {
            DB::rollBack();
//            dd($e);
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

}
