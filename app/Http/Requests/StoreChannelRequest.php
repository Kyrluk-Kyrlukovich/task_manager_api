<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChannelRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_channel' => ['required', 'unique:channels,name_channel']
        ];
    }
}
