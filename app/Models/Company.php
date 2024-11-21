<?php

namespace App\Models;

use App\Http\Enums\CompanyType;
use App\Http\Enums\PaymentStatus;
use App\Http\Enums\PurchaseOrderStatus;
use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use LanguageToggle, HasFactory;

    protected $guarded = [];
    protected $casts = [
        'is_tax_exempt' => 'boolean',
        'has_loyalty_points' => 'boolean'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function logoUrl(): Attribute
    {
        return Attribute::get(fn() => $this->logo !== null ? url($this->logo) : null);
    }


    public function authorizationApprovalFileUrl(): Attribute
    {
        return Attribute::get(fn() => $this->authorization_approval_file !== null ? url($this->authorization_approval_file) : null);
    }

    public function commercialRegistrationImageUrl(): Attribute
    {
        return Attribute::get(fn() => $this->commercial_registration_image !== null ? url($this->commercial_registration_image) : null);
    }

    public function taxRegistrationImageUrl(): Attribute
    {
        return Attribute::get(fn() => $this->tax_registration_image !== null ? url($this->tax_registration_image) : null);
    }

    public function bankDetailsFileUrl(): Attribute
    {
        return Attribute::get(fn() => $this->bank_details_file !== null ? url($this->bank_details_file) : null);
    }

    public function achievementsFileUrl(): Attribute
    {
        return Attribute::get(fn() => $this->achievements_file !== null ? url($this->achievements_file) : null);
    }

    public function underReviewPurchaseOrdersCount(): Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::BUYER->value)
                return $this->purchaseOrders()?->where('status', PurchaseOrderStatus::UNDER_REVIEW)?->count();

            return null;
        });
    }

    public function availablePurchaseOrdersCount(): Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::BUYER->value)
                return $this->purchaseOrders()?->where('status', PurchaseOrderStatus::AVAILABLE->value)?->count();

            return null;
        });
    }

    public function canceledPurchaseOrdersCount(): Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::BUYER->value)
                return $this->purchaseOrders()?->where('status', PurchaseOrderStatus::CANCELED)?->count();

            return null;
        });
    }

    public function expiredPurchaseOrdersCount(): Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::BUYER->value)
                return $this->purchaseOrders()?->where('status', PurchaseOrderStatus::EXPIRED)?->count();

            return null;
        });
    }

    public function approvedPurchaseOrdersCount(): Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::BUYER->value)
                return $this->purchaseOrders()?->where('status', PurchaseOrderStatus::APPROVED)?->count();

            return null;
        });
    }

    public function submittedOffersCount() : Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::SUPPLIER->value)
                return $this->offers()?->count();

            return null;
        });
    }

    public function approvedOffersCount() : Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::SUPPLIER->value)
                return $this->offers()?->where('is_approved', true)->count();

            return null;
        });
    }

    public function usedSpecialOffersCount() : Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::SUPPLIER->value)
                return $this->offers()->where('is_special', true)->count();

            return null;
        });
    }

    public function remainingSpecialOffersCount(): Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::SUPPLIER->value)
                return $this->activeSubscription?->package?->special_offers !== null
                    ? $this->activeSubscription?->package?->special_offers - $this->offers()->where('is_special', true)->count()
                    : INF;

            return null;
        });
    }

    public function remainingSpecialOffersHumanizedCount(): Attribute
    {
        return Attribute::get(function () {
            return $this->remaining_special_offers_count == INF ? __('general.unlimited') : $this->remaining_special_offers_count;
        });
    }

    public function isCurrentPackageFallback() : Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::SUPPLIER->value)
                return $this->activeSubscription?->package?->is_fallback;

            return null;
        });
    }

    public function canMakeSpecialOffer(): Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::SUPPLIER->value)
                return $this->remaining_special_offers_count > 0;

            return null;
        });
    }

    public function showSpecialOffers(): Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::SUPPLIER->value)
                return $this->activeSubscription?->package?->special_offers > 0;

            return null;
        });
    }

    public function canAddSubUser(): Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::SUPPLIER->value)
                return $this->activeSubscription?->package?->can_add_sub_user;

            return null;
        });
    }

    public function isVerified(): Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::SUPPLIER->value)
                return $this->activeSubscription?->package?->has_verified_badge;

            return false;
        });
    }

    public function canViewCompanyFile(): Attribute
    {
        return Attribute::get(function () {
            if ($this->type == CompanyType::SUPPLIER->value)
                return $this->activeSubscription?->package?->can_view_company_file;

            return null;
        });
    }

    public function canSubscribe(): Attribute
    {
        return Attribute::get(function () {
            return
                $this->type == CompanyType::SUPPLIER->value
                && (
                    $this->activeSubscription?->package?->is_fallback
                    && !$this->nonFallbackSubscriptions?->contains('is_active', true)
                    && !$this->awaitingSubscriptions()->exists()
                );
        });
    }

    public function isSubscribed() : Attribute
    {
        return Attribute::get(function () {
            return !$this->can_subscribe;
        });
    }

    public function totalLoyaltyPoints() : Attribute
    {
        return Attribute::get(function () {
            return $this->has_loyalty_points ? $this->loyaltyPoints?->sum('points') : null;
        });
    }

    public function typeValue() : Attribute
    {
        return Attribute::get(function () {
            if($this->type=='supplier')
                return __('dashboard.supplier');
            else
                return __('dashboard.buyer');
        });
    }

    public function isTaxValue() : Attribute
    {
        return Attribute::get(function () {
            if($this->type=='1')
                return __('dashboard.Yes');
            else
                return __('dashboard.No');
        });
    }

    public function fields()
    {
        return $this->belongsToMany(Field::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function views()
    {
        return $this->hasMany(PurchaseOrderView::class);
    }

    public function offers()
    {
        return $this->hasMany(PurchaseOrderOffer::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)->where('is_active', true)->latest();
    }

    public function nonFallbackSubscriptions()
    {
        return $this->subscriptions()->whereHas('package', fn ($query) => $query->where('is_fallback', false));
    }

    public function awaitingSubscriptions()
    {
        return $this->subscriptions()->where('is_active', false)->whereNull('ends_at')->whereHas('payment', fn ($query) => $query->where('status', PaymentStatus::BEING_REVIEWED->value));
    }

    public function referralCompany()
    {
        return $this->belongsTo(Company::class, 'referral_company_id');
    }

    public function loyaltyPoints()
    {
        return $this->hasMany(LoyaltyPoint::class, 'company_id');
    }
}
