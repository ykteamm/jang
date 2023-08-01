<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $table='tg_region';

    public function district()
    {
        return $this->hasMany(District::class,'region_id','id');
    }
}
