<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexUsersChannel extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'channel' => [
                'id_channel' => $this->id_channel,
                'name_channel' => $this->name_channel 
            ],

            'users' => IndexUsersResource::collection($this->users)
        ];
    }
}
