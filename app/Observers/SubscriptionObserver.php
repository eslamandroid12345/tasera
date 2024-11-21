<?php

namespace App\Observers;
use App\Repository\SubscriptionRepositoryInterface;
use App\Models\Subscription;
use App\Mail\SubscriptionMail;
use Mail;
use App\Repository\StructureRepositoryInterface;

class SubscriptionObserver
{
    /**
     * Handle the Subscription "created" event.
     */
    public function __construct(
        private readonly SubscriptionRepositoryInterface $subscriptionRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    )
    {
    }

    public function created(Subscription $subscription): void
    {
        if($subscription->ends_at !==null && $subscription->is_active == 1 && !$subscription->package->is_fallback)
        {

            foreach($subscription->company->users as $user)
            {
                $infos = json_decode($this->structureRepository->structure('infos')->content, true);
                $details = [
                                'infos' => $infos,
                                'package' => $subscription->package,
                                'user' => $user,
                            ];
                Mail::to($user->email)->send(new SubscriptionMail($details));
            }
        }
    }

    /**
     * Handle the Subscription "updated" event.
     */
    public function updated(Subscription $subscription): void
    {

    }

    /**
     * Handle the Subscription "deleted" event.
     */
    public function deleted(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "restored" event.
     */
    public function restored(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "force deleted" event.
     */
    public function forceDeleted(Subscription $subscription): void
    {
        //
    }
}
