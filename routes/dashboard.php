<?php

use App\Http\Controllers\Dashboard\Structure\AboutController;
use App\Http\Controllers\Dashboard\Structure\ExplanationOfUseBuyerController;
use App\Http\Controllers\Dashboard\Structure\ExplanationOfUseController;
use App\Http\Controllers\Dashboard\Structure\ExplanationOfUseSupplierController;
use App\Http\Controllers\Dashboard\Structure\FaqController;
use App\Http\Controllers\Dashboard\Structure\TermsAndConditionsController;
use App\Http\Enums\CompanyType;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Home\HomeController;
use App\Http\Controllers\Dashboard\Country\CountryController;
use App\Http\Controllers\Dashboard\Country\CityController;
use App\Http\Controllers\Dashboard\Field\FieldController;
use App\Http\Controllers\Dashboard\Tax\TaxController;
use App\Http\Controllers\Dashboard\UnitType\UnitTypeController;
use App\Http\Controllers\Dashboard\Company\CompanyController;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Http\Controllers\Dashboard\PurchaseOrder\PurchaseOrderController;
use App\Http\Controllers\Dashboard\PurchaseOrder\PurchaseOrderOfferController;
use App\Http\Controllers\Dashboard\PurchaseOrder\PurchaseOrderInquiryController;
use App\Http\Controllers\Dashboard\PurchaseOrder\PurchaseOrderDemandUnitController;
use App\Http\Controllers\Dashboard\PurchaseOrder\PurchaseOrderDemandUnitOfferController;
use App\Http\Controllers\Dashboard\Packages\PackageController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\Subscription\SubscriptionController;
use App\Http\Controllers\Dashboard\LoyaltyPoint\LoyaltyPointController;
use App\Http\Controllers\Dashboard\LoyaltyPoint\LoyaltyPointSettingController;
use App\Http\Controllers\Dashboard\Mangers\MangerController;
use App\Http\Controllers\Dashboard\Roles\RoleController;
use App\Http\Controllers\Dashboard\Settings\SettingController;
use App\Http\Controllers\Dashboard\Structure\InfoController;
use App\Http\Controllers\Dashboard\Complaint\ComplaintController;
use App\Http\Controllers\Dashboard\ContactUs\ContactUsController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', [AuthController::class, '_login'])->name('_login');

        Route::post('login', [AuthController::class, 'login'])->name('login');

        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/',[HomeController::class,'index'])->name('/');
        Route::get('country/{country}/cities',[CountryController::class,'cities'])->name('country.cities');
        Route::resource('countries',CountryController::class)->except('show');
        Route::resource('cities',CityController::class)->except('show','index');
        Route::get('fields/toggle',[FieldController::class,'toggle'])->name('toggleField');
        Route::resource('fields',FieldController::class)->except('show');
        Route::get('taxes/toggle',[TaxController::class,'toggle'])->name('toggleTax');
        Route::resource('taxes',TaxController::class)->except('show');
        Route::resource('unit-types',UnitTypeController::class)->except('show');
        Route::get('companies/{company}/users',[CompanyController::class,'users'])->name('companies.users');
        Route::get('companies/toggle',[CompanyController::class,'toggle'])->name('toggleCompany');
        Route::get('users/toggle',[UserController::class,'toggle'])->name('toggleUser');
        Route::get('companies/suppliers',[CompanyController::class, 'suppliersIndex'])->name('companies.suppliers');
        Route::get('companies/buyers',[CompanyController::class, 'buyersIndex'])->name('companies.buyers');
        Route::resource('companies',CompanyController::class)->whereIn('type', CompanyType::values())->except(['index']);
        Route::resource('users',UserController::class)->except('index');
        Route::resource('purchase-orders',PurchaseOrderController::class)->except('create','store');
        Route::resource('offers',PurchaseOrderOfferController::class)->only(['index', 'show', 'destroy']);
        Route::put('offers/{offer}/approve',[PurchaseOrderOfferController::class,'approve'])->name('offers.approve');
        Route::resource('inquiries',PurchaseOrderInquiryController::class)->only(['index', 'show', 'destroy']);
        Route::put('inquiries/{inquiry}/approve',[PurchaseOrderInquiryController::class,'approve'])->name('inquiries.approve');
        Route::delete('demand-unit/{unit}',[PurchaseOrderDemandUnitController::class,'destroy'])->name('demand-units.destroy');
        Route::delete('offer/demand-unit/{unit}',[PurchaseOrderDemandUnitOfferController::class,'destroy'])->name('offer-demand-units.destroy');
        Route::get('packages/toggle',[PackageController::class,'toggle'])->name('togglePackage');
        Route::resource('packages',PackageController::class);
        Route::resource('payments',PaymentController::class)->only('index','show','update');
        Route::group(['prefix' => 'structures'], function () {
            Route::resource('home-content', \App\Http\Controllers\Dashboard\Structure\HomeController::class)->only(['index', 'store']);
            Route::resource('about-content', AboutController::class)->only(['index', 'store']);
            Route::resource('faqs-content', FaqController::class)->only(['index', 'store']);
            Route::resource('terms-and-conditions-content', TermsAndConditionsController::class)->only(['index', 'store']);
            Route::resource('explanation-of-use-content', ExplanationOfUseController::class)->only(['index', 'store']);
            Route::resource('explanation-of-use-buyer-content', ExplanationOfUseBuyerController::class)->only(['index', 'store']);
            Route::resource('explanation-of-use-supplier-content', ExplanationOfUseSupplierController::class)->only(['index', 'store']);
            Route::resource('infos', InfoController::class)->only(['index', 'store']);
            Route::resource('packages-content', \App\Http\Controllers\Dashboard\Structure\PackageController::class)->only(['index', 'store']);
        });
        Route::get('subscriptions/toggle',[SubscriptionController::class,'toggle'])->name('toggleSubscription');
        Route::resource('subscriptions',SubscriptionController::class)->only('index','edit','update');
        Route::resource('loyalty-points-settings',LoyaltyPointSettingController::class)->only('index','update','edit');
        Route::resource('loyalty-points',LoyaltyPointController::class)->only('index','update','show');
        Route::resource('managers',MangerController::class)->except('show','index');
        Route::resource('roles',RoleController::class);
        Route::get('role/{id}/managers',[RoleController::class,'mangers'])->name('roles.mangers');
        Route::resource('settings' , SettingController::class)->only('edit','update');
        Route::post('update-password' , [SettingController::class,'updatePassword'])->name('update-password');
        Route::resource('complaints', ComplaintController::class)->only(['index', 'show', 'destroy']);
        Route::resource('contact-us', ContactUsController::class)->only(['index', 'show', 'destroy']);
    });

    // Route::get('test',function(){

    //     $users = App\Models\User::withWhereHas('company', function ($query) {
    //         $query->where('type', 'buyer');
    //         $query->withWhereHas('purchaseOrders',function($query){
    //             $query->where('status', 'available');
    //             $query->withCount('publishedOffers');
    //             $query->withCount('publishedNotRepliedInquires');
    //         });
    //     })->first();

    //     // foreach($users as $user)
    //     // {
    //     //     Mail::to($user->email)->send(new App\Mail\BuyerReportWeekly($user));
    //     // }
    //     return $users->company->purchaseOrders;
    // });

   Route::get('sstest',function(){
       $order = \App\Models\PurchaseOrderOffer::find(4);
       $order->update(['is_approved' => 1]);
       return "done";
   });

});
