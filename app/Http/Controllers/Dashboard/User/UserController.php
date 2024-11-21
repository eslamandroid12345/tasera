<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\UserRequest;
use App\Http\Services\Dashboard\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $service)
    {
        $this->middleware('permission:users-read')->only('index','show');
        $this->middleware('permission:users-create')->only('create','store');
        $this->middleware('permission:users-update')->only('edit','update');
        $this->middleware('permission:users-delete')->only('destroy');
    }
    public function show($id){
        return $this->service->show($id);
    }
    public function create()
    {
        return $this->service->create();
    }
    public function store(UserRequest $request)
    {
        return $this->service->store($request);
    }
    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(UserRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }

    public function toggle()
    {
        return $this->service->toggle();
    }
}
