<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class indexTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id_task' => ['required'],
            'text_task' => ['required'],
            'head_task' => ['required'],
            'date_publication' => ['required'],
            'date_start' => ['required'],
            'date_end' => ['required'],
            'id_status' => ['required'],
            'id_task_color' => ['required'],
            'id_user_channel' => ['required'],
        ];
    }
}
