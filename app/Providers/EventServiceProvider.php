<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderOffer;
use App\Models\User;
use App\Models\PurchaseOrderInquiry;
use App\Models\Subscription;
use App\Models\Complaint;
use App\Models\ContactUs;
use App\Observers\ContactUsObserver;
use App\Observers\ComplaintObserver;
use App\Observers\SubscriptionObserver;
use App\Observers\PurchaseOrderInquiryObserver;
use App\Observers\PurchaseOrderObserver;
use App\Observers\PurchaseOrderOfferObserver;
use App\Observers\CompanyObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    protected $observers = [
        Company::class => [CompanyObserver::class],
        PurchaseOrder::class => [PurchaseOrderObserver::class],
        PurchaseOrderOffer::class => [PurchaseOrderOfferObserver::class],
        User::class => [UserObserver::class],
        PurchaseOrderInquiry::class => [PurchaseOrderInquiryObserver::class],
        Subscription::class => [SubscriptionObserver::class],
        Complaint::class => [ComplaintObserver::class],
        ContactUs::class => [ContactUsObserver::class],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
