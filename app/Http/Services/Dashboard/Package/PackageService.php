<?php

namespace App\Http\Services\Dashboard\Package;

use App\Repository\PackageRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class PackageService
{
    public function __construct(private PackageRepositoryInterface $repository)
    {

    }

    public function index()
    {
        $packages = $this->repository->paginate(20);
        return view('dashboard.site.packages.index', compact('packages'));
    }


    public function create()
    {
        return view('dashboard.site.packages.create');
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['is_active'] = 1;
            store_model($this->repository, $data);
            DB::commit();
            return redirect()->route('packages.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $package = $this->repository->getById($id);
        return view('dashboard.site.packages.edit', compact('package'));
    }
    public function show($id)
    {
        $package = $this->repository->getById($id);
        return view('dashboard.site.packages.show', compact('package'));
    }
    public function update($request, $id)
    {
        try {
            $data = $request->validated();
            update_model($this->repository, $id, $data);
            return redirect()->route('packages.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            delete_model($this->repository, $id);
            return redirect()->route('packages.index')->with(['success' => __('messages.deleted_successfully')]);
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
