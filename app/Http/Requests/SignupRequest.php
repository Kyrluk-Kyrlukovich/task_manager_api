<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required','string', 'max:20'],
            'last_name' => ['required','string', 'max:20'],
            'email' => ['required','string', 'max:30', 'email:rfc,dns'],
            'password' => ['required','string'],
            'phone_user' => ['required','string', 'max:20']
        ];
    }
}
