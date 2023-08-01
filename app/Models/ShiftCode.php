<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftCode extends Model
{
    use HasFactory;
    protected $table = 'tg_shift_code';
    protected $fillable = [
        'id',
        'open',
        'close',
        'number'
    ];
}
