<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderOffer extends Model
{
    protected $guarded = [];
    protected $casts = [
        'is_special' => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function createdAt(): Attribute
    {
        return Attribute::get(function ($value) {
            return Carbon::parse($value)->diffForHumans(Carbon::now());
        });
    }

    public function createdAtDate(): Attribute
    {
        return Attribute::get(function () {
            return Carbon::parse($this->getRawOriginal('created_at'))->format('d/m/Y');
        });
    }

    public function fullPublishedAt() : Attribute
    {
        return Attribute::get(function () {
            return Carbon::parse($this->getRawOriginal('created_at'))->format('d-m-Y h:iA');
        });
    }

    public function hasAttachment(): Attribute
    {
        return Attribute::get(function () {
            return $this->attachment !== null;
        });
    }

    public function attachmentUrl(): Attribute
    {
        return Attribute::get(fn() => $this->attachment !== null ? url($this->attachment) : null);
    }

    public function totalPriceWithoutTax(): Attribute
    {
        return Attribute::get(function () {
            return (float)$this->demandUnits?->sum(function ($demandUnit) {
                return $demandUnit->price * $demandUnit->demandUnit?->quantity;
            });
        });
    }

    public function totalPrice(): Attribute
    {
        return Attribute::get(function () {
            return (float)number_format($this->total_price_without_tax * (1 + $this->tax?->value), 2, '.', '');
        });
    }

    public function userName(): Attribute
    {
        return Attribute::get(function () {
            return $this->user !== null ? $this->user->name : __('general.deleted user');
        });
    }

    public function isSpecial(): Attribute
    {
        return Attribute::set(function ($value) {
            return
                auth('api')->user()?->company?->can_make_special_offer
                && !auth('api')->user()?->company?->is_current_package_fallback
                && !$this->purchaseOrder?->is_already_special_offered
                    ? $value
                    : false;
        });
    }

    public function isSpecialValue(): Attribute
    {
        return Attribute::get(function ($value) {
            if ($this->is_special == '1')
                return __('dashboard.Yes');
            else
                return __('dashboard.No');
        });
    }

    public function isApprovedValue(): Attribute
    {
        return Attribute::get(function ($value) {
            if ($this->is_approved == '1')
                return __('dashboard.Yes');
            else
                return __('dashboard.No');
        });
    }

    public function tax()
    {
        return $this->belongsTo(PurchaseOrderTax::class, 'purchase_order_tax_id');
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function demandUnits()
    {
        return $this->hasMany(PurchaseOrderDemandUnitOffer::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
