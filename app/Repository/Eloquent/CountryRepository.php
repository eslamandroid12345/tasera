<?php

namespace App\Repository\Eloquent;

use App\Models\Country;
use App\Repository\CountryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CountryRepository extends Repository implements CountryRepositoryInterface
{
    protected Model $model;

    public function __construct(Country $model)
    {
        parent::__construct($model);
    }
}
