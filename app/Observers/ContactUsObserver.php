<?php

namespace App\Observers;

use App\Models\ContactUs;
use App\Repository\StructureRepositoryInterface;
use App\Repository\ManagerRepositoryInterface;
use Mail;
use App\Mail\NewContactUs;
class ContactUsObserver
{
    /**
     * Handle the ContactUs "created" event.
     */
    public function __construct(
        private readonly ManagerRepositoryInterface $managerRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    )
    {
    }

    public function created(ContactUs $contactUs): void
    {
        $emailmngers = $this->managerRepository->getmanagersSendEmail();
        if(count($emailmngers) > 0)
        {
            $infos = json_decode($this->structureRepository->structure('infos')->content, true);
            $details = [
                            'user' => $contactUs->name,
                            'infos' => $infos,
                        ];
            foreach($emailmngers as $emailmnger)
            {
                Mail::to($emailmnger->email)->send(new NewContactUs($details));
            }
        }
    }

    /**
     * Handle the ContactUs "updated" event.
     */
    public function updated(ContactUs $contactUs): void
    {
        //
    }

    /**
     * Handle the ContactUs "deleted" event.
     */
    public function deleted(ContactUs $contactUs): void
    {
        //
    }

    /**
     * Handle the ContactUs "restored" event.
     */
    public function restored(ContactUs $contactUs): void
    {
        //
    }

    /**
     * Handle the ContactUs "force deleted" event.
     */
    public function forceDeleted(ContactUs $contactUs): void
    {
        //
    }
}
