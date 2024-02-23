<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopshiriqUserPlanWeek extends Model
{
    use HasFactory;
    protected $table = 'topshiriq_user_plan_week';
    protected $fillable = ['user_id','star','plan_week','status','success','start_day','end_day'];
}
