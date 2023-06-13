<?php

namespace App\Http\Controllers;

use App\Http\Requests\addFunctionsRequest;
use App\Http\Requests\UserFunctionRequest;
use App\Http\Resources\IndexUserFunctionsResource;
use App\Models\UserChannel;
use App\Models\UserChannelFunctions;
use App\Models\UserFunctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFunctionsController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => UserFunctions::all()
        ], 200);
    }

    public function getUserFunction(string $id, UserFunctionRequest $request)
    {
        $userChannel = UserChannel::where([['id_user', $request->id_user], ['id_channel', $id]])->first();
        return new IndexUserFunctionsResource($userChannel);
    }

    public function addFunctions(string $id, addFunctionsRequest $request)
    {
        $userEditor = Auth::user();
        $userChannelEditor = UserChannel::where([['id_channel', $id], ['id_user', $userEditor->id_user]])->first();
        if ($userChannelEditor) {
            $userChannelFunctionEditor = UserChannelFunctions::where([['id_user_channel', $userChannelEditor->id_user_channel], ['id_user_function', 2]])->first();
            if ($userChannelFunctionEditor && $request->id_user != $userChannelEditor->id_user) {
                $userChannel = UserChannel::where([['id_channel', $id], ['id_user', $request->id_user]])->first();
                $userChannel->userFunctions()->sync($request->functions);
                return response()->json([
                    'data' => [
                        'message' => 'Настройки изменены'
                    ]
                ], 200);
            } else {
                return response()->json([
                    'data' => [
                        'code' => '403',
                        'message' => 'У вас недостаточно прав для этого действия'
                    ]
                ], 403);
            }
        } else {
            return response()->json([
                'data' => [
                    'code' => '403',
                    'message' => 'Channel not found'
                ]
            ], 403);
        }
    }
}
