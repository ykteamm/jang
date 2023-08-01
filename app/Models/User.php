<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'tg_user';

    public function win()
    {
        return $this->hasMany(BattleHistory::class,'win_user_id','id');
    }
    public function lose()
    {
        return $this->hasMany(BattleHistory::class,'lose_user_id','id');
    }
    public function elexir()
    {
        return $this->hasMany(ElchiElexir::class,'elexir_id','id');
    }
    public function ball()
    {
        return $this->hasMany(ElchiBall::class,'user_id','id');
    }
    public function elchi_exercise()
    {
        return $this->hasMany(ElchiUserExercise::class,'user_id','id');
    }
    public function shift()
    {
        return $this->hasMany(Shift::class,'user_id','id');
    }

    public function battle_day1()
    {
        return $this->hasMany(UserBattleDay::class,'u1id','id');
    }
    public function battle_day2()
    {
        return $this->hasMany(UserBattleDay::class,'u2id','id');
    }
    public function battle_elchi1()
    {
        return $this->hasMany(UserBattle::class,'u1id','id');
    }
    public function battle_elchi2()
    {
        return $this->hasMany(UserBattle::class,'u2id','id');
    }
    public function shops()
    {
        return $this->hasMany(Shop::class,'user_id','id');
    }
    public function order()
    {
        return $this->hasMany(Order::class,'user_id','id');
    }

    public function ksbu1()
    {
        return $this->hasMany(KingSoldBattle::class,'offer_uid','id');
    }
    public function ksbu2()
    {
        return $this->hasMany(KingSoldBattle::class,'accept_uid','id');
    }

    public function turnir_member()
    {
        return $this->hasMany(TurnirMember::class,'user_id','id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
