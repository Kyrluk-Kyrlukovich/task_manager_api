<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Channel extends Model
{
    use HasFactory;

    public $primaryKey = 'id_user_channel';

    protected $table = 'user_channel';

    protected $fillable = [
        'id_user_channel',
        'name_role',
        'id_user',
        'id_channel',
        'id_user_function'
    ];

}
