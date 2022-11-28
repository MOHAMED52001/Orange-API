<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponseTrait;

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

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->apiResponse(401, 'Login Failed', "Invalid Credentials");
        }

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('UserToken')->plainTextToken;

        $response = [
            'User' => $user,
            'Token' => $token
        ];

        return $this->apiResponse(200, 'Logged In Successfully', null, $response);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $this->apiResponse(200, 'Logged out successfully');
    }
}