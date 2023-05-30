<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id_task'=> ['required', 'exists:tasks,id_task'],
            'head_task' => ['nullable', 'string'],
            'text_task' => ['nullable', 'string'],
            'date_start' => ['nullable', 'date_format:d.m.Y H:i', 'unique:tasks,date_start'],
            'id_status' =>['nullable', 'exists:statuses,id_status'],
            'id_task_color'=>['nullable', 'exists:task_colors,id_color'],
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
