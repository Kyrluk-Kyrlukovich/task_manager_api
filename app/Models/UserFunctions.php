<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFunctions extends Model
{
    use HasFactory;

    
    public $primaryKey = 'id_user_functions';

    protected $table = 'user_functions';

    protected $fillable = [
        'id_user_functions',
        'name_functions',
        'function',
    ];

    public function userChannels()
    {
        return $this->belongsToMany(UserChannel::class, 'user_channel_functions', 'id_user_channel', 'id_user_function');
    }
}
