<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_status';

    protected $fillable = [
        'id_status',
        'name_status'
    ];

    public function tasks()
    {
        return $this->belongsTo(Task::class, 'id_task');
    }
}
