<?php

namespace App\Observers;
use App\Repository\StructureRepositoryInterface;
use App\Repository\ManagerRepositoryInterface;
use App\Models\Complaint;
use Mail;
use App\Mail\NewComplaint;

class ComplaintObserver
{
    /**
     * Handle the Complaint "created" event.
     */
    public function __construct(
        private readonly ManagerRepositoryInterface $managerRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    )
    {
    }

    public function created(Complaint $complaint): void
    {
        $emailmngers = $this->managerRepository->getmanagersSendEmail();
        if(count($emailmngers) > 0)
        {
            $infos = json_decode($this->structureRepository->structure('infos')->content, true);
            $details = [
                            'user' => $complaint->name,
                            'infos' => $infos,
                        ];
            foreach($emailmngers as $emailmnger)
            {
                Mail::to($emailmnger->email)->send(new NewComplaint($details));
            }
        }
    }

    /**
     * Handle the Complaint "updated" event.
     */
    public function updated(Complaint $complaint): void
    {
        //
    }

    /**
     * Handle the Complaint "deleted" event.
     */
    public function deleted(Complaint $complaint): void
    {
        //
    }

    /**
     * Handle the Complaint "restored" event.
     */
    public function restored(Complaint $complaint): void
    {
        //
    }

    /**
     * Handle the Complaint "force deleted" event.
     */
    public function forceDeleted(Complaint $complaint): void
    {
        //
    }
}
