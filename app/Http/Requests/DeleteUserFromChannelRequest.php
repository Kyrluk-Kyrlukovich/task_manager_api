<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteUserFromChannelRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id_user' => ['required', 'exists:users,id_user']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
                'error' => [
                    'code' => 422,
                    'message'=> 'Validation failed',
                    'errors' => $validator->errors()
                ]
            ], 422)
        );
    }
}
