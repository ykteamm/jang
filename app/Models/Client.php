<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table='clients';

    public function chat()
    {
        return $this->hasOne(Chat::class,'client_id','id');
    }

}
