<?php


namespace App\Http\Repositories;

use App\Models\User;
use App\Http\Interfaces\AdminInterface;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminRepository implements AdminInterface
{
    use  ApiResponseTrait;

    public function index()
    {
        // return all Admins
        $admins = User::get();

        if (!is_null($admins)) {
            return $this->apiResponse(200, "Success", null, $admins);
        }
        return  $this->apiResponse(200, "There Is No Records In Database");
    }
    public function register(Request $request)
    {
        $formFilds = Validator::make($request->all(), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:admins,email|string',
            'phone' => 'required|unique:admins,phone|string',
            'national_id' => 'required|unique:admins,national_id|string',
            'password' => 'required|confirmed|string',
        ]);

        if ($formFilds->fails()) {
            return  $this->apiResponse(400, "Validation Error", $formFilds->errors());
        }


        $admin = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'national_id' => $request->national_id,
            'password' => bcrypt($request->password),
        ]);



        $token = $admin->createToken('AdminToken')->plainTextToken;

        $response = [
            'Admin' => $admin,
            'Token' => $token
        ];
        return $this->apiResponse(201, "Created Successfully", null, $response);
    }
    public function  show($id)
    {
        $admin = User::find($id);
        if (!is_null($admin)) {
            return $this->apiResponse(200, "Admin Found", null, $admin);
        }
        return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
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
    public function update(Request $request, $id)
    {
        $admin = User::find($id);

        if ($admin != null) {
            $formFilds = Validator::make($request->all(), [
                'fname' => 'string',
                'lname' => 'string',
                'email' => 'email|unique:admins,email|string',
                'phone' => 'unique:admins,phone|string',
                'national_id' => 'unique:admins,national_id|string',
            ]);

            if ($formFilds->fails()) {
                return $this->apiResponse(400, "Validation Error", $formFilds->errors());
            }


            $admin->update($request->all());
            $response = [
                'Admin' => $admin,
            ];

            return $this->apiResponse(200, "Updated Successfully", null, $response);
        } else {
            return $this->apiResponse(404, "Admin Not Found");
        }
    }
    public function delete($id)
    {
        $admin = User::find($id);
        if (!is_null($admin)) {

            User::destroy($admin->id);
            return $this->apiResponse(200, "Admin Deleted", null, $admin);
        }
        return  $this->apiResponse(200, "There Is No Records That Match The Given Id In Database");
    }
}
