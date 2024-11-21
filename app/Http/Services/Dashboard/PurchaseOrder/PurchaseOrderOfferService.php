<?php

namespace App\Http\Services\Dashboard\PurchaseOrder;

use App\Repository\PurchaseOrderOfferRepositoryInterface;
use Illuminate\Http\Request;
use function App\delete_model;

class PurchaseOrderOfferService
{
    public function __construct(private PurchaseOrderOfferRepositoryInterface $repository)
    {
    }

    public function index()
    {
        $offers = $this->repository->getNotPublished();
        return view('dashboard.site.purchase_orders_offers.index', compact('offers'));
    }

    public function show($id)
    {
        $offer = $this->repository->getById($id, relations: ['tax', 'company', 'user', 'demandUnits']);
        return view('dashboard.site.purchase_orders_offers.show', compact('offer'));
    }

    public function destroy($id)
    {
        try {
            $offer = $this->repository->getById($id, relations: ['demandUnits']);
            $offer->demandUnits()->delete();
            delete_model($this->repository, $id);
            return redirect()->back()->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function approve(Request $request, $id)
    {
        try {
            $this->repository->update($id, ['is_published' => true]);
            return redirect()->back()->with(['success' => __('messages.approved_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
