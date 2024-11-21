<?php

namespace App\Http\Services\Api\V1\LoyaltyPoint;

use App\Http\Resources\V1\LoyaltyPoint\LoyaltyPointCollection;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\LoyaltyPointRepositoryInterface;
use App\Repository\LoyaltyPointsSettingRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class LoyaltyPointService
{
    use Responser;

    public function __construct(
        private readonly LoyaltyPointRepositoryInterface $loyaltyPointRepository,
        private readonly LoyaltyPointsSettingRepositoryInterface $loyaltyPointsSettingRepository,
        private readonly GetService $get,
    )
    {
    }

    public function show()
    {
        if (Gate::allows('access-loyalty-points')) {
            return $this->get->handle(LoyaltyPointCollection::class, $this->loyaltyPointRepository, 'getByCompany', [auth('api')->user()->company_id], true);
        } else {
            return $this->responseFail(401, __('messages.You are not authorized to access this resource'));
        }
    }

}
