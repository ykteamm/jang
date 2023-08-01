<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachGradeStar extends Model
{
    use HasFactory;

    protected $fillable = [
        'tester_id',
        'user_id',
        'star'
    ];
}
