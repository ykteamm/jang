<?php

namespace App\Services;

use App\Models\TopshiriqJavob;
use Illuminate\Support\Facades\DB;

class LMSTopshiriq
{
    function LMS($user_id,$first_date,$end_date)
    {
        $lms = DB::table('lms_passed')
            ->join('lms_users', 'lms_users.id', '=', 'lms_passed.user_id')
            ->where('lms_users.tg_user_id',$user_id)
            ->where('lms_passed.pass_status', 1)
            ->whereDate('lms_passed.created_at', '>=', $first_date)
            ->whereDate('lms_passed.created_at', '<=', $end_date)
            ->count();

        return $lms;

    }

    function SMENA($user_id,$first_date,$end_date)
    {
        $smena = DB::table('tg_shift')
            ->where('user_id', $user_id)
            ->whereDate('created_at', '>=', $first_date)
            ->whereDate('created_at', '<=', $end_date)
            ->where(DB::raw('CAST(open_date AS time)'), '<=', '09:00:00')
            ->count();
        return $smena;
    }

    function kombo_sotuv($user_id,$first_date,$end_date)
    {
        $kombo = DB::table('tg_productssold')
            ->selectRaw('SUM(number * price_product) as total_savdo, DATE(created_at) as created_date')
            ->where('user_id', $user_id)
            ->whereDate('created_at', '>=', $first_date)
            ->whereDate('created_at', '<=', $end_date)
            ->havingRaw('SUM(number * price_product) >= 300000')
            ->groupBy('created_date')
            ->count();
        return $kombo;
    }

    function savdo_300($user_id,$first_date,$end_date)
    {
        $savdo = DB::table('tg_productssold')
            ->selectRaw('SUM(number * price_product) as total_savdo, DATE(created_at) as created_date')
            ->where('user_id', $user_id)
            ->whereDate('created_at', '>=', $first_date)
            ->whereDate('created_at', '<=', $end_date)
            ->havingRaw('SUM(number * price_product) >= 300000')
            ->groupBy('created_date')
            ->count();
        return $savdo;
    }


    function oltin_sut($user_id,$first_date,$end_date)
    {
        $oltin_sut = DB::table('tg_productssold')
            ->selectRaw('SUM(number) as total_number')
            ->where('medicine_id',247)
            ->where('user_id', $user_id)
            ->whereDate('created_at', '>=', $first_date)
            ->whereDate('created_at', '<=', $end_date)
            ->first();
        return $oltin_sut->total_number ?? 0;
    }

    function suyak_complex($user_id,$first_date,$end_date)
    {
        $suyak_complex = DB::table('tg_productssold')
            ->selectRaw('SUM(number) as total_number')
            ->where('medicine_id',251)
            ->where('user_id', $user_id)
            ->whereDate('created_at', '>=', $first_date)
            ->whereDate('created_at', '<=', $end_date)
            ->first();
        return $suyak_complex->total_number ?? 0;
    }


    function topshiriq_check($user_id,$topshiriq_key)
    {
        $topshiriq = TopshiriqJavob::where(['tg_user_id'=>$user_id,'topshiriq_key'=>$topshiriq_key])->first();

        return $topshiriq;
    }


}
