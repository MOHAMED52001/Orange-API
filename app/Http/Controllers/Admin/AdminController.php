<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return all Admins 
        return json_encode([
            'Admins' => User::all()
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //Create A New Admin
        $formFilds = $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:admins,email|string',
            'phone' => 'required|unique:admins,phone|string',
            'national_id' => 'required|unique:admins,national_id|string',
            'password' => 'required|confirmed|string',
        ]);


        $formFilds['password'] = bcrypt($formFilds['password']);

        $admin = User::create($formFilds);

        $token = $admin->createToken('AdminToken')->plainTextToken;

        $response = [
            'Admin' => $admin,
            'Token' => $token
        ];

        return response($response, 201);
    }

    //Admin Login
    public function login(Request $request)
    {
        $formFilds = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);



        $admin = User::where('email', $formFilds['email'])->first();

        if (!$admin || password_verify($formFilds['password'], $admin->password)) {
            return response([
                "message" => "Invalid Credentials"
            ], 401);
        }


        $token = $admin->createToken('AdminToken')->plainTextToken;

        $response = [
            'Admin' => $admin,
            'Token' => $token
        ];

        return response($response, 201);
    }

    //Admin Logout 
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Logged out successfully',

        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get Specific Admin 
        $admin = User::find($id);

        if ($admin != null) {
            return $admin;
        } else {
            return json_encode([
                'message' => 'Admin Not Found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
