<?php

namespace App\Http\Services\Dashboard\LoyaltyPoint;

use App\Repository\CompanyRepositoryInterface;
use App\Repository\LoyaltyPointRepositoryInterface;
use App\Repository\LoyaltyPointsSettingRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;
use function App\update_model;

class LoyaltyPointSettingsService
{
    public function __construct(private LoyaltyPointsSettingRepositoryInterface $repository)
    {

    }

    public function index()
    {
        $settings = $this->repository->getAll();
        return view('dashboard.site.loyalty_points_settings.index', compact('settings'));
    }
    public function edit($id)
    {
        $setting=$this->repository->getById($id);
        return view('dashboard.site.loyalty_points_settings.edit', compact('setting'));
    }

    public function update($request, $id)
    {
        try {
            $data=$request->validated();
            update_model($this->repository, $id, ['points'=>$data['points']]);
            return redirect()->route('loyalty-points-settings.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

}
