<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    public $primaryKey = 'id_channel';
    public $timestamps = false;

    protected $fillable = [
        'id_channel',
        'name_channel',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_channel', 'id_channel', 'id_user');
    }
}
