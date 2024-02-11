<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopshiriqJavob extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'topshiriq_javob';
    protected $fillable = ['topshiriq_id','tg_user_id','topshiriq_key','topshiriq_number','topshiriq_done','topshiriq_javob','status'];
}
