<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserInChannelRequest;
use App\Http\Requests\StoreChannelRequest;
use App\Http\Requests\UpdateChannelRequest;
use App\Http\Resources\IndexTasksResource;
use App\Http\Resources\IndexUsersResource;
use App\Models\Channel;
use App\Models\Task;
use App\Models\UserChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChannelsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $check = UserChannel::where('id_user', $user->id_user)->exists();
        if ($check) {
            $channels = $user->channels;
            return response()->json([
                'data' => $channels
            ]);
        } else {
            return response()->json([
                'error' => [
                    'code' => '403',
                    'message' => 'Channels not found'
                ]
            ], 403);
        }
    }

    public function store(StoreChannelRequest $request)
    {
        $user = Auth::user();
        $channel = Channel::create(['name_role' => 'creator'] + $request->validated());
        $channel->users()->attach($user->id_user, ['name_role' => 'creator']);
        $userChannel = UserChannel::where([['id_user', $user->id_user],['id_channel', $channel->id_channel]])->first();
        $userChannel->userFunctions()->attach([2]);
        return response()->json([
            'data' => [
                'message' => 'Канал создан'
            ]
        ], 200);
    }

    public function show(string $id)
    {
        $user = Auth::user();
        $userChannel = UserChannel::where([['id_user', $user->id_user], ['id_channel', (int)$id]])->first();
        if ($userChannel) {
            $tasks = $userChannel->tasks()->get();
            return IndexTasksResource::collection($tasks);
        } else {
            return response()->json([
                'error' => [
                    'code' => 403,
                    'message' => 'Channel not found'
                ]
            ], 403);
        }
    }

    public function addUserInChannel(string $id, AddUserInChannelRequest $request)
    {
        $user = Auth::user();
        $checkUserChannel = UserChannel::where([['id_user', $user->id_user], ['id_channel', $id]])->first();
        if ($checkUserChannel) {
            $checkExistsUserInChannel = UserChannel::where([['id_user', $request->id_user], ['id_channel', $id]])->first();
            if (!$checkExistsUserInChannel) {
                $channel = Channel::find((int) $id);
                $channel->users()->attach($request->id_user, ['name_role' => 'Участник']);
                $addedUser = UserChannel::where([['id_user', $request->id_user], ['id_channel', $id]])->first();
                $addedUser->userFunctions()->attach(7);
                return response()->json([
                    'data' => [
                        'message' => 'Пользователь добавлен'
                    ]
                ], 200);
            } else {
                return response()->json([
                    'error' => [
                        'code' => 403,
                        'message' => 'Такой пользователь уже есть в канале'
                    ]
                ], 403);
            }
        } else {
            return response()->json([
                'error' => [
                    'code' => 403,
                    'message' => 'Вы не состоите в этом канале'
                ]
            ], 403);
        }
    }

    public function updateChannel(string $id, UpdateChannelRequest $request)
    {
        $user = Auth::user();
        $userChannel = UserChannel::where([['id_channel', $id], ['id_user', $user->id_user]])->first();
        if($userChannel) {
            $channel = Channel::where('id_channel', $id)->first();
            $channel->update($request->validated());
            return response()->json([
                'data' => [
                    'message' => 'Название обновлено'
                ]
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'code' => 403,
                    'message' => 'Вы не состоите в этом канале'
                ]
            ], 403);
        }
    }
}
