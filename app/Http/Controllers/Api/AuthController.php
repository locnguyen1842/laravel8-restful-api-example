<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class AuthController extends BaseApiController
{
    public function login(Request $request) {
        $validatedData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($validatedData)) {
            return response(['message' => 'Invalid credentials'], 404);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user() , 'access_token' => $accessToken]);
    }
}
