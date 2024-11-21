<?php

namespace App\Repository\Eloquent;

use App\Models\Package;
use App\Repository\PackageRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PackageRepository extends Repository implements PackageRepositoryInterface
{
    protected Model $model;

    public function __construct(Package $model)
    {
        parent::__construct($model);
    }

    public function getRegularPackage()
    {
        return $this->model::query()->where('is_fallback', true)->first();
    }
}
