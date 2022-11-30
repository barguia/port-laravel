<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!auth()->attempt($loginData)) {
            return response('Invalid credentials', 401);
        }

        return response([
            'user' => auth()->user(),
            'access_token' => auth()->user()->createToken('authToken')->accessToken
        ]);
    }

    public function logout()
    {
        if (auth()->user()) {
            auth()->logout();
        }

        return response([
            'message' => 'Logged out'
        ]);
    }
}
