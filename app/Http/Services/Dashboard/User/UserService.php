<?php

namespace App\Http\Services\Dashboard\user;

use App\Repository\OtpRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function App\delete_model;
use function App\store_model;
use function App\update_model;

class UserService
{
    public function __construct(private UserRepositoryInterface $repository,private OtpRepositoryInterface $otpRepository)
    {
    }

    public function create()
    {
        return view('dashboard.site.users.create');
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['is_active'] = 1;
            $this->otpRepository->generate($data['email']);
            $this->otpRepository->verify($data['email']);
            store_model($this->repository, $data);
            DB::commit();
            return redirect()->route('companies.users', $request->company_id)->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
    public function show($id)
    {
        $user = $this->repository->getById($id,relations: ['company']);
        return view('dashboard.site.users.show', compact('user'));
    }
    public function edit($id)
    {
        $user = $this->repository->getById($id);
        return view('dashboard.site.users.edit', compact('user'));
    }

    public function update($request, $id)
    {
        try {
            $user=$this->repository->getById($id);
            $data = $request->validated();
            if ($data['password'] == null) {
                unset($data['password']);
            }
            update_model($this->repository, $id, $data);
            return redirect()->route('companies.users', $user->company_id)->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            delete_model($this->repository, $id);
            return redirect()->back()->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
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
}
