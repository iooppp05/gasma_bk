<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $data['password'] = bcrypt($request->password);

        $user = User::create($data);
        $token = $user->createToken('authToken')->accessToken;

        return response(['user'=> $user, 'access_token'=> $token], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if(!auth::attempt($credentials)){
            return response()->json(['message'=> 'Invalid credentials'], 401);
        }
        
         $token = auth()->user()->createToken('authToken')->accessToken;
        return response(['user'=> auth()->user(), 'access_token'=> $token], 200);
    }
}

