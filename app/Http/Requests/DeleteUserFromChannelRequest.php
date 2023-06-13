<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteUserFromChannelRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id_user' => ['required', 'exists:users,id_user']
        ];
    }
}
