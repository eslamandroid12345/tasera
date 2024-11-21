<?php

namespace App\Observers;

use App\Http\Enums\LoyaltyPointsSetting;
use App\Http\Enums\PurchaseOrderStatus;
use App\Http\Enums\PurchaseOrderType;
use App\Http\Enums\ReferenceId;
use App\Mail\PurchaseOrderUpdateMail;
use App\Mail\ReacceptPurchaseOrderMail;
use App\Models\PurchaseOrder;
use App\Repository\LoyaltyPointRepositoryInterface;
use App\Repository\LoyaltyPointsSettingRepositoryInterface;
use App\Repository\PurchaseOrderRepositoryInterface;
use App\Repository\StructureRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Mail;
use App\Mail\PurchaseOrderMail;
use App\Mail\AcceptPurchaseOrderMail;
use App\Mail\SupplierPurchaseOrderMail;
use App\Repository\ManagerRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Jobs\SendEmails;

class PurchaseOrderObserver
{
    public $afterCommit = true;

    public function __construct(
        private readonly PurchaseOrderRepositoryInterface        $purchaseOrderRepository,
        private readonly LoyaltyPointRepositoryInterface         $loyaltyPointRepository,
        private readonly LoyaltyPointsSettingRepositoryInterface $loyaltyPointsSettingRepository,
        private readonly ManagerRepositoryInterface              $managerRepository,
        private readonly UserRepositoryInterface                 $userRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    )
    {
    }

    /**
     * Handle the User "created" event.
     */
    public function created(PurchaseOrder $purchaseOrder): void
    {
        $this->purchaseOrderRepository->update($purchaseOrder->id, [
            'reference_id' => ReferenceId::PURCHASE_ORDER->value . sprintf("%011d", $purchaseOrder->id)
        ]);
        $emailmngers = $this->managerRepository->getmanagersSendEmail();
        $infos = json_decode($this->structureRepository->structure('infos')->content, true);
        if (count($emailmngers) > 0) {
            $details = [
                'title' => 'تم إنشاء طلب شراء جديد على المنصة',
                'body' => $purchaseOrder->refresh()->reference_id,
                'infos' => $infos,
            ];
            foreach ($emailmngers as $emailmnger)
            {
                Mail::to($emailmnger->email)->send(new PurchaseOrderMail($details));
            }
        }
    }

    public function updated(PurchaseOrder $purchaseOrder)
    {
        if ($purchaseOrder->is_approved && $purchaseOrder->company->has_loyalty_points) {
            $setting = $this->loyaltyPointsSettingRepository->first('name', LoyaltyPointsSetting::PURCHASE_ORDER_APPROVAL->value, ['id', 'points']);

            $this->loyaltyPointRepository->create([
                'loyalty_points_setting_id' => $setting->id,
                'company_id' => $purchaseOrder->company_id,
                'referral_company_id' => $purchaseOrder->approvedOffer->company_id,
                'points' => $setting->points
            ]);
        }

        if (in_array($purchaseOrder->status, ['متاح', 'available']))
        {
            $infos = json_decode($this->structureRepository->structure('infos')->content, true);
//        Log::info('infos: ' . $infos['en']['logo']);

            $details = [
                            'company_name' => $purchaseOrder->company->t('name'),
                            'body' => $purchaseOrder->reference_id,
                            'link' => env('purchase_orders').$purchaseOrder->reference_id,
                            'title' => $purchaseOrder->title,
                            'infos' => $infos
                        ];
            foreach ($purchaseOrder->company->users as $emailmnger)
            {
                Mail::to($emailmnger->email)->send(
                    $purchaseOrder->is_updated_before
                        ? new ReacceptPurchaseOrderMail($details)
                        : new AcceptPurchaseOrderMail($details)
                );
            }

            $users = $this->userRepository->getCommonSuppliers($purchaseOrder);
            if (count($users) > 0)
            {
                $infos = json_decode($this->structureRepository->structure('infos')->content, true);
                dispatch(new SendEmails($users, $purchaseOrder->reference_id,$infos));
                // $details2 = [
                //     'title' => 'يوجد طلب شراء جديد فى مجالكم ',
                //     'body' => $purchaseOrder->reference_id,
                //     'link' => env('purchase_orders').$purchaseOrder->reference_id
                // ];
                // foreach($users as $user)
                // {
                //     Mail::to($user->email)->send(new SupplierPurchaseOrderMail($details2));
                // }
            }

        }

        if ($purchaseOrder->status == PurchaseOrderStatus::UNDER_REVIEW->value && $purchaseOrder->is_updated_before) {
            $emailmngers = $this->managerRepository->getmanagersSendEmail();
            $infos = json_decode($this->structureRepository->structure('infos')->content, true);
            if (count($emailmngers) > 0) {
                $details = [
                    'title' => 'تم تعديل طلب شراء على المنصة',
                    'body' => $purchaseOrder->refresh()->reference_id,
                    'infos' => $infos,
                ];
                foreach ($emailmngers as $emailmnger)
                {
                    Mail::to($emailmnger->email)->send(new PurchaseOrderUpdateMail($details));
                }
            }
        }

    }
}
