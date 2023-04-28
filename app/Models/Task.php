<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_task',
        'text_task',
        'head_task',
        'date_publication',
        'date_start',
        'date_end',
        'id_status',
        'id_task_color',
        'id_user_channel',
    ];
}
