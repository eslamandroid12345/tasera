<?php

namespace App\Observers;

use App\Http\Enums\ReferenceId;
use App\Mail\PurchaseOrderInquiryManagerMail;
use App\Mail\PurchaseOrderOfferManagerMail;
use App\Models\PurchaseOrderOffer;
use App\Repository\ManagerRepositoryInterface;
use App\Repository\PurchaseOrderOfferRepositoryInterface;
use App\Repository\PurchaseOrderRepositoryInterface;
use App\Mail\PurchaseOrderOfferMail;
use App\Mail\ApprovedPurchasesOrder;
use Mail;
use Illuminate\Support\Facades\Log;
use App\Repository\StructureRepositoryInterface;

class PurchaseOrderOfferObserver
{
    public $afterCommit = true;

    public function __construct(
        private readonly PurchaseOrderOfferRepositoryInterface $purchaseOrderOfferRepository,
        private readonly ManagerRepositoryInterface $managerRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    )
    {
    }

    /**
     * Handle the User "created" event.
     */
    public function created(PurchaseOrderOffer $offer): void
    {
        $this->purchaseOrderOfferRepository->update($offer->id, [
            'reference_id' => ReferenceId::OPPORTUNITY->value . sprintf("%011d", $offer->id)
        ]);

        $emailmngers = $this->managerRepository->getmanagersSendEmail();
        if (count($emailmngers) > 0) {
            foreach ($emailmngers as $emailmnger) {
                // $user = $this->userRepository->getLatestUserLogin($company->id);
                $infos = json_decode($this->structureRepository->structure('infos')->content, true);
                $details = [
                    'infos' => $infos,
                    'reference_id' => $offer->refresh()->reference_id,
                ];
                Mail::to($emailmnger->email)->send(new PurchaseOrderOfferManagerMail($details));
            }
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(PurchaseOrderOffer $offer): void
    {
        if ($offer->is_approved)
        {
            $this->purchaseOrderOfferRepository->ensureOtherOffersNotApproved($offer->purchase_order_id, $offer->id);
        }

        if($offer->is_published == 1 && $offer->is_approved == 0)
        {
            $infos = json_decode($this->structureRepository->structure('infos')->content, true);
            foreach ($offer->company->users as $user)
            {
                $details = [
                                'order_reference_id' => $offer->purchaseOrder->reference_id,
                                'offer_reference_id' => $offer->reference_id,
                                'infos' => $infos,
                                'user' => $user,
                            ];
                Mail::to($user->email)->send(new PurchaseOrderOfferMail($details));
            }

        }


        if($offer->is_approved == 1)
        {
            $infos = json_decode($this->structureRepository->structure('infos')->content, true);
            foreach($offer->company->users as $user)
            {
                $details = [
                                'reference_id' => $offer->reference_id,
                                'purchases_order' => $offer->purchaseOrder->reference_id,
                                'buyer' => $offer->purchaseOrder->company,
                                'user' => $user,
                                'infos' => $infos,
                            ];
                Mail::to($user->email)->send(new ApprovedPurchasesOrder($details));
            }
        }


    }
}
