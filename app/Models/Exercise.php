<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    protected $table='tg_exercise';
    protected $fillable = [
        'medicine_id',
        'number',
        'elexir',
        'ball',
    ];

    public function elchi_exercise()
    {
        return $this->hasMany(ElchiExercise::class,'exercise_id','id');
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class,'medicine_id','id');
    }
}
