<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattleDay extends Model
{
    use HasFactory;
    protected $table = 'tg_battle_day';
    protected $fillable = [
        'u1id',
        'u2id',
        'price1',
        'price2',
        'days',
        'day',
        'start_day',
        'end_day',
        'bot',
        'ends',
    ];
    public function battle_elchi()
    {
        return $this->hasMany(BattleElchi::class,'battle_id','id');
    }
    public function u1ids()
    {
        return $this->belongsTo(User::class,'u1id','id');
    }
    public function u2ids()
    {
        return $this->belongsTo(User::class,'u2id','id');
    }
    
}
