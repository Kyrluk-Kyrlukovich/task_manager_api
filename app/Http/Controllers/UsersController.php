<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserOnChannelRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\IndexUsersChannel;
use App\Http\Resources\IndexUsersResource;
use App\Http\Resources\SignupResource;
use App\Models\Channel;
use App\Models\User;
use App\Models\UserChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => User::all()
        ]);
    }

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

    public function usersChannel(string $id)
    {
        $user = Auth::user();
        $checkUserChannel = UserChannel::where([['id_user', $user->id_user], ['id_channel', $id]])->first();
        if($checkUserChannel) {
            $channel = Channel::find((int) $id);
            return new IndexUsersChannel($channel);

        } else {
            return response()->json([
                'error' => [
                    'code' => '403',
                    'message' => 'Вы не состоите в этом канале'
                ]
            ]);
        }
    }
}
