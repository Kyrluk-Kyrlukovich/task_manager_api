<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexUserFunctionsResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->userFunctions
        ];
    }
}
