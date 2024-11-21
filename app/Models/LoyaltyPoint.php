<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class LoyaltyPoint extends Model
{
    protected $guarded = [];

    public function date() : Attribute
    {
        return Attribute::get(function () {
            return Carbon::parse($this->created_at)->format('d/m/Y');
        });
    }
    public function settingValue() : Attribute
    {
        return Attribute::get(function () {
            if($this->setting->name=='register')
                return __('general.loyalty points.register');
            elseif ($this->setting->name=='purchase_order_approval')
                return __('general.loyalty points.purchase_order_approval');
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function referralCompany()
    {
        return $this->belongsTo(Company::class, 'referral_company_id');
    }

    public function setting()
    {
        return $this->belongsTo(LoyaltyPointsSetting::class, 'loyalty_points_setting_id');
    }
}
