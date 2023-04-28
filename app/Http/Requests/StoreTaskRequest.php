<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text_task' => ['nullable', 'string'],
            'head_task' => ['required', 'string'],
            'date_start' => ['required', 'date_format:"d.m.Y H:i"'],
            'date_end' => ['nullable', 'date_format:"d.m.Y H:i"'],
            'id_status' =>['required', 'exists:statuses,id_status'],
            'id_task_color'=>['required', 'exists:task_colors,id_color'],
        ];
    }
}
