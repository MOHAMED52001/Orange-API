<?php


namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Interfaces\AdminInterface;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;

class AdminRepository implements AdminInterface
{
    use  ApiResponseTrait;

    public function index()
    {
        return $this->apiResponse(200, "Success", null, User::all());
    }
    public function show(User $user)
    {
        return $this->apiResponse(200, "Admin Found", null, $user);
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
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->apiResponse(200, 'Logged out successfully');
    }
    public function login(Request $request)
    {
        $formFilds = Validator::make(
            $request->all(),
            [
                'email' => 'required|string',
                'password' => 'required|string',
            ]
        );

        if ($formFilds->fails()) {
            return  $this->apiResponse(400, "Validation Error", $formFilds->errors());
        }

        $admin = User::where('email', $request->email)->first();

        if (!$admin || !password_verify($request->password, $admin->password)) {
            return $this->apiResponse(401, 'Invalid Credentials');
        }


        $token = $admin->createToken('AdminToken')->plainTextToken;

        $response = [
            'Admin' => $admin,
            'Token' => $token
        ];

        return $this->apiResponse(200, 'Logged In Successfully', null, $response);
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
