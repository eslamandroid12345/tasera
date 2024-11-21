<?php

namespace App\Http\Controllers\Dashboard\LoyaltyPoint;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LoyaltyPoint\LoyaltyPointSettingRequest;
use App\Http\Services\Dashboard\LoyaltyPoint\LoyaltyPointSettingsService;
use Illuminate\Http\Request;

class LoyaltyPointSettingController extends Controller
{
    public function __construct(private LoyaltyPointSettingsService $service)
    {
        $this->middleware('permission:loyalty-points-settings-read')->only('index');
        $this->middleware('permission:loyalty-points-settings-update')->only('toggle');
    }
    public function index(){
        return $this->service->index();
    }
    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(LoyaltyPointSettingRequest $request,string $id)
    {
        return $this->service->update($request,$id);
    }
}
