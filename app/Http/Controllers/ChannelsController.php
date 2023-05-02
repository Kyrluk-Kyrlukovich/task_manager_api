<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChannelRequest;
use App\Http\Resources\IndexTasksResource;
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
        $channel->users()->attach($user->id_user, ['name_role' => 'creator', 'id_user_function' => 1]);
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
        //dd($userChannel);
        if ($userChannel) {
            //dd($userChannel->id_user_channel);
           // dd(Task::where('id_user_channel', $userChannel->id_user_channel)->get());
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
}
