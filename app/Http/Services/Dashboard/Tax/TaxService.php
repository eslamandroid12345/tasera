<?php

namespace App\Http\Services\Dashboard\Tax;

use App\Repository\FieldRepositoryInterface;
use App\Repository\PurchaseOrderTaxRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class TaxService
{
    public function __construct(private PurchaseOrderTaxRepositoryInterface $repository)
    {

    }

    public function index()
    {
        $taxes = $this->repository->paginate(20);
        return view('dashboard.site.taxes.index', compact('taxes'));
    }


    public function create()
    {
        return view('dashboard.site.taxes.create');
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            store_model($this->repository, $data);
            DB::commit();
            return redirect()->route('taxes.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $tax = $this->repository->getById($id);
        return view('dashboard.site.taxes.edit', compact('tax'));
    }

    public function update($request, $id)
    {
        try {
            $data = $request->validated();
            update_model($this->repository, $id, $data);
            return redirect()->route('taxes.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            delete_model($this->repository, $id);
            return redirect()->route('taxes.index')->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

}
