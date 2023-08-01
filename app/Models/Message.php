<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table='messages';

    protected $fillable = [
        'chat_id',
        'client_id',
        'user_id',
        'wiriter_id',
        'image',
        'message'
    ];
}
