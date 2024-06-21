<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->name,
        ]);

        $token = $user->createToken('authToken')->accessToken;
        
        return response()->json(['token' => $token], 200);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('authToken')->accessToken;
                return response()->json(['token' => $token], 200);
            } else {
                return response()->json(['message' => "Password mismatch"], 422);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
