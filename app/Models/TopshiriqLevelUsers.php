<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopshiriqLevelUsers extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'topshiriq_level_users';
    protected $fillable = ['tg_user_id','topshiriq_level'];
}
