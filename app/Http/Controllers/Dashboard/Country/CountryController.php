<?php

namespace App\Http\Controllers\Dashboard\Country;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Country\CountryRequest;
use App\Http\Services\Dashboard\Country\CountryService;

class CountryController extends Controller
{
    public function __construct(private CountryService $service)
    {
        $this->middleware('permission:countries-read')->only('index');
        $this->middleware('permission:countries-create')->only('create','store');
        $this->middleware('permission:countries-update')->only('edit','update');
        $this->middleware('permission:countries-delete')->only('destroy');
    }

    public function index()
    {
        return $this->service->index();
    }


    public function create()
    {
        return $this->service->create();
    }

    public function store(CountryRequest $request)
    {
        return $this->service->store($request);
    }
    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(CountryRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
    public function cities($country){
        return $this->service->cities($country);
    }
}
