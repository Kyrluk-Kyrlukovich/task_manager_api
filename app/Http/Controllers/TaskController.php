<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\IndexTasksResource;
use App\Models\Channel;
use App\Models\Task;
use App\Models\User_Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(string $id)
    {
        $user = Auth::user();
        $check = User_Channel::where([['id_channel', $id], ['id_user', $user->id_user]])->exists();
        if ($check) {
            $user_channel = User_Channel::where([['id_channel', $id], ['id_user', $user->id_user]])->get();
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
        $check = User_Channel::where([['id_channel', $id], ['id_user', $user->id_user]])->exists();
        $user_channel = User_Channel::where([['id_channel', $id], ['id_user', $user->id_user]])->get();
        if($check) {
            if(isset($request->date_end)){
                $task = Task::create([
                    'date_start' => date("Y-m-d H:i",strtotime($request->date_start)),
                    'date_end' => date("Y-m-d H:i",strtotime($request->date_end)),
                    'id_user_channel' => $user_channel[0]->id_user_channel] 
                    + $request->validated());
            } else {
                $task = Task::create([
                    'date_start' => date("Y-m-d H:i",strtotime($request->date_start)), 
                    'id_user_channel' => $user_channel[0]->id_user_channel] + $request->validated());
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
}
