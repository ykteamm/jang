<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TurnirStanding extends Model
{
    use HasFactory;

    protected $fillable = [
        'team1_id',
        'team2_id',
        'win',
        'lose',
        'group_id',
        'tour',
        'date_begin',
        'date_end',
        'month',
        'status',
        'ends',
    ];

    public function team1()
    {
        return $this->hasMany(TurnirTeam::class, 'id', 'team1_id');
    }
    public function team2()
    {
        return $this->hasMany(TurnirTeam::class, 'id', 'team2_id');
    }
}
