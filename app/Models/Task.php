<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tasks';

    protected $primaryKey = 'id_task'; 

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

    public function userChannel()
    {
        return $this->belongsTo(UserChannel::class, 'id_user_channel', 'id_task');
    }

    public function color()
    {
        return $this->belongsTo(TaskColor::class, 'id_task_color');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
