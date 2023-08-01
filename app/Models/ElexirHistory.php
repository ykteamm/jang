<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElexirHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'elexir',
        'reason',
        'start_day',
        'end_day',
    ];
}
