<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Company\CompanyController;
use App\Http\Controllers\Api\V1\Complaint\ComplaintController;
use App\Http\Controllers\Api\V1\ContactUs\ContactUsController;
use App\Http\Controllers\Api\V1\Country\CountryController;
use App\Http\Controllers\Api\V1\Field\FieldController;
use App\Http\Controllers\Api\V1\LoyaltyPoint\LoyaltyPointController;
use App\Http\Controllers\Api\V1\Package\PackageController;
use App\Http\Controllers\Api\V1\PurchaseOrder\PurchaseOrderBuyerController;
use App\Http\Controllers\Api\V1\PurchaseOrder\PurchaseOrderController;
use App\Http\Controllers\Api\V1\PurchaseOrder\PurchaseOrderDemandUnitTypeController;
use App\Http\Controllers\Api\V1\PurchaseOrder\PurchaseOrderSupplierController;
use App\Http\Controllers\Api\V1\PurchaseOrder\PurchaseOrderTaxController;
use App\Http\Controllers\Api\V1\Structure\AboutController;
use App\Http\Controllers\Api\V1\Structure\ExplanationOfUseBuyerController;
use App\Http\Controllers\Api\V1\Structure\ExplanationOfUseSupplierController;
use App\Http\Controllers\Api\V1\Structure\InfosController;
use App\Http\Controllers\Api\V1\Structure\ExplanationOfUseController;
use App\Http\Controllers\Api\V1\Structure\FaqController;
use App\Http\Controllers\Api\V1\Structure\HomeController;
use App\Http\Controllers\Api\V1\Structure\TermsAndConditionsController;
use App\Http\Controllers\Api\V1\Subscription\SubscriptionController;
use App\Http\Controllers\Api\V1\NewSubscription\NewSubscriptionController;
use App\Http\Controllers\Api\V1\User\UserController;
use App\Http\Enums\CompanyType;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::group(['prefix' => 'sign'], function () {
        Route::post('in', 'signIn');
        Route::group(['prefix' => 'up'], function () {
            Route::group(['prefix' => 'otp'], function () {
                Route::post('/', 'sendSignUpOtp');
                Route::post('verify', 'verifySignUpOtp');
            });
            Route::post('{user:type}', 'signUp')->whereIn('user', CompanyType::values());
        });
        Route::post('out', 'signOut');
    });

    Route::group(['prefix' => 'reset'], function () {
        Route::post('/', 'sendResetPasswordOtp');
        Route::post('{token}/verify', 'verifyResetPasswordOtp');
        Route::post('{token}/verified', 'resetPassword');
    });
});

Route::group(['prefix' => 'profile'], function () {
    Route::group(['controller' => UserController::class], function () {
        Route::get('details', 'getDetails');
        Route::group(['prefix' => 'update'], function () {
            Route::group(['prefix' => 'user'], function () {
                Route::put('data', 'updateMainData');
                Route::put('password', 'updatePassword');
            });
        });
        Route::group(['prefix' => 'create'], function () {
            Route::post('sub-user', 'createSubUser');
        });
    });

    Route::group(['controller' => CompanyController::class], function () {
        Route::group(['prefix' => 'update'], function () {
            Route::group(['prefix' => 'company'], function () {
                Route::post('metadata', 'updateMetadata');
                Route::put('info', 'updateInfo');
                Route::put('fields', 'updateFields');
            });
        });
    });
});

Route::group([
    'prefix' => 'global',
], function () {
    Route::group(
        ['prefix' => 'pages'],
        function () {
            Route::group(['prefix' => 'home'], function () {
                Route::get('/', HomeController::class);
                Route::get('latest-purchase-orders', [PurchaseOrderController::class, 'getLatestPurchaseOrders']);
            });
            Route::get('terms-and-conditions', TermsAndConditionsController::class);
            Route::get('explanation-of-use', ExplanationOfUseController::class);
            Route::get('explanation-of-use-buyer', ExplanationOfUseBuyerController::class);
            Route::get('explanation-of-use-supplier', ExplanationOfUseSupplierController::class);
            Route::get('about-us', AboutController::class);
            Route::get('faqs', FaqController::class);
            Route::get('infos',InfosController::class);
            Route::get('packages',\App\Http\Controllers\Api\V1\Structure\PackageController::class);
        }
    );

    Route::group(['prefix' => 'info'], function () {
        Route::get('fields', [FieldController::class, 'getInfo']);
        Route::get('countries', [CountryController::class, 'getInfo']);
        Route::group(['prefix' => 'purchase-orders'], function () {
            Route::get('demand-units/types', [PurchaseOrderDemandUnitTypeController::class, 'getInfo']);
            Route::get('taxes', [PurchaseOrderTaxController::class, 'getInfo']);
        });
    });

    Route::group(['prefix' => 'purchase-orders', 'controller' => PurchaseOrderController::class], function () {
        Route::post('/', 'getFilteredPurchaseOrders');
        Route::get('{reference_id}', 'show');
    });

    Route::post('complaint', [ComplaintController::class, 'create']);

    Route::post('contact-us', [ContactUsController::class, 'create']);

    Route::group(['prefix' => 'loyalty-points', 'controller' => LoyaltyPointController::class], function () {
        Route::get('/', 'show');
    });
});

Route::group([
    'prefix' => 'buyer',
    'middleware' => 'only:'.CompanyType::BUYER->value
], function () {
    Route::group(['prefix' => 'companies/{reference_id}', 'controller' => CompanyController::class], function () {
        Route::get('/', 'show');
    });
    Route::group(['prefix' => 'my'], function () {
        Route::group(['prefix' => 'purchase-orders', 'controller' => PurchaseOrderBuyerController::class], function () {
            Route::post('/', 'getFilteredPurchaseOrders');
            Route::get('statistics', 'getMyStatistics');
            Route::post('create', 'create');
            Route::group(['prefix' => '{reference_id}'], function () {
                Route::post('update', 'update');
                Route::get('/', 'show');
                Route::post('delay', 'delay');
                Route::post('approve', 'approve');
                Route::group(['prefix' => 'inquiries'], function () {
                    Route::post('{inquiry:id}/reply', 'replyInquiry');
                });

            });
        });
    });
});

Route::group([
    'prefix' => 'supplier',
    'middleware' => 'only:'.CompanyType::SUPPLIER->value
], function () {
    Route::group(['prefix' => 'purchase-orders/offers', 'controller' => PurchaseOrderSupplierController::class], function () {
        Route::post('/', 'getMyFilteredOffers');
        Route::get('statistics', 'getMyStatistics');
        Route::group(['prefix' => '{reference_id}'], function () {
            Route::get('/', 'show');
            Route::post('offer', 'offer');
            Route::group(['prefix' => 'inquiries'], function () {
                Route::post('/', 'inquire');
            });
        });
    });
    Route::group(['prefix' => 'packages', 'controller' => PackageController::class], function () {
        Route::get('/', 'getPackages');
    });
    Route::group(['prefix' => 'subscriptions', 'controller' => SubscriptionController::class], function () {
        Route::post('initiate', 'initiate');
        Route::get('details', 'getDetails');
    });

    Route::group(['prefix' => 'new-subscriptions', 'controller' => NewSubscriptionController::class], function () {
        Route::post('send-details', 'sendDetails');
    });
});
//
