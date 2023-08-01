<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElchiExercise extends Model
{
    use HasFactory;
    protected $table='tg_elchi_exercise';
    protected $fillable = [
        'user_id',
        'exercise_id',
        'success',
    ];
    public function exercise()
    {
        return $this->belongsTo(Exercise::class,'exercise_id','id');
    }
}
