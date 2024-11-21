<?php

namespace App\Http\Services\Dashboard\Field;

use App\Repository\FieldRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class FieldService
{
    public function __construct(private FieldRepositoryInterface $repository)
    {

    }

    public function index()
    {
        $fields = $this->repository->paginate(20);
        return view('dashboard.site.fields.index', compact('fields'));
    }


    public function create()
    {
        return view('dashboard.site.fields.create');
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['is_active'] = 1;
            store_model($this->repository, $data);
            DB::commit();
            return redirect()->route('fields.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $field = $this->repository->getById($id);
        return view('dashboard.site.fields.edit', compact('field'));
    }

    public function update($request, $id)
    {
        try {
            $data = $request->validated();
            update_model($this->repository, $id, $data);
            return redirect()->route('fields.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            delete_model($this->repository, $id);
            return redirect()->route('fields.index')->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function toggle()
    {
        try {
            update_model($this->repository, request('itemId'), ['is_active' => request('status')]);
            return true;
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
