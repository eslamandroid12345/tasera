<?php

namespace App\Observers;

use App\Mail\AcceptNewInitUser;
use App\Models\User;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\OtpRepositoryInterface;
use App\Repository\ManagerRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Mail;
use App\Mail\NewSubUser;
use App\Mail\AcceptNewSubUser;
use App\Mail\AcceptNewSubUserBuyer;
use App\Repository\StructureRepositoryInterface;

class UserObserver
{
    public $afterCommit = true;

    public function __construct(
        private readonly OtpRepositoryInterface $otpRepository,
        private readonly CompanyRepositoryInterface $companyRepository,
        private readonly ManagerRepositoryInterface $managerRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    )
    {
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $otp = $this->otpRepository->first('email', $user->email, ['id', 'is_verified']);
        if ($otp?->is_verified) {
//            $this->companyRepository->update($user->company_id, ['is_active' => true]);
            $this->otpRepository->delete($otp->id);
        }
        $emailmngers = $this->managerRepository->getmanagersSendEmail();
        if(count($emailmngers) > 0 && $user->is_sub)
        {
            Log::info('userrr : ' . print_r($user->company, true));
            $infos = json_decode($this->structureRepository->structure('infos')->content, true);
            $details = [
                            'user' => $user,
                            'infos' => $infos,
                        ];
            foreach($emailmngers as $emailmnger)
            {
                Mail::to($emailmnger->email)->send(new NewSubUser($details));
            }
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if($user->is_active == 1)
        {
            $infos = json_decode($this->structureRepository->structure('infos')->content, true);
            $details = [
                            'title' => 'تم تفعيل حسابكم من قبل الادمن  فى المنصه',
                            'body' => $user->name,
                            'infos' => $infos,
                            'company' => $user->company,
                            'user' => $user,
                        ];
            if($user->company->type == 'buyer')
            {
                Mail::to($user->email)->send(new AcceptNewSubUserBuyer($details));
            }
            else
            {
                if ($user->is_sub) {
                    Mail::to($user->email)->send(new AcceptNewSubUser($details));
                } else {
                    Mail::to($user->email)->send(new AcceptNewInitUser($details));
                }
            }

        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
