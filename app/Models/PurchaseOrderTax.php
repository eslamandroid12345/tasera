<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderTax extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function percentage() : Attribute
    {
        return Attribute::get(function () {
            return (float) number_format($this->value * 100, 2, '.', '');
        });
    }

    public function multiplicationNumber() : Attribute
    {
        return Attribute::get(function () {
            return (float) number_format($this->value + 1, 4, '.', '');
        });
    }

    public function offers()
    {
        return $this->hasMany(PurchaseOrderOffer::class);
    }
}
