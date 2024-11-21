<?php

namespace App\Http\Services\Dashboard\LoyaltyPoint;

use App\Repository\CompanyRepositoryInterface;
use App\Repository\LoyaltyPointRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;
use function App\update_model;

class LoyaltyPointService
{
    public function __construct(private CompanyRepositoryInterface $repository,private LoyaltyPointRepositoryInterface $loyaltyPointRepository)
    {

    }

    public function index()
    {
        $buyers = $this->repository->paginate(20);
        return view('dashboard.site.loyalty_points.index', compact('buyers'));
    }
    public function show($id)
    {
        $company=$this->repository->getById($id);
        $loyalty_points = $this->loyaltyPointRepository->getByCompany($id);
        return view('dashboard.site.loyalty_points.show', compact('loyalty_points','company'));
    }

    public function update( $id)
    {
        try {
            $buyer=$this->repository->getById($id);
            update_model($this->repository, $id, ['has_loyalty_points'=>!$buyer->has_loyalty_points]);
            return redirect()->route('loyalty-points.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

}
