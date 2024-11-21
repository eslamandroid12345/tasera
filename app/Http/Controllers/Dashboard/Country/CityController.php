<?php

namespace App\Http\Controllers\Dashboard\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Country\CityRequest;
use App\Http\Services\Dashboard\Country\CityService;

class CityController extends Controller
{
    public function __construct(private CityService $service)
    {
        $this->middleware('permission:cities-read')->only('index');
        $this->middleware('permission:cities-create')->only('create','store');
        $this->middleware('permission:cities-update')->only('edit','update');
        $this->middleware('permission:cities-delete')->only('destroy');
    }
    public function create()
    {
        return $this->service->create();
    }

    public function store(CityRequest $request)
    {
        return $this->service->store($request);
    }
    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(CityRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
}
