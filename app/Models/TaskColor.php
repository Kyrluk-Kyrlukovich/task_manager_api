<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskColor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_color';

    protected $fillable = [
        'id_color',
        'name_color',
        'tag_color'
    ];

    public function tasks()
    {
        return $this->belongsTo(Task::class, 'id_task');
    }
}
