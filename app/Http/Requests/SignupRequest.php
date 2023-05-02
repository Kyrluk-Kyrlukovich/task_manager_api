<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SignupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required','string', 'max:20'],
            'last_name' => ['required','string', 'max:20'],
            'email' => ['required','string', 'max:30', 'email:rfc,dns', 'unique:users,email'],
            'password' => ['required','string'],
            'phone_user' => ['required','string', 'max:20']
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
            ])   
        );
    }
}
