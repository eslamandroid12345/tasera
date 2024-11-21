<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\City;
use App\Models\Country;
use App\Models\Field;
use App\Models\Manager;
use App\Models\Package;
use App\Models\PurchaseOrderDemandUnit;
use App\Models\PurchaseOrderDemandUnitType;
use App\Models\PurchaseOrderTax;
use Illuminate\Auth\Access\Response;
use App\Http\Enums\CompanyType;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('delete-country', function (Manager $user,Country $country) {
            return !$country->cities()->exists() ? Response::allow() : Response::deny();
        });
        Gate::define('delete-city', function (Manager $user,City $city) {
            return !$city->companies()->exists() ? Response::allow() : Response::deny();
        });
        Gate::define('delete-field', function (Manager $user,Field $field) {
            return !$field->companies()->exists()&&!$field->purchaseOrders()->exists() ? Response::allow() : Response::deny();
        });
        Gate::define('delete-tax', function (Manager $user,PurchaseOrderTax $tax) {
            return !$tax->offers()->exists()? Response::allow() : Response::deny();
        });
        Gate::define('inquire-purchase-order', function ($user) {
            return auth('api')->user()?->company?->type == CompanyType::SUPPLIER->value;
        });
        Gate::define('delete-package', function ($user,Package $package) {
            return !$package->is_fallback;
        });

        Gate::define('offer-purchase-order', function ($user, $purchaseOrder) {
            return !$purchaseOrder->is_already_offered;
        });

        Gate::define('can-subscribe', function ($user) {
            return auth('api')->user()?->company?->can_subscribe;
        });

        Gate::define('access-loyalty-points', function ($user) {
            return auth('api')->user()->company?->has_loyalty_points;
        });
        Gate::define('delete-role', function ($user, $role) {
            return  $role->managers->count() == 0;
        });
        Gate::define('delete-manager',function ($user,$manager){
            return $user->id!=$manager->id ? Response::allow():Response::denyWithStatus(401);
        });
    }
}
