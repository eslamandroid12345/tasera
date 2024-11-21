<?php

namespace App\Http\Services\Dashboard\PurchaseOrder;

use App\Repository\PurchaseOrderDemandUnitRepositoryInterface;
use App\Repository\PurchaseOrderOfferRepositoryInterface;
use function App\delete_model;

class PurchaseOrderDemandUnitService
{
    public function __construct(private PurchaseOrderDemandUnitRepositoryInterface $repository)
    {
    }

    public function destroy($id)
    {
        try {
            $offer = $this->repository->getById($id, relations: ['demandUnitOffers']);
            $offer->demandUnitOffers()->delete();
            delete_model($this->repository, $id);
            return redirect()->back()->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

}
