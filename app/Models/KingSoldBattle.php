<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KingSoldBattle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function offer_uids()
    {
        return $this->belongsTo(User::class,'offer_uid','id');
    }
    public function accept_uids()
    {
        return $this->belongsTo(User::class,'accept_uid','id');
    }
}
