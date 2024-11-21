<?php

namespace App\Http\Controllers\Dashboard\Packages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Packages\PackageRequest;
use App\Http\Services\Dashboard\Package\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct(private PackageService $service)
    {
        $this->middleware('permission:packages-read')->only('index');
        $this->middleware('permission:packages-create')->only('create','store');
        $this->middleware('permission:packages-update')->only('edit','update');
        $this->middleware('permission:packages-delete')->only('destroy');
    }
    public function index(){
        return $this->service->index();
    }
    public function create()
    {
        return $this->service->create();
    }
    public function toggle()
    {
        return $this->service->toggle();
    }

    public function store(PackageRequest $request)
    {
        return $this->service->store($request);
    }
    public function edit(string $id)
    {
        return $this->service->edit($id);
    }
    public function show(string $id)
    {
        return $this->service->show($id);
    }

    public function update(PackageRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
}
