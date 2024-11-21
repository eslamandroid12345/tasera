<?php

namespace App\Repository\Eloquent;

use App\Http\Enums\CompanyType;
use App\Models\Company;
use App\Repository\CompanyRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CompanyRepository extends Repository implements CompanyRepositoryInterface
{
    protected Model $model;

    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    public function syncFields($id, array $fields)
    {
        $company = $this->model::query()->where('id', $id)->first();
        if ($company !== null) {
            return $company->fields()->sync($fields);
        }
        return false;
    }
    public function getBuyers($perPage){
        return $this->model::query()->where('type','buyer')->orderBy('has_loyalty_points','DESC')->paginate($perPage);
    }

    public function paginatedType($type)
    {
        return $this->model::query()->where('type', $type)->orderByDesc('id')->paginate(20);
    }

}
