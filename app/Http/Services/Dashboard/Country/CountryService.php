<?php

namespace App\Http\Services\Dashboard\Country;

use App\Repository\CityRepositoryInterface;
use App\Repository\CountryRepositoryInterface;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class CountryService
{
    public function __construct(private CountryRepositoryInterface $repository,
                                private CityRepositoryInterface $cityRepository)
    {

    }

    public function index()
    {
        $countries = $this->repository->paginate(20);
        return view('dashboard.site.countries.index', compact('countries'));
    }


    public function create()
    {
        return view('dashboard.site.countries.create');
    }

    public function store($request)
    {
        try {
            $data = $request->validated();
            store_model($this->repository, $data);
            return redirect()->route('countries.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $country = $this->repository->getById($id);
        return view('dashboard.site.countries.edit', compact('country'));
    }

    public function update($request, $id)
    {
        try {
            $data = $request->validated();
            update_model($this->repository, $id, $data);
            return redirect()->route('countries.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            delete_model($this->repository, $id);
            return redirect()->route('countries.index')->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function cities($country_id)
    {
        $cities = $this->cityRepository->paginateCountryCities($country_id,20);
        return view('dashboard.site.cities.index', compact('cities','country_id'));
    }
}
