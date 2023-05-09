<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\IndexTasksResource;
use App\Models\Channel;
use App\Models\Task;
use App\Models\User_Channel;
use App\Models\UserChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(string $id)
    {
        $user = Auth::user();
        $check = UserChannel::where([['id_channel', $id], ['id_user', $user->id_user]])->exists();
        if ($check) {
            $user_channel = UserChannel::where([['id_channel', $id], ['id_user', $user->id_user]])->get();
            $tasks = IndexTasksResource::collection(Task::where('id_user_channel', $user_channel[0]->id_user_channel)->get());
            return $tasks;
        } else {
            return response()->json([
                'data' => [
                    'code' => '403',
                    'message' => 'Channel not found'
                ]
            ], 403);
        }
    }

    public function store(string $id, StoreTaskRequest $request)
    {
        $user = Auth::user();
        $user_channel = UserChannel::where([['id_channel', $id], ['id_user', $user->id_user]])->first();
        if($user_channel) {
            if(isset($request->date_end)){
                $task = Task::create([
                    'date_start' => date("Y-m-d H:i",strtotime($request->date_start)),
                    'date_end' => date("Y-m-d H:i",strtotime($request->date_end)),
                    'id_user_channel' => $user_channel->id_user_channel] 
                    + $request->validated());
            } else {
                $task = Task::create([
                    'date_start' => date("Y-m-d H:i",strtotime($request->date_start)), 
                    'id_user_channel' => $user_channel->id_user_channel] + $request->validated());
            }
            
            return response()->json([
                'data' => [
                    'message' => 'Задача создана'
                ]
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Канал не найден'
                ]
            ], 403);
        }
    }

    public function updateTask(string $id, UpdateTaskRequest $request)
    {
        $user = Auth::user();
        $userChannelCheck = UserChannel::where([['id_channel', $id], ['id_user', $user->id_user]])->first();
        if($userChannelCheck) {
            $userTaskCheck = Task::where([['id_task', $request->id_task], ['id_user_channel', $userChannelCheck->id_user_channel]])->first();
            if($userTaskCheck) {

                $userTaskCheck->update(['date_start' => date("Y-m-d H:i",strtotime($request->date_start))] + $request->validated());
                return response()->json([
                    'data' => new IndexTasksResource($userTaskCheck) 
                ], 200);
            } else {
                return response()->json([
                    'error' => [
                        'message' => 'Это не ваша задача'
                    ]
                ], 403);
            }
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Вы не состоите в этом канале'
                ]
            ], 403);
        }
    }
}
