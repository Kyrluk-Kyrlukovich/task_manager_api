<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFunctionRequest;
use App\Http\Resources\IndexUserFunctionsResource;
use App\Models\UserChannel;
use App\Models\UserFunctions;
use Illuminate\Http\Request;

class UserFunctionsController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => UserFunctions::all()
        ]);
    }

    public function getUserFunction(string $id, UserFunctionRequest $request)
    {
        $userChannel = UserChannel::where([['id_user', $request->id_user], ['id_channel', $id]])->first();
        return new IndexUserFunctionsResource($userChannel);
    }
}
