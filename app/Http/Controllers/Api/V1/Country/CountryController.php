<?php

namespace App\Http\Controllers\Api\V1\Country;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Country\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct(
        private readonly CountryService $country,
    )
    {
    }

    public function getInfo()
    {
        return $this->country->getInfo();
    }
}
