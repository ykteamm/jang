<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table='tg_teams';

    
    public function team1_battle()
    {
        return $this->hasMany(TeamBattle::class,'team1_id','id');
    }

    public function team2_battle()
    {
        return $this->hasMany(TeamBattle::class,'team2_id','id');
    }

    public function team_members()
    {
        return $this->hasMany(TeamMember::class,'team_id','id');
    }
}
