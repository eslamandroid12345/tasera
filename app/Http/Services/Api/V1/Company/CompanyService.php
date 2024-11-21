<?php

namespace App\Http\Services\Api\V1\Company;

use App\Http\Requests\Api\V1\Company\CompanyFieldRequest;
use App\Http\Requests\Api\V1\Company\CompanyInfoRequest;
use App\Http\Requests\Api\V1\Company\CompanyMetadataRequest;
use App\Http\Resources\V1\Company\CompanyMetadataResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\CompanyRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    use Responser;

    public function __construct(
        private readonly CompanyRepositoryInterface $companyRepository,
//        private readonly CompanyF
        private readonly GetService $get,
        private readonly FileManagerService $fileManager,
    )
    {
    }

    public function show($referenceId)
    {
        $company = $this->companyRepository->first('reference_id', $referenceId);
        if ($company->can_view_company_file) {

            return $this->responseSuccess(data: new CompanyMetadataResource($company));

        } else {
            return $this->responseFail(401, __('messages.This companys profile is not allowed to be shown'));
        }
    }

    public function updateMetadata(CompanyMetadataRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only(['about_us', 'vision', 'message']);
            if ($request->hasFile('achievements_file'))
                $data['achievements_file'] = $this->fileManager->handle('achievements_file', 'companies/achievements');

            $this->companyRepository->update(auth('api')->user()->company_id, $data);

            DB::commit();
            return $this->responseSuccess(message: __('messages.updated successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function updateInfo(CompanyInfoRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $this->companyRepository->update(auth('api')->user()->company_id, $data);

            DB::commit();
            return $this->responseSuccess(message: __('messages.updated successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function updateFields(CompanyFieldRequest $request) {
        DB::beginTransaction();
        try {
            $this->companyRepository->syncFields(auth('api')->user()->company_id, $request->fields);

            DB::commit();
            return $this->responseSuccess(message: __('messages.updated successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

}
