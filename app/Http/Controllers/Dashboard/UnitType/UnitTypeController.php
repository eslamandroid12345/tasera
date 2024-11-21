<?php

namespace App\Http\Controllers\Dashboard\UnitType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UnitType\UnitTypeRequest;
use App\Http\Services\Dashboard\UnitType\UnitTypeService;
use Illuminate\Http\Request;

class UnitTypeController extends Controller
{
    public function __construct(private UnitTypeService $service)
    {
        $this->middleware('permission:unit-types-read')->only('index');
        $this->middleware('permission:unit-types-create')->only('create','store');
        $this->middleware('permission:unit-types-update')->only('edit','update');
        $this->middleware('permission:unit-types-delete')->only('destroy');
    }
    public function index(){
        return $this->service->index();
    }
    public function create()
    {
        return $this->service->create();
    }
    public function store(UnitTypeRequest $request)
    {
        return $this->service->store($request);
    }
    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(UnitTypeRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
}
