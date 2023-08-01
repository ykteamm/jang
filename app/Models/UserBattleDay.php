<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBattleDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'battle_id',
        'u1id',
        'u2id',
        'sold1',
        'sold2',
        'win',
        'lose',
        'battle_date',
        'bot',
    ];
    public function battle_day()
    {
        return $this->belongsTo(UserBattle::class,'battle_id','id');
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
