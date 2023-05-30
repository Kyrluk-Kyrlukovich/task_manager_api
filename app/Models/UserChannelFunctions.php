<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChannelFunctions extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    protected $table = 'user_channel_functions';

    protected $fillable = [
        'id',
        'id_user_channel',
        'id_user_function',
    ];
}
