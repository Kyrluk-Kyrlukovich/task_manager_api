<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text_task' => ['nullable', 'string'],
            'head_task' => ['required', 'string'],
            'date_start' => ['required', 'date_format:d.m.Y H:i'],
            'date_end' => ['nullable', 'date_format:d.m.Y H:i'],
            'id_status' =>['required', 'exists:statuses,id_status'],
            'id_task_color'=>['required', 'exists:task_colors,id_color'],
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
