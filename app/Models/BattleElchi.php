<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattleElchi extends Model
{
    use HasFactory;
    protected $table = 'tg_battle_elchi';
    
    protected $fillable = [
        'battle_id',
        'u1id',
        'u2id',
        'price1',
        'price2',
        'win',
        'lose',
        'ball1',
        'ball2',
        'uball1',
        'uball2',
        'battle_date',
        'bot',
    ];

    public function battle_day()
    {
        return $this->belongsTo(BattleDay::class,'battle_id','id');
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
