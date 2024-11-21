<?php

namespace App\Http\Services\Dashboard\Company;

use App\Http\Services\Mutual\FileManagerService;
use App\Repository\CityRepositoryInterface;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\FieldRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class CompanyService
{
    public function __construct(private CompanyRepositoryInterface $repository, private FieldRepositoryInterface $fieldRepository,
                                private FileManagerService         $fileManager, private CityRepositoryInterface $cityRepository)
    {

    }

    public function index($type)
    {
        $companies = $this->repository->paginatedType($type);
        return view('dashboard.site.companies.index', compact('companies', 'type'));
    }
    public function show( $id)
    {
        $company = $this->repository->getById($id, relations: ['city', 'fields']);
        return view('dashboard.site.companies.show', compact('company'));

    }

    public function create()
    {
        $fields = $this->fieldRepository->getAll();
        $cities = $this->cityRepository->getAll();
        return view('dashboard.site.companies.create', compact('fields', 'cities'));
    }
    public function toggle()
    {
        try
        {
            update_model($this->repository, request('itemId'), ['is_active' => request('status')]);
            return true;
        }
        catch (\Exception $e)
        {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
    public function store($request)
    {
        try {
            DB::beginTransaction();
            $companyData = $request->validated();

            if ($request->hasFile('logo'))
                $companyData['logo'] = $this->fileManager->handle('logo', 'companies/logos');

            if ($request->hasFile('authorization_approval_file'))
                $companyData['authorization_approval_file'] = $this->fileManager->handle('authorization_approval_file', 'companies/authorizations');
            if ($request->hasFile('achievements_file'))
                $companyData['achievements_file'] = $this->fileManager->handle('achievements_file', 'companies/authorizations');

            if ($request->hasFile('commercial_registration_image'))
                $companyData['commercial_registration_image'] = $this->fileManager->handle('commercial_registration_image', 'companies/registrations');
            if ($request->hasFile('tax_registration_image'))
                $companyData['tax_registration_image'] = $this->fileManager->handle('tax_registration_image', 'companies/registrations');

            if ($request->hasFile('bank_details_file'))
                $companyData['bank_details_file'] = $this->fileManager->handle('tax_registration_image', 'companies/banks');

            $company = store_model($this->repository, $companyData, true);
            $company->fields()->attach($request->fields);
            DB::commit();
            return redirect()->route('/')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $fields = $this->fieldRepository->getAll();
        $cities = $this->cityRepository->getAll();
        $company = $this->repository->getById($id, relations: ['city', 'fields']);
        $company_fields = $company->fields->pluck('id');
        return view('dashboard.site.companies.edit', compact('company', 'fields', 'cities', 'company_fields'));
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $companyData = $request->validated();
            $company = $this->repository->getById($id);

            if ($request->hasFile('achievements_file'))
                $companyData['achievements_file'] = $this->fileManager->handle('achievements_file', 'companies/authorizations',target: $company->achievements_file );
            if ($request->hasFile('logo'))
                $companyData['logo'] = $this->fileManager->handle('logo', 'companies/logos',target: $company->logo );
            if ($request->hasFile('authorization_approval_file'))
                $companyData['authorization_approval_file'] = $this->fileManager->handle('authorization_approval_file', 'companies/authorizations',target: $company->authorization_approval_file );
            if ($request->hasFile('commercial_registration_image'))
                $companyData['commercial_registration_image'] = $this->fileManager->handle('commercial_registration_image', 'companies/registrations',target: $company->commercial_registration_image );
            if ($request->hasFile('tax_registration_image'))
                $companyData['tax_registration_image'] = $this->fileManager->handle('tax_registration_image', 'companies/registrations',target: $company->tax_registration_image );

            if ($request->hasFile('bank_details_file'))
                $companyData['bank_details_file'] = $this->fileManager->handle('tax_registration_image', 'companies/banks',target: $company->tax_registration_image );

            $company = update_model($this->repository, $id, $companyData, true);
            $company->fields()->sync($request->fields);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            $company = $this->repository->getById($id);
            $company->fields()->detach();
            if ($company->logo)
                $this->fileManager->deleteFile($company->logo);

            if ($company->achievements_file)
                $this->fileManager->deleteFile($company->achievements_file);
            if ($company->authorization_approval_file)
                $this->fileManager->deleteFile($company->authorization_approval_file);
            if ($company->commercial_registration_image)
                $this->fileManager->deleteFile($company->commercial_registration_image);
            if ($company->tax_registration_image)
                $this->fileManager->deleteFile($company->tax_registration_image);
            if ($company->bank_details_file)
                $this->fileManager->deleteFile($company->bank_details_file);
            delete_model($this->repository, $id);
            return redirect()->back()->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
    public function users($company_id){
        $users=$this->repository->getById($company_id,relations: ['users'])->users;
        return view('dashboard.site.users.index', compact('company_id', 'users'));
    }
}
