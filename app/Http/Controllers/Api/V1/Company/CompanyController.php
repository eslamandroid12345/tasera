<?php

namespace App\Http\Controllers\Api\V1\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Company\CompanyFieldRequest;
use App\Http\Requests\Api\V1\Company\CompanyInfoRequest;
use App\Http\Requests\Api\V1\Company\CompanyMetadataRequest;
use App\Http\Services\Api\V1\Company\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(
        private readonly CompanyService $company,
    )
    {
    }

    public function show($referenceId)
    {
        return $this->company->show($referenceId);
    }

    public function updateMetadata(CompanyMetadataRequest $request)
    {
        return $this->company->updateMetadata($request);
    }

    public function updateInfo(CompanyInfoRequest $request)
    {
        return $this->company->updateInfo($request);
    }

    public function updateFields(CompanyFieldRequest $request)
    {
        return $this->company->updateFields($request);
    }


}
