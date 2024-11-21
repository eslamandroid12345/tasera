<?php

namespace App\Http\Controllers\Dashboard\ContactUs;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\ContactUs\ContactUsService;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function __construct(
        private readonly ContactUsService $contactUs,
    )
    {
    }

    public function index()
    {
        return $this->contactUs->index();
    }

    public function show($id)
    {
        return $this->contactUs->show($id);
    }

    public function destroy($id)
    {
        return $this->contactUs->destroy($id);
    }
}
