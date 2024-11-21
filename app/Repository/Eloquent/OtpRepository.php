<?php

namespace App\Repository\Eloquent;

use App\Models\Otp;
use App\Repository\OtpRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OtpRepository extends Repository implements OtpRepositoryInterface
{
    protected Model $model;

    public function __construct(Otp $model)
    {
        parent::__construct($model);
    }

    public function generate($email, $tokenize = false)
    {
        return $this->model::query()->updateOrCreate(
            [
                'email' => $email,
            ],
            [
                'code' => random_int(1000, 9999),
                'token' => $tokenize ? Str::random(30) : null,
                'is_verified' => false
            ]
        );
    }

    public function check($email, $code, $token = null)
    {
        return $this->model::query()
            ->where('email', $email)
            ->where('code', $code)
            ->where(function ($query) use ($token) {
                if ($token !== null) {
                    $query->where('token', $token);
                } else {
                    $query->whereNull('token');
                }
            })
            ->where('is_verified', false)
            ->exists();
    }

    public function verify($email, $token = null)
    {
        return $this->model::query()
            ->where('email', $email)
            ->where(function ($query) use ($token) {
                if ($token !== null) {
                    $query->where('token', $token);
                } else {
                    $query->whereNull('token');
                }
            })
            ->where('is_verified', false)
            ->update(['is_verified' => true]);
    }

    public function remove($email)
    {
        return $this->model::query()->where('email', $email)->delete();
    }
}
