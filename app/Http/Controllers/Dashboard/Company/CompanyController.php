<?php

namespace App\Http\Controllers\Dashboard\Company;

use App\Http\Controllers\Controller;
use App\Http\Enums\CompanyType;
use App\Http\Requests\Dashboard\Company\CompanyRequest;
use App\Http\Services\Dashboard\Company\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(private CompanyService $service)
    {
        $this->middleware('permission:companies-read')->only('index','show');
        $this->middleware('permission:companies-create')->only('create','store');
        $this->middleware('permission:companies-update')->only('edit','update');
        $this->middleware('permission:companies-delete')->only('destroy');
    }
    public function index($type){
        return $this->service->index($type);
    }

    public function suppliersIndex()
    {
        return $this->service->index(CompanyType::SUPPLIER->value);
    }

    public function buyersIndex()
    {
        return $this->service->index(CompanyType::BUYER->value);
    }

    public function toggle(){
        return $this->service->toggle();
    }
    public function create()
    {
        return $this->service->create();
    }
    public function store(CompanyRequest $request)
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

    public function update(CompanyRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
    public function users($company_id){
        return $this->service->users($company_id);
    }
}
