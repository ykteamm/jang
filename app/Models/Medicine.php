<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $table='tg_medicine';

    public function exercise()
    {
        return $this->hasMany(Exercise::class,'medicine_id','id');
    }
    public function elchi_exercise()
    {
        return $this->hasMany(ElchiUserExercise::class,'medicine_id','id');
    }
    public function price()
    {
        return $this->hasMany(Price::class,'medicine_id','id');
    }
    public function all_sold()
    {
        return $this->hasMany(Medicine::class,'medicine_id','id');
    }

}