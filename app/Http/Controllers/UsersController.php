<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\SignupResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function signup(SignupRequest $request)
    {
        $user = User::create(['password' => Hash::make($request->password)] + $request->validated());
        return new SignupResource($user);
    }

    public function login(LoginRequest $request)
    {
        if(Auth::attempt($request->only(['email', 'password']))) {
            $user = Auth::user();
            $user->tokens()->delete();
            return response()->json([
                'data' => [
                    'token' => $user->createToken('api')->plainTextToken
                ]
            ]);
        } else {
            return response()->json([
                'error' => [
                    'code' => '403',
                    'message' => 'Login failed'
                ]
            ]);
        }
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return response()->json([
            'data' => [
                'message' => 'Logout'
            ]
        ]);
    }
}
