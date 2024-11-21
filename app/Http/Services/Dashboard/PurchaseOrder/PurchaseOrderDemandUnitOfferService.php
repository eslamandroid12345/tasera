<?php

namespace App\Http\Services\Dashboard\PurchaseOrder;

use App\Repository\Eloquent\PurchaseOrderDemandUnitOfferRepository;
use App\Repository\PurchaseOrderDemandUnitRepositoryInterface;
use App\Repository\PurchaseOrderOfferRepositoryInterface;
use function App\delete_model;

class PurchaseOrderDemandUnitOfferService
{
    public function __construct(private PurchaseOrderDemandUnitOfferRepository $repository)
    {
    }

    public function destroy($id)
    {
        try {
            delete_model($this->repository, $id);
            return redirect()->back()->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
