<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $guarded = [];

    public function isReadValue() : Attribute
    {
        return Attribute::get(function () {
            return $this->is_read ? __('dashboard.Yes') : __('dashboard.No');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
