<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\AdminInterface;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AdminController extends Controller
{
    public $AdminInterface;
    public function __construct(AdminInterface $AdminInterface)
    {
        $this->AdminInterface = $AdminInterface;
    }

    public function index()
    {
        return $this->AdminInterface->index();
    }

    public function show(User $user)
    {
        return $this->AdminInterface->show($user);
    }

    public function store(StoreAdminRequest $request)
    {
        return $this->AdminInterface->store($request);
    }

    public function login(Request $request)
    {
        return $this->AdminInterface->login($request);
    }

    public function logout()
    {
        return $this->AdminInterface->logout();
    }

    public function update(User $admin, UpdateAdminRequest $request)
    {
        return $this->AdminInterface->update($admin, $request);
    }

    public function destroy(User $admin)
    {
        return $this->AdminInterface->destroy($admin);
    }
}
