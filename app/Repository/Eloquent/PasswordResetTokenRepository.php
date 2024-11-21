<?php

namespace App\Repository\Eloquent;

use App\Models\PasswordResetToken;
use App\Repository\PasswordResetTokenRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PasswordResetTokenRepository extends Repository implements PasswordResetTokenRepositoryInterface
{
    protected Model $model;

    public function __construct(PasswordResetToken $model)
    {
        parent::__construct($model);
    }
}
