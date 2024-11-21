<?php

namespace App\Http\Controllers\Dashboard\Field;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Field\FieldRequest;
use App\Http\Services\Dashboard\Field\FieldService;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function __construct(private FieldService $service)
    {
        $this->middleware('permission:fields-read')->only('index');
        $this->middleware('permission:fields-create')->only('create','store');
        $this->middleware('permission:fields-update')->only('edit','update');
        $this->middleware('permission:fields-delete')->only('destroy');
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

    public function store(FieldRequest $request)
    {
        return $this->service->store($request);
    }
    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(FieldRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
}
