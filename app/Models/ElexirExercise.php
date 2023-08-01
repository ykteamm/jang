<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElexirExercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'medicine_id',
        'elexir',
        'plan',
        'success',
        'start_day',
        'end_day'
    ];
}
