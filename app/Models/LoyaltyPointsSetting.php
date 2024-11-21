<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyPointsSetting extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public function nameValue() : Attribute
    {
        return Attribute::get(function () {
            if($this->name=='register')
                return __('general.loyalty points.register');
            elseif ($this->name=='purchase_order_approval')
                return __('general.loyalty points.purchase_order_approval');
        });
    }
    public function loyaltyPoints()
    {
        return $this->hasMany(LoyaltyPoint::class, 'loyalty_point_id');
    }
}
