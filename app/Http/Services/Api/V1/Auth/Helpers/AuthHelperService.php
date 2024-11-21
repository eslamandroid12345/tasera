<?php

namespace App\Http\Services\Api\V1\Auth\Helpers;

use App\Http\Requests\Api\V1\Auth\SignUpRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\OtpRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class AuthHelperService
{
    public function __construct(
        private readonly CompanyRepositoryInterface $companyRepository,
        private readonly UserRepositoryInterface $userRepository,
        private readonly FileManagerService $fileManager,
    )
    {
    }

    public function createCompany(SignUpRequest $request, $type)
    {
        $companyData = $request->only(['name_ar', 'name_en', 'website_url', 'commercial_registration_no', 'commercial_registration_expiry_date', 'is_tax_exempt', 'tax_registration_no', 'city_id', 'company_phone', 'referral_company_reference_id']);

        $companyData['type'] = $type;

        $companyData['logo'] = $this->fileManager->handle('logo', 'companies/logos');

        $companyData['phone'] = $companyData['company_phone'];

        if ($request->hasFile('authorization_approval_file'))
            $companyData['authorization_approval_file'] = $this->fileManager->handle('authorization_approval_file', 'companies/authorizations');

        $companyData['commercial_registration_image'] = $this->fileManager->handle('commercial_registration_image', 'companies/registrations');

        $companyData['tax_registration_image'] = $this->fileManager->handle('tax_registration_image', 'companies/registrations');

        if ($request->hasFile('bank_details_file'))
            $companyData['bank_details_file'] = $this->fileManager->handle('bank_details_file', 'companies/banks');

        if (isset($companyData['referral_company_reference_id'])) {
            $referralCompanyId = $this->companyRepository->first('reference_id', $companyData['referral_company_reference_id'], ['id'])?->id;
            $companyData['referral_company_id'] = $referralCompanyId;
        }

        unset($companyData['company_phone'], $companyData['referral_company_reference_id']);

        $company = $this->companyRepository->create($companyData);

        $this->companyRepository->syncFields($company->id, $request->fields);

        return $company;
    }

    public function createUser(SignUpRequest $request, $companyId)
    {
        $userData = $request->only(['name', 'email', 'user_phone', 'password', 'direct_manager_name', 'direct_manager_email']);

        $userData['company_id'] = $companyId;

        $userData['phone'] = $userData['user_phone'];

        unset($userData['user_phone']);

        return $this->userRepository->create($userData);
    }

}
