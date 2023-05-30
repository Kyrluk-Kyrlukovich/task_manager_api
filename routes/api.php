<?php

use App\Http\Controllers\ChannelsController;
use App\Http\Controllers\ColorTasksController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserFunctionsController;
use App\Http\Controllers\UsersController;
use App\Models\User;
use App\Models\UserFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Переделать====================================================================>


//Переделать====================================================================>

Route::post('/signup', [UsersController::class, 'signup']);
Route::match(['post'], '/login', [UsersController::class, 'login']);
Route::get('/task-color', [ColorTasksController::class, 'index']);
Route::get('statuses', [StatusesController::class, 'index']);

Route::middleware('auth:sanctum')->group(function() {
  Route::get('logout', [UsersController::class, 'logout']);
  Route::get('users', [UsersController::class, 'index']);
  Route::get('channel/{id}/settings', [UsersController::class, 'usersChannel']);

  Route::get('channels', [ChannelsController::class, 'index']);
  Route::get('channel/{id}', [ChannelsController::class, 'show']);
  Route::post('channels/create-channel', [ChannelsController::class, 'store']);
  Route::post('channel/{id}/settings/adduser', [ChannelsController::class, 'addUserInChannel']);
  Route::post('channel/{id}/settings', [ChannelsController::class, 'updateChannel']);

  Route::post('channels/{id}/create-task', [TaskController::class, 'store']);
  Route::get('channels/{id}/tasks', [TaskController::class, 'index']);
  Route::post('channel/{id}', [TaskController::class, 'updateTask']);

  Route::post('userfunctions/{id}', [UserFunctionsController::class, 'getUserFunction']);
  Route::get('userfunctions', [UserFunctionsController::class, 'index']);
});
