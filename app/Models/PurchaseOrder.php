<?php

namespace App\Models;

use App\Http\Enums\CompanyType;
use App\Http\Enums\PurchaseOrderStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $guarded = [];

    public function remainingDays() : Attribute {
        return Attribute::get(function () {
            $originalClosesAt = $this->getRawOriginal('closes_at');
            return Carbon::parse($originalClosesAt)->isFuture()
                ? Carbon::parse($originalClosesAt)->diffInDays(Carbon::now())
                : 0;
        });
    }

    public function remainingSeconds() : Attribute {
        return Attribute::get(function () {
            $originalClosesAt = $this->getRawOriginal('closes_at');
            return Carbon::parse($originalClosesAt)->isFuture()
                ? Carbon::parse($originalClosesAt)->diffInSeconds(Carbon::now())
                : 0;
        });
    }

    public function offersCount() : Attribute {
        return Attribute::get(function () {
            return $this->publishedOffers?->count();
        });
    }

    public function viewsCount() : Attribute {
        return Attribute::get(function () {
            return $this->views()?->count();
        });
    }

    public function publishedAt() : Attribute
    {
        return Attribute::get(function () {
            return Carbon::parse($this->created_at)->format('d M, Y');
        });
    }

    public function fullPublishedAt() : Attribute
    {
        return Attribute::get(function () {
            return Carbon::parse($this->created_at)->format('d-m-Y h:iA');
        });
    }

    public function closesAt() : Attribute
    {
        return Attribute::get(function ($value) {
            return Carbon::parse($value)->format('d M, Y');
        });
    }

    public function closesAtValue() : Attribute
    {
        return Attribute::get(function () {
            return $this->getRawOriginal('closes_at');
        });
    }

    public function userName() : Attribute
    {
        return Attribute::get(function () {
            return $this->user !== null ? $this->user->name : __('general.deleted user');
        });
    }
    public function typeValue() : Attribute
    {
        return Attribute::get(function () {
            if($this->type=='direct_purchase')
                return __('dashboard.direct_purchase');
            else
                return __('dashboard.tender');

        });
    }
    public function statusValue() : Attribute
    {
        return Attribute::get(function () {
            return PurchaseOrderStatus::from($this->status)->t();
        });
    }

    public function isAlreadyOffered() : Attribute
    {
        return Attribute::get(function () {
            if (auth('api')?->user()?->company?->type == CompanyType::SUPPLIER->value) {
                return $this->offers?->contains('company_id', auth('api')?->user()?->company_id);
            }

            return null;
        });
    }

    public function isAlreadySpecialOffered() : Attribute
    {
        return Attribute::get(function () {
            return $this->offers?->contains('is_special', true);
        });
    }

    public function isAlreadyViewed() : Attribute
    {
        return Attribute::get(function () {
            if (auth('api')?->user()?->company?->type == CompanyType::SUPPLIER->value) {
                return $this->views?->contains('company_id', auth('api')?->user()?->company_id);
            }

            return null;
        });
    }

    public function showDetails() : Attribute
    {
        return Attribute::get(function () {
            return auth('api')?->check();
        });
    }

    public function isMine() : Attribute
    {
        return Attribute::get(function () {
            return auth('api')?->check() && auth('api')?->user()?->company_id == $this->company_id;
        });
    }

    public function isEditable() : Attribute
    {
        return Attribute::get(function () {
            return $this->offers?->count() == 0 && $this->company_id == auth('api')?->user()?->company_id && PurchaseOrderStatus::isEditable($this->status);
        });
    }

    public function isDelayable() : Attribute
    {
        return Attribute::get(function () {
            return $this->company_id == auth('api')?->user()?->company_id && PurchaseOrderStatus::isDelayable($this->status);
        });
    }

    public function isApprovable() : Attribute
    {
        return Attribute::get(function () {
            return $this->company_id == auth('api')?->user()?->company_id && PurchaseOrderStatus::isApprovable($this->status) && !$this->offers?->contains('is_approved', true);
        });
    }

    public function isOfferable() : Attribute
    {
        return Attribute::get(function () {
            return auth('api')?->user()?->company?->type == CompanyType::SUPPLIER->value && !$this->is_already_offered && PurchaseOrderStatus::isOfferable($this->status);
        });
    }

    public function isInquirable() : Attribute
    {
        return Attribute::get(function () {
            return auth('api')?->user()?->company?->type == CompanyType::SUPPLIER->value;
        });
    }

    public function scopeMine(Builder $query)
    {
        $query->where('company_id', auth('api')?->user()?->company?->id);
    }

    public function demandUnits() {
        return $this->hasMany(PurchaseOrderDemandUnit::class);
    }

    public function fields() {
        return $this->belongsToMany(Field::class, 'field_purchase_order');
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views() {
        return $this->hasMany(PurchaseOrderView::class);
    }

    public function offers()
    {
        return $this->hasMany(PurchaseOrderOffer::class);
    }

    public function publishedOffers()
    {
        return $this->offers()->where('is_published', true)->orderByDesc('is_special');
    }

    public function approvedOffer()
    {
        return $this->hasOne(PurchaseOrderOffer::class)->where('is_approved', true);
    }

    public function deliveryCity()
    {
        return $this->belongsTo(City::class, 'delivery_city_id');
    }

    public function inquiries()
    {
        return $this->hasMany(PurchaseOrderInquiry::class)->isComment();
    }

    public function publishedInquiries()
    {
        return $this->hasMany(PurchaseOrderInquiry::class)->where('is_published', true)->isComment();
    }

    public function publishedNotRepliedInquires()
    {
        return $this->publishedInquiries()->whereDoesntHave('publishedReply');
    }
}
