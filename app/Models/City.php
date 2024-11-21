<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use LanguageToggle, HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function companies() {
        return $this->hasMany(Company::class);
    }
}
