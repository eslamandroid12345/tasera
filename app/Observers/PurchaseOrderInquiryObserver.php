<?php

namespace App\Observers;

use App\Mail\PurchaseOrderInquiryManagerMail;
use App\Repository\ManagerRepositoryInterface;
use App\Repository\PurchaseOrderInquiryRepositoryInterface;
use Mail;
use App\Mail\PurchaseOrderInquiryMail;
use App\Repository\StructureRepositoryInterface;
use App\Models\PurchaseOrderInquiry;

class PurchaseOrderInquiryObserver
{
    /**
     * Handle the PurchaseOrderInquiry "created" event.
     */

    public $afterCommit = true;

    public function __construct(
        private readonly ManagerRepositoryInterface              $managerRepository,
        private readonly StructureRepositoryInterface            $structureRepository,
    )
    {
    }

    public function created(PurchaseOrderInquiry $purchaseOrderInquiry): void
    {
        $emailmngers = $this->managerRepository->getmanagersSendEmail();
        if (count($emailmngers) > 0) {
            foreach ($emailmngers as $emailmnger) {
                // $user = $this->userRepository->getLatestUserLogin($company->id);
                $infos = json_decode($this->structureRepository->structure('infos')->content, true);
                $details = [
                                'infos' => $infos,
                                'company_name' => $purchaseOrderInquiry->company->t('name'),
                            ];
                Mail::to($emailmnger->email)->send(new PurchaseOrderInquiryManagerMail($details));
            }
        }
    }

    /**
     * Handle the PurchaseOrderInquiry "updated" event.
     */
    public function updated(PurchaseOrderInquiry $purchaseOrderInquiry): void
    {
        if ($purchaseOrderInquiry->is_published == 1) {
            $infos = json_decode($this->structureRepository->structure('infos')->content, true);
            foreach ($purchaseOrderInquiry->company->users as $user) {
                $details = [
                    'reference_id' => $purchaseOrderInquiry->purchaseOrder->reference_id,
                    'infos' => $infos,
                    'user' => $user,
                ];
                Mail::to($user->email)->send(new PurchaseOrderInquiryMail($details));
            }
        }
    }

    /**
     * Handle the PurchaseOrderInquiry "deleted" event.
     */
    public function deleted(PurchaseOrderInquiry $purchaseOrderInquiry): void
    {
        //
    }

    /**
     * Handle the PurchaseOrderInquiry "restored" event.
     */
    public function restored(PurchaseOrderInquiry $purchaseOrderInquiry): void
    {
        //
    }

    /**
     * Handle the PurchaseOrderInquiry "force deleted" event.
     */
    public function forceDeleted(PurchaseOrderInquiry $purchaseOrderInquiry): void
    {
        //
    }
}
