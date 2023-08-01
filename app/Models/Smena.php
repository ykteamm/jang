<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smena extends Model
{
    use HasFactory;

    protected $table = 'tg_smena';
    protected $fillable = [
        'id',
        'image',
        'created_to',
        'created_from',
        'is_active',
        'created_at',
        'user_id',
        'smena',
        'admin_check',
        'pharm_id'
    ];
}
