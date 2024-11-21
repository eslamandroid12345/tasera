<?php

namespace App\Models;

use App\Http\Traits\HasPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class Manager extends Authenticatable implements LaratrustUser
{
    use HasRolesAndPermissions,HasPassword;

    protected $guarded = [];
    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

}
