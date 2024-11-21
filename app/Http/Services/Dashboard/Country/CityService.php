<?php

namespace App\Http\Services\Dashboard\Country;

use App\Repository\CityRepositoryInterface;
use App\Repository\CountryRepositoryInterface;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class CityService
{
    public function __construct(private CityRepositoryInterface $repository, private CountryRepositoryInterface $cityRepository)
    {

    }

    public function index()
    {
        $cities = $this->cityRepository->getById(request()->input('city'), relations: ['cities'])->cities;
        return view('dashboard.site.cities.index', compact('cities'));
    }


    public function create()
    {
        return view('dashboard.site.cities.create',)->with(['country_id' => request('country_id')]);
    }

    public function store($request)
    {
        try {
            $data = $request->validated();
            store_model($this->repository, $data);
            return redirect()->route('country.cities', $request->country_id)->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $city = $this->repository->getById($id);
        return view('dashboard.site.cities.edit', compact('city'));
    }

    public function update($request, $id)
    {
        try {
            $data = $request->validated();
            $country_id = $this->repository->getById($id)->country_id;
            update_model($this->repository, $id, $data);
            return redirect()->route('country.cities',$country_id )->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            $country_id = $this->repository->getById($id)->country_id;
            delete_model($this->repository, $id);
            return redirect()->route('country.cities', $country_id)->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
