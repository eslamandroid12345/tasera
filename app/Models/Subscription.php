<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = [];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function createdAt() : Attribute
    {
        return Attribute::get(function ($value) {
            return Carbon::parse($value)->translatedFormat('d F Y h:iA');
        });
    }

    public function endsAt() : Attribute
    {
        return Attribute::get(function ($value) {
            return Carbon::parse($value)->translatedFormat('d F Y h:iA');
        });
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
