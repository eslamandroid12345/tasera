<?php

namespace App\Providers;

use App\Repository\CityRepositoryInterface;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\ComplaintRepositoryInterface;
use App\Repository\ContactUsRepositoryInterface;
use App\Repository\CountryRepositoryInterface;
use App\Repository\Eloquent\CityRepository;
use App\Repository\Eloquent\CompanyRepository;
use App\Repository\Eloquent\ComplaintRepository;
use App\Repository\Eloquent\ContactUsRepository;
use App\Repository\Eloquent\CountryRepository;
use App\Repository\Eloquent\FieldPurchaseOrderRepository;
use App\Repository\Eloquent\FieldRepository;
use App\Repository\Eloquent\FieldUserRepository;
use App\Repository\Eloquent\LoyaltyPointRepository;
use App\Repository\Eloquent\LoyaltyPointsSettingRepository;
use App\Repository\Eloquent\ManagerRepository;
use App\Repository\Eloquent\OtpRepository;
use App\Repository\Eloquent\PackageRepository;
use App\Repository\Eloquent\PasswordResetTokenRepository;
use App\Repository\Eloquent\PaymentRepository;
use App\Repository\Eloquent\PermissionRepository;
use App\Repository\Eloquent\PurchaseOrderDemandUnitOfferRepository;
use App\Repository\Eloquent\PurchaseOrderDemandUnitRepository;
use App\Repository\Eloquent\PurchaseOrderDemandUnitTypeRepository;
use App\Repository\Eloquent\PurchaseOrderInquiryRepository;
use App\Repository\Eloquent\PurchaseOrderOfferRepository;
use App\Repository\Eloquent\PurchaseOrderRepository;
use App\Repository\Eloquent\PurchaseOrderTaxRepository;
use App\Repository\Eloquent\PurchaseOrderViewRepository;
use App\Repository\Eloquent\Repository;
use App\Repository\Eloquent\RoleRepository;
use App\Repository\Eloquent\StructureRepository;
use App\Repository\Eloquent\SubscriptionRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\FieldPurchaseOrderRepositoryInterface;
use App\Repository\FieldRepositoryInterface;
use App\Repository\FieldUserRepositoryInterface;
use App\Repository\LoyaltyPointRepositoryInterface;
use App\Repository\LoyaltyPointsSettingRepositoryInterface;
use App\Repository\ManagerRepositoryInterface;
use App\Repository\OtpRepositoryInterface;
use App\Repository\PackageRepositoryInterface;
use App\Repository\PasswordResetTokenRepositoryInterface;
use App\Repository\PaymentRepositoryInterface;
use App\Repository\PermissionRepositoryInterface;
use App\Repository\PurchaseOrderDemandUnitOfferRepositoryInterface;
use App\Repository\PurchaseOrderDemandUnitRepositoryInterface;
use App\Repository\PurchaseOrderDemandUnitTypeRepositoryInterface;
use App\Repository\PurchaseOrderInquiryRepositoryInterface;
use App\Repository\PurchaseOrderOfferRepositoryInterface;
use App\Repository\PurchaseOrderRepositoryInterface;
use App\Repository\PurchaseOrderTaxRepositoryInterface;
use App\Repository\PurchaseOrderViewRepositoryInterface;
use App\Repository\RepositoryInterface;
use App\Repository\RoleRepositoryInterface;
use App\Repository\StructureRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RepositoryInterface::class, Repository::class);
        $this->app->singleton(CityRepositoryInterface::class, CityRepository::class);
        $this->app->singleton(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->singleton(FieldRepositoryInterface::class, FieldRepository::class);
        $this->app->singleton(FieldUserRepositoryInterface::class, FieldUserRepository::class);
        $this->app->singleton(FieldPurchaseOrderRepositoryInterface::class, FieldPurchaseOrderRepository::class);
        $this->app->singleton(PurchaseOrderRepositoryInterface::class, PurchaseOrderRepository::class);
        $this->app->singleton(PurchaseOrderDemandUnitRepositoryInterface::class, PurchaseOrderDemandUnitRepository::class);
        $this->app->singleton(PurchaseOrderDemandUnitTypeRepositoryInterface::class, PurchaseOrderDemandUnitTypeRepository::class);
        $this->app->singleton(PackageRepositoryInterface::class, PackageRepository::class);
        $this->app->singleton(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->singleton(PurchaseOrderDemandUnitOfferRepositoryInterface::class, PurchaseOrderDemandUnitOfferRepository::class);
        $this->app->singleton(PurchaseOrderOfferRepositoryInterface::class, PurchaseOrderOfferRepository::class);
        $this->app->singleton(PurchaseOrderViewRepositoryInterface::class, PurchaseOrderViewRepository::class);
        $this->app->singleton(SubscriptionRepositoryInterface::class, SubscriptionRepository::class);
        $this->app->singleton(PurchaseOrderTaxRepositoryInterface::class, PurchaseOrderTaxRepository::class);
        $this->app->singleton(PurchaseOrderInquiryRepositoryInterface::class, PurchaseOrderInquiryRepository::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->singleton(OtpRepositoryInterface::class, OtpRepository::class);
        $this->app->singleton(LoyaltyPointRepositoryInterface::class, LoyaltyPointRepository::class);
        $this->app->singleton(LoyaltyPointsSettingRepositoryInterface::class, LoyaltyPointsSettingRepository::class);
        $this->app->singleton(StructureRepositoryInterface::class, StructureRepository::class);
        $this->app->singleton(ManagerRepositoryInterface::class, ManagerRepository::class);
        $this->app->singleton(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->singleton(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->singleton(ContactUsRepositoryInterface::class, ContactUsRepository::class);
        $this->app->singleton(ComplaintRepositoryInterface::class, ComplaintRepository::class);
        $this->app->singleton(PasswordResetTokenRepositoryInterface::class, PasswordResetTokenRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
