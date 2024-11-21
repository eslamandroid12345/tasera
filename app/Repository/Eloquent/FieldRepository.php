<?php

namespace App\Repository\Eloquent;

use App\Models\Field;
use App\Repository\FieldRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FieldRepository extends Repository implements FieldRepositoryInterface
{
    protected Model $model;

    public function __construct(Field $model)
    {
        parent::__construct($model);
    }
}
