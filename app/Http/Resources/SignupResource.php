<?php

namespace App\Http\Resources;

use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SignupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'message' => 'User created'
        ];
    }
}
