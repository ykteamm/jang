<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmenaCode extends Model
{
    use HasFactory;

    protected $table = 'tg_smena_code';
    protected $fillable = [
        'id',
        'open',
        'close',
        'number'
    ];

    public function user()
    {
        return $this->belongsTo(Pharmacy::class,'user_id','id');
    }
}
