<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addFunctionsController extends FormRequest
{
    public function rules(): array
    {
        return [
            'id_user' => ['required', 'exists:users,id_user'],
            'roles' => ['required', 'array']
        ];
    }
}
