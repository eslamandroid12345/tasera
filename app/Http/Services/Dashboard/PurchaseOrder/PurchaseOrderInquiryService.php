<?php

namespace App\Http\Services\Dashboard\PurchaseOrder;

use App\Repository\PurchaseOrderInquiryRepositoryInterface;
use App\Repository\PurchaseOrderOfferRepositoryInterface;
use Illuminate\Http\Request;
use function App\delete_model;

class PurchaseOrderInquiryService
{
    public function __construct(private PurchaseOrderInquiryRepositoryInterface $repository)
    {
    }

    public function index()
    {
        $inquiries = $this->repository->getNotPublished();
        return view('dashboard.site.purchase_orders_inquiries.index', compact('inquiries'));
    }

    public function show($id)
    {
        $inquiry = $this->repository->getById($id);
        return view('dashboard.site.purchase_orders_inquiries.show', compact('inquiry'));
    }

    public function destroy($id)
    {
        try {
            $inquiry = $this->repository->getById($id, relations: ['reply']);
            $inquiry->reply()?->delete();
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
