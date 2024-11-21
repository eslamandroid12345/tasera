<?php

namespace App\Http\Controllers\Api\V1\LoyaltyPoint;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\LoyaltyPoint\LoyaltyPointService;
use Illuminate\Http\Request;

class LoyaltyPointController extends Controller
{
    public function __construct(
        private readonly LoyaltyPointService $loyaltyPoint,
    )
    {
        $this->middleware('auth:api');
    }

    public function show()
    {
        return $this->loyaltyPoint->show();
    }
}
