<?php

namespace App\Repository\Eloquent;

use App\Models\LoyaltyPoint;
use App\Repository\LoyaltyPointRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LoyaltyPointRepository extends Repository implements LoyaltyPointRepositoryInterface
{
    protected Model $model;

    public function __construct(LoyaltyPoint $model)
    {
        parent::__construct($model);
    }

    public function deleteByCompany($companyId)
    {
        return $this->model::query()->where('company_id', $companyId)->delete();
    }

    public function getByCompany($companyId)
    {
        return $this->model::query()->where('company_id', $companyId)->get();
    }
}
