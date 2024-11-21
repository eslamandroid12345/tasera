<?php

namespace App\Http\Controllers\Api\V1\ContactUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ContactUs\ContactUsRequest;
use App\Http\Services\Api\V1\ContactUs\ContactUsService;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function __construct(
        private readonly ContactUsService $contactUs,
    )
    {
    }

    public function create(ContactUsRequest $request)
    {
        return $this->contactUs->create($request);
    }
}
