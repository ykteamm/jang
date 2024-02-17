<?php

namespace App\Services;

use App\Models\ElexirExercise;
use App\Models\TopshiriqJavob;
use App\Models\TopshiriqLevelUsers;
use App\Models\TopshiriqStar;
use Carbon\Carbon;
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

    function birga_bir_jang($user_id)
    {
        $data = DB::table('user_battles')
            ->where(function($query) use ($user_id) {
                $query->where('u1id', $user_id)
                    ->orWhere('u2id', $user_id);
            })
            ->where('ends', 1)
            ->whereNotNull('win')
            ->where(function($query) use ($user_id) {
                $query->where('win', $user_id)
                    ->orWhere('lose', $user_id);
            })
            ->latest('created_at')
            ->limit(3)
            ->get();

        $winCount = $data->where('win', $user_id)->count();
        $loseCount = $data->where('lose', $user_id)->count();

        return [
            'data' => $data,
            'win_count' => $winCount,
            'lose_count' => $loseCount,
        ];
    }

    function origins_dori_daraja($user_id)
    {
        $data = DB::table('tg_productssold')
            ->select('medicine_id', DB::raw('SUM(number) as total_number'),'user_id')
            ->where('user_id', $user_id)
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('medicine_id','user_id')
            ->latest('total_number')
            ->orderBy('total_number','desc')
            ->limit(2)
            ->get();

//        return $data;
        $first_medicine = $data->first();
        $second_medicine = $data->last();

        $week_topshiriq = 0;
        $week_topshiriq_2 = 0;
        if ($first_medicine && $second_medicine){
            $number = $first_medicine->total_number;
            $week_topshiriq = round((($number / 30) * 7) * 1.20);

            $number_2 = $second_medicine->total_number;
    //        return $number_2;
            $week_topshiriq_2 = round((($number_2 / 30) * 7) * 1.20);
        }

        if ($week_topshiriq == 0){
            $week_topshiriq = 1;
        }elseif ($week_topshiriq_2 == 0){
            $week_topshiriq_2 = 1;
        }

        $datas = [
            'data'=>$data,
            'first'=>$first_medicine,
            'second'=>$second_medicine,
            'week_1'=>$week_topshiriq,
            'week_2'=>$week_topshiriq_2,
        ];

        return $datas;

    }


    function origin_check($user_id,$medicine_id,$start_day,$end_day)
    {
        $origin_check = DB::table('tg_productssold')
            ->selectRaw('SUM(number) as total_number')
            ->where('medicine_id',$medicine_id)
            ->where('user_id', $user_id)
            ->whereDate('created_at', '>=', $start_day)
            ->whereDate('created_at', '<=', $end_day)
            ->first();

        return $origin_check->total_number ?? 0;
    }


    function end_day_origin_check()
    {

    }


}
