<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChannel extends Model
{
    use HasFactory;

    public $primaryKey = 'id_user_channel';

    protected $table = 'user_channel';

    protected $fillable = [
        'id_user_channel',
        'name_role',
        'id_user',
        'id_channel',
    ];

    public function userFunctions()
    {
        return $this->belongsToMany(UserFunctions::class, 'user_channel_functions', 'id_user_channel', 'id_user_function');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'id_user_channel', 'id_user_channel');
    }
}
