<?php

namespace App\Http\Controllers\Dashboard\Tax;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Tax\TaxRequest;
use App\Http\Services\Dashboard\Tax\TaxService;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function __construct(private TaxService $service)
    {
        $this->middleware('permission:taxes-read')->only('index');
        $this->middleware('permission:taxes-create')->only('create','store');
        $this->middleware('permission:taxes-update')->only('edit','update');
        $this->middleware('permission:taxes-delete')->only('destroy');
    }
    public function index(){
        return $this->service->index();
    }
    public function create()
    {
        return $this->service->create();
    }
    public function store(TaxRequest $request)
    {
        return $this->service->store($request);
    }
    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(TaxRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
}
