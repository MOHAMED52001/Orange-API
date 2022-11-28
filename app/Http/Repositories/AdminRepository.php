<?php


namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Interfaces\AdminInterface;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Role;

class AdminRepository implements AdminInterface
{
    use  ApiResponseTrait;

    public function index()
    {
        $admins = User::where('role_id', Role::SUPER_ADMIN)
            ->orWhere('role_id', Role::ADMIN)->get();

        return $this->apiResponse(200, "Success", null, $admins);
    }
    public function show(User $user)
    {
        return $this->apiResponse(200, "Success", null, $user);
    }
    public function store(StoreAdminRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($request->password);

        $admin = User::create($data);

        $token = $admin->createToken('AdminToken')->plainTextToken;

        $response = [
            'Admin' => $admin,
            'Token' => $token
        ];
        return $this->apiResponse(201, "Created Successfully", null, $response);
    }
    public function update(User $admin, UpdateAdminRequest $request)
    {
        $admin->update($request->validated());

        return $this->apiResponse(200, "Updated Successfully", null, $admin);
    }
    public function destroy(User $admin)
    {
        User::destroy($admin->id);
        return $this->apiResponse(200, "Admin Deleted", null, $admin);
    }
}