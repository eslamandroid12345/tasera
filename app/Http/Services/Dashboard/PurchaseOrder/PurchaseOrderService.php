<?php

namespace App\Http\Services\Dashboard\PurchaseOrder;

use App\Repository\PurchaseOrderRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class PurchaseOrderService
{

    public function __construct(private PurchaseOrderRepositoryInterface $repository,private UserRepositoryInterface $userRepository)
    {

    }

    public function index()
    {
        $purchase_orders = $this->repository->paginate(20, relations: ['company', 'deliveryCity'], orderBy: 'DESC');
        return view('dashboard.site.purchase_orders.index', compact('purchase_orders'));
    }

    public function show($id)
    {
        $purchase_order = $this->repository->getById($id, relations: ['company', 'deliveryCity', 'offers', 'demandUnits', 'fields', 'demandUnits.type', 'publishedInquiries', 'publishedInquiries.reply', 'publishedInquiries.company','offers','offers.company']);
        return view('dashboard.site.purchase_orders.show', compact('purchase_order'));
    }

    public function update($request, $id)
    {
        try
        {
            $data = $request->validated();

            update_model($this->repository, $id, ['status' => $data['status']]);
            return true;
        }
        catch (\Exception $e)
        {
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $purchase_order=$this->repository->getById($id,relations: ['demandUnits','offers','offers.demandUnits','publishedInquiries','publishedInquiries.reply']);
            $purchase_order->demandUnits()?->delete();
            $purchase_order->offers()?->delete();
            $purchase_order->inquiries()?->delete();
            delete_model($this->repository, $id,);
            DB::commit();
            return redirect()->route('purchase-orders.index')->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
