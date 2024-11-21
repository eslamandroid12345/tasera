<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use LanguageToggle;

    protected $guarded = [];
    protected $casts = [
        'can_add_sub_user' => 'boolean',
        'has_verified_badge' => 'boolean',
        'can_view_company_file' => 'boolean',
        'is_fallback' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function isCurrentSubscription(): Attribute
    {
        return Attribute::get(function () {
            return auth('api')->user()?->company?->activeSubscription?->package_id == $this->id ?: null;
        });
    }

    public function canAddSubUserValue(): Attribute
    {
        return Attribute::get(function () {
            if ($this->can_add_sub_user == 1)
                return __('dashboard.Yes');
            else
                return __('dashboard.No');
        });
    }
    public function hasVerifiedBadgeValue(): Attribute
    {
        return Attribute::get(function () {
            if ($this->has_verified_badge == 1)
                return __('dashboard.Yes');
            else
                return __('dashboard.No');
        });
    }
    public function canViewCompanyFileValue(): Attribute
    {
        return Attribute::get(function () {
            if ($this->can_view_company_file == 1)
                return __('dashboard.Yes');
            else
                return __('dashboard.No');
        });
    }
    public function isFallbackValue(): Attribute
    {
        return Attribute::get(function () {
            if ($this->is_fallback == 1)
                return __('dashboard.Yes');
            else
                return __('dashboard.No');
        });
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
