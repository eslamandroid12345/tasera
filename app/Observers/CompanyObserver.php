<?php

namespace App\Observers;

use App\Http\Enums\LoyaltyPointsSetting;
use App\Http\Enums\ReferenceId;
use App\Http\Enums\CompanyType;
use App\Models\Company;
use Mail;
use App\Mail\NewSupplier;
use App\Mail\NewBuyer;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\LoyaltyPointRepositoryInterface;
use App\Repository\LoyaltyPointsSettingRepositoryInterface;
use App\Repository\PackageRepositoryInterface;
use App\Repository\ManagerRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Repository\StructureRepositoryInterface;

class CompanyObserver
{
    public $afterCommit = true;

    public function __construct(
        private readonly CompanyRepositoryInterface $companyRepository,
        private readonly PackageRepositoryInterface $packageRepository,
        private readonly SubscriptionRepositoryInterface $subscriptionRepository,
        private readonly LoyaltyPointRepositoryInterface $loyaltyPointRepository,
        private readonly LoyaltyPointsSettingRepositoryInterface $loyaltyPointsSettingRepository,
        private readonly ManagerRepositoryInterface $managerRepository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    )
    {
    }

    /**
     * Handle the Company "created" event.
     */
    public function created(Company $company): void
    {
        #====================[ Make a Reference Id ]====================#

        $this->companyRepository->update($company->id, [
            'reference_id' => ReferenceId::fromName(CompanyType::from($company->type)->name)->value . sprintf("%06d", $company->id)
        ]);

        #====================[ Assign Initial Package ]====================#

        if ($company->type == CompanyType::SUPPLIER->value) {
            $initialPackage = $this->packageRepository->getRegularPackage();

            if ($initialPackage !== null) {
                $this->subscriptionRepository->create([
                    'package_id' => $initialPackage->id,
                    'company_id' => $company->id,
                    'payment_id' => null,
                    'ends_at' => null,
                    'is_active' => true,
                ]);
            }
        }

        #====================[ Handle Loyalty Points ]====================#

        if ($company->referral_company_id !== null && $company->referralCompany->has_loyalty_points) {
            $setting = $this->loyaltyPointsSettingRepository->first('name', LoyaltyPointsSetting::REGISTER->value, ['id', 'points']);

            $this->loyaltyPointRepository->create([
                'loyalty_points_setting_id' => $setting->id,
                'company_id' => $company->referral_company_id,
                'referral_company_id' => $company->id,
                'points' => $setting->points
            ]);
        }
        $emailmngers = $this->managerRepository->getmanagersSendEmail();
        if(count($emailmngers) > 0)
        {
            foreach($emailmngers as $emailmnger)
            {
                if($company->type == 'buyer')
                {
                    // $user = $this->userRepository->getLatestUserLogin($company->id);
                    $infos = json_decode($this->structureRepository->structure('infos')->content, true);
                    $details = [
                                    'infos' => $infos,
                                    'company' => $company->refresh(),
                                ];
                    Mail::to($emailmnger->email)->send(new NewBuyer($details));
                }
                else
                {
                    // $user = $this->userRepository->getLatestUserLogin($company->id);
                    $infos = json_decode($this->structureRepository->structure('infos')->content, true);
                    $details = [
                                    'infos' => $infos,
                                    'company' => $company->refresh(),
                                ];
                    Mail::to($emailmnger->email)->send(new NewSupplier($details));
                }
            }
        }
    }

    public function updated(Company $company): void
    {
        if (!$company->has_loyalty_points) {
            $this->loyaltyPointRepository->deleteByCompany($company->id);
        }
    }
}
