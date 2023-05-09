<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexTasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_task' => $this->id_task,
            'text_task' => $this->text_task,
            'head_task' => $this->head_task,
            'date_publication' => [
                'day' => date('d', strtotime($this->date_publication)),
                'month' => date('m', strtotime($this->date_publication)),
                'year' => date('Y', strtotime($this->date_publication)),
                'hour' => date('H', strtotime($this->date_publication)),
                'minutes' => date('i', strtotime($this->date_publication)),
            ],
            'date_start' => [
                'day' => date('d', strtotime($this->date_start)),
                'month' => date('m', strtotime($this->date_start)),
                'year' => date('Y', strtotime($this->date_start)),
                'hour' => date('H', strtotime($this->date_start)),
                'minutes' => date('i', strtotime($this->date_start)),
            ],
            'date_end' => [
                'day' => date('d', strtotime($this->date_end)),
                'month' => date('m', strtotime($this->date_end)),
                'year' => date('Y', strtotime($this->date_end)),
                'hour' => date('H', strtotime($this->date_end)),
                'minutes' => date('i', strtotime($this->date_end)),
            ],
            'status' => $this->status,
            'color' => $this->color,
            'id_user_channel' => $this->id_user_channel,
        ];
    }
}
