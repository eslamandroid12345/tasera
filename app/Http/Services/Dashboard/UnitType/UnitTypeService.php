<?php

namespace App\Http\Services\Dashboard\UnitType;

use App\Repository\PurchaseOrderDemandUnitTypeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class UnitTypeService
{
    public function __construct(private PurchaseOrderDemandUnitTypeRepositoryInterface $repository)
    {

    }

    public function index()
    {
        $unit_types = $this->repository->paginate(20);
        return view('dashboard.site.unit_types.index', compact('unit_types'));
    }


    public function create()
    {
        return view('dashboard.site.unit_types.create');
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            store_model($this->repository, $data);
            DB::commit();
            return redirect()->route('unit-types.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $unit_type = $this->repository->getById($id);
        return view('dashboard.site.unit_types.edit', compact('unit_type'));
    }

    public function update($request, $id)
    {
        try {
            $data = $request->validated();
            update_model($this->repository, $id, $data);
            return redirect()->route('unit-types.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            delete_model($this->repository, $id);
            return redirect()->route('unit-types.index')->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }


}
