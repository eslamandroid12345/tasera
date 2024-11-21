<?php

namespace App\Repository\Eloquent;

use App\Models\LoyaltyPointsSetting;
use App\Repository\LoyaltyPointsSettingRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LoyaltyPointsSettingRepository extends Repository implements LoyaltyPointsSettingRepositoryInterface
{
    protected Model $model;

    public function __construct(LoyaltyPointsSetting $model)
    {
        parent::__construct($model);
    }

}
