<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatroomDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'chatroom_id',
        'user_id',
        'owner_id',
        'message',
    ];
}
