<?php

namespace App\Http\Resources;

use App\Models\UserChannel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexUsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_user' => $this->id_user,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_user'=> $this->phone_user,
            'patronomic'=> $this->patronomic,
            'name_role' => UserChannel::where([['id_user', $this->id_user], ['id_channel', $this->pivot->id_channel]])->first()->name_role,
        ];
    }
}
