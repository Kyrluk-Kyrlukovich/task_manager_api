<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserInChannelRequest;
use App\Http\Requests\DeleteUserFromChannelRequest;
use App\Http\Requests\StoreChannelRequest;
use App\Http\Requests\UpdateChannelRequest;
use App\Http\Resources\IndexTasksResource;
use App\Http\Resources\IndexUserChannelForTasks;
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
        $channel = Channel::create($request->validated());
        $channel->users()->attach($user->id_user, ['name_role' => 'Администратор', 'creator'=>1]);
        $userChannel = UserChannel::where([['id_user', $user->id_user], ['id_channel', $channel->id_channel]])->first();
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
        $checkUserChannel = UserChannel::where([['id_user', $user->id_user], ['id_channel', $id]])->first();
        $functions = $checkUserChannel->userFunctions;
        $root = false;
        foreach ($functions as $key => $value) {
            if ($value->function == 'watch_channel' || $value->function == 'all_functions') {
                $root = true;
            }
        }
        $userChannel = UserChannel::where('id_channel', $id)->get();
        if ($checkUserChannel) {
            if ($root) {
                $tasksForResource = array();
                foreach ($userChannel as $key => $value) {
                    $tasks = $value->tasks;
                    foreach ($tasks as $k => $v) {
                        array_push($tasksForResource, $v);
                    }
                }
                return IndexTasksResource::collection($tasksForResource);
            } else {
                return response()->json([
                    'error' => [
                        'code' => 403,
                        'message' => 'У вас не достаточно прав для просмотра канала'
                    ]
                ], 403);
            }
        } else {
            return response()->json([
                'error' => [
                    'code' => 403,
                    'message' => 'Вы не состоит в этом канале'
                ]
            ], 403);
        }
    }

    public function addUserInChannel(string $id, AddUserInChannelRequest $request)
    {
        $user = Auth::user();
        $checkUserChannel = UserChannel::where([['id_user', $user->id_user], ['id_channel', $id]])->first();
        if ($checkUserChannel) {
            $functions = $checkUserChannel->userFunctions;
            $root = false;
            foreach ($functions as $key => $value) {
                if ($value->function == 'add_user' || $value->function == 'all_functions') {
                    $root = true;
                }
            }
            if ($root) {
                $checkExistsUserInChannel = UserChannel::where([['id_user', $request->id_user], ['id_channel', $id]])->first();
                if (!$checkExistsUserInChannel) {
                    $channel = Channel::find((int) $id);
                    $channel->users()->attach($request->id_user, ['name_role' => 'Участник', 'creator' => 0]);
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
                        'message' => 'У вас не достаточно прав для добавления пользователя в канал'
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

    public function deleteUserFromChannel(string $id, DeleteUserFromChannelRequest $request)
    {
        $user = Auth::user();
        $checkUserChannel = UserChannel::where([['id_user', $user->id_user], ['id_channel', $id]])->first();
        if ($checkUserChannel) {
            $functions = $checkUserChannel->userFunctions;
            $root = false;
            foreach ($functions as $key => $value) {
                if ($value->function == 'remove_user' || $value->function == 'all_functions') {
                    $root = true;
                }
            }
            if ($root && $request->id_user != $user->id_user) {
                $channel = Channel::find((int) $id);
                $channel->users()->detach($request->id_user);
                return response()->json([
                    'data' => [
                        'message' => 'Пользователь удален'
                    ]
                ], 200);
            } else {
                return response()->json([
                    'error' => [
                        'code' => 403,
                        'message' => 'У вас не достаточно прав для удаления пользователя в этом канале'
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

    function leaveFromChannel(string $id) {
        $user = Auth::user();
        $checkUserChannel = UserChannel::where([['id_user', $user->id_user], ['id_channel', $id]])->first();
        if($checkUserChannel && !$checkUserChannel->creator) {
            $channel = Channel::find((int) $id);
                $channel->users()->detach($user->id_user);
                return response()->json([
                    'data' => [
                        'message' => 'Вы покинули этот канал'
                    ]
                ], 200);
        } else {
            return response()->json([
                'error' => [
                    'code' => 403,
                    'message' => 'Вы не состоите в этом канале или являетесь влальцем и не можете покинуть этот канал'
                ]
            ], 403);
        }

    }

    public function updateChannel(string $id, UpdateChannelRequest $request)
    {
        $user = Auth::user();
        $userChannel = UserChannel::where([['id_channel', $id], ['id_user', $user->id_user]])->first();
        if ($userChannel) {
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

    public function checkCreator(string $id)
    {
        $user = Auth::user();
        $creator = false;
        $userChannel = UserChannel::where([['id_channel', $id], ['id_user', $user->id_user], ['creator', 1]])->first();
        if($userChannel) {
            $creator = true;
        } 
        return response()->json([
            'data' => [
                'creator' => $creator
            ]
        ], 200);
    }
}
