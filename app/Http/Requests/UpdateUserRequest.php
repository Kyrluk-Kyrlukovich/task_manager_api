<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'max:20'],
            'last_name' => ['string', 'max:20'],
            'email' => ['string', 'max:30', 'email:rfc,dns'],
            'phone_user' => ['string', 'max:20'],
            'patronymic' => ['string', 'max:20']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'error' => [
                    'code' => 422,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ]
            ], 422)
        );
    }
}
