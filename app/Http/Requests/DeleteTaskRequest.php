<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id_task' => ['required', 'exists:tasks,id_task']
        ];
    }
}
