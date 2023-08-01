<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsBattles extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'u1id',
        'u2id',
        'battle_id',
        'sms',
        'bot'
    ];
}
