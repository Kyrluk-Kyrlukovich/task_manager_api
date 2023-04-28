<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChannelRequest;
use App\Http\Resources\IndexTasksResource;
use App\Models\Channel;
use App\Models\Task;
use App\Models\User_Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChannelsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $check = User_Channel::where('id_user', $user->id_user)->exists();
        if ($check) {
            $channels = $user->channels;
            return $channels;
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
}
