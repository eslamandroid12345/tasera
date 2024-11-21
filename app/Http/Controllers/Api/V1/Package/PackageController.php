<?php

namespace App\Http\Controllers\Api\V1\Package;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Package\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct(
        private readonly PackageService $package,
    )
    {
        $this->middleware('auth:api');
    }

    public function getPackages()
    {
        return $this->package->getPackages();
    }
}
