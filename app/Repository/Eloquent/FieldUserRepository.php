<?php

namespace App\Repository\Eloquent;

use App\Models\CompanyField;
use App\Repository\FieldUserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FieldUserRepository extends Repository implements FieldUserRepositoryInterface
{
    protected Model $model;

    public function __construct(CompanyField $model)
    {
        parent::__construct($model);
    }
}
