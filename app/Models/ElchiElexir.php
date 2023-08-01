<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElchiElexir extends Model
{
    use HasFactory;
    protected $table='tg_elchi_elexir';
    protected $fillable = [
        'user_id',
        'elexir'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
