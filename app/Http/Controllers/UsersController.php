<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\IndexUsersChannel;
use App\Http\Resources\SignupResource;
use App\Models\Channel;
use App\Models\User;
use App\Models\UserChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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
        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = Auth::user();
            $user->tokens()->delete();
            $token = $user->createToken('api');
            return response()->json([
                'data' => [
                    'token' => $token->plainTextToken
                ]
            ])->withCookie('Bearer Token', $token->plainTextToken, 10);
        } else {
            return response()->json([
                'error' => [
                    'code' => '403',
                    'message' => 'Неверный логин или пароль'
                ]
            ], 403);
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
        ], 200);
    }

    public function showUserFunction(string $id)
    {
        $user = Auth::user();
        $userChannel = UserChannel::where([['id_user', $user->id_user], ['id_channel', $id]])->first();
        if ($userChannel) {
            return response()->json([
                'data' => $userChannel->userFunctions
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'code' => '403',
                    'message' => 'Вы не состоите в этом канале'
                ]
            ]);
        }
    }

    public function authUser()
    {
        $user = Auth::user();
        return response()->json([
            'data' => [
                'firstName' => $user->first_name,
                'lastName' => $user->last_name,
                'patronymic' => $user->patronomic,
                'phoneUser' => $user->phone_user,
                'email' => $user->email,
            ]
        ], 200);
    }

    public function updateUser(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $emailCheck = User::where([['email', $request->email], ['id_user', '!=', $user->id_user]])->first();
        if (!$emailCheck) {
            $user->update($request->validated());
            return response()->json([
                'data' => [
                    'message' => 'Данные изменены',
                ]
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'code' => '403',
                    'message' => 'Этот email уже используется'
                ]
            ]);
        }
    }

    public function usersChannel(string $id)
    {
        $user = Auth::user();
        $checkUserChannel = UserChannel::where([['id_user', $user->id_user], ['id_channel', $id]])->first();
        if ($checkUserChannel) {
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
