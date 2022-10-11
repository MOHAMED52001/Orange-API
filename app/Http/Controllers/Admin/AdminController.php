<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\AdminInterface;
use Illuminate\Http\Request;
use App\Models\User;
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

    public function register(Request $request)
    {
        return $this->AdminInterface->register($request);
    }

    public function login(Request $request)
    {
        return $this->AdminInterface->login($request);
    }

    public function logout()
    {
        return $this->AdminInterface->logout();
    }

    public function show($id)
    {
        return $this->AdminInterface->show($id);
    }

    public function update(Request $request, $id)
    {
        return $this->AdminInterface->update($request, $id);
    }

    public function delete($id)
    {
        return $this->AdminInterface->delete($id);
    }
}
