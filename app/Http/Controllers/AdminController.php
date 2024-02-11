<?php

namespace App\Http\Controllers;

use App\Models\Topshiriq;
use App\Models\TopshiriqJavob;
use App\Models\TopshiriqLevel;
use App\Models\TopshiriqLevelUsers;
use App\Models\TopshiriqStar;
use App\Models\User;
use App\Services\LMSTopshiriq;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function users()
    {
        return view('admin.users');
    }

    public function searchUsers(Request $request)
    {
        $value = $request->input('search');
        $users = User::select('id','username','pr', 'first_name', 'last_name')
            ->where(function ($q) use ($value) {
                if ($value != 'all') {
                    return $q
                        ->where('first_name', 'ilike', "%$value%")
                        ->orWhere('last_name', 'ilike', "%$value%")
                        ->orWhere('pr', 'ilike', "$value%")
                        ->orWhere('username', 'ilike', "$value%");
                } else {
                    return $q;
                }
            })
            ->orderBy('id', 'DESC')
            ->get();
        $top = DB::table('tg_user AS u')
            ->select('u.id','u.username','u.pr', 'u.first_name', 'u.last_name',
            DB::raw('COALESCE(SUM(p.number * p.price_product),0) as prodaja'))
            ->join('tg_productssold AS p', 'p.user_id', 'u.id')
            ->orderBy('prodaja', 'DESC')
            ->groupBy('u.id')
            ->limit(5)
            ->get();

        return response()->json(compact('users', 'top'));
    }


    public function TTL()
    {
//        $service = new LMSTopshiriq();
//////        $user_id = [14,13];
//        $user_id = auth()->user()->id;
////        return $user_id;
//        $first_date = '2024-02-03';
//        $end_date = '2024-02-10';
////        $number = 5;
////
//        $result = $service->LMS($user_id,$first_date,$end_date);
//
//        return $result;
//
//        $interval = strtotime($end_date) - strtotime($first_date);
//        $total_days = floor($interval / (60 * 60 * 24)) + 1; // +1 sabab kunlar oralig'idagi bosh kunni ham hisobga olish uchun
//
//        $hours = date('H');
//        $minutest = date('i');
//
//        return  "Soat: $hours, Minute: $minutest";

//        $smena = DB::table('tg_shift')
//            ->where('user_id', $user_id)
//            ->whereDate('created_at', '>=', $first_date)
//            ->whereDate('created_at', '<=', $end_date)
//            ->where(DB::raw('CAST(open_date AS time)'), '<=', '09:00:00')
//            ->count();
//
//        return $smena;

//        $savdo = DB::table('tg_productssold')
//            ->selectRaw('SUM(number * price_product) as total_savdo, DATE(created_at) as created_date')
//            ->where('user_id', $user_id)
//            ->whereDate('created_at', '>=', $first_date)
//            ->whereDate('created_at', '<=', $end_date)
//            ->havingRaw('SUM(number * price_product) >= 300000')
//            ->groupBy('created_date')
//            ->get();
//        return $savdo;

//        $oltin_sut = DB::table('tg_productssold')
//            ->selectRaw('SUM(number) as total_number')
//            ->where('medicine_id',50)
//            ->where('user_id', $user_id)
//            ->whereDate('created_at', '>=', $first_date)
//            ->whereDate('created_at', '<=', $end_date)
//            ->first();
//        return $oltin_sut->total_number;

//        $suyak_complex = DB::table('tg_productssold')
//            ->selectRaw('SUM(number) as total_number')
//            ->where('medicine_id',59)
//            ->where('user_id', $user_id)
//            ->whereDate('created_at', '>=', $first_date)
//            ->whereDate('created_at', '<=', $end_date)
//            ->first();
//        return $suyak_complex->total_number;

//        $kombo = DB::table('tg_productssold')
//            ->selectRaw('SUM(number * price_product) as total_savdo, DATE(created_at) as created_date')
//            ->where('user_id', $user_id)
//            ->whereDate('created_at', '>=', $first_date)
//            ->whereDate('created_at', '<=', $end_date)
//            ->groupBy('created_date')
//            ->get();
//        return $kombo;
//
//        $userID = auth()->user()->id;
//        $oltin_sut_topshiriq_name = Topshiriq::where(['key'=>'oltin_sut','status'=>1])->first();
//        $oltin_sut_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$oltin_sut_topshiriq_name->id,'topshiriq_key'=>$oltin_sut_topshiriq_name->key,'tg_user_id'=>$userID])->first();
//        $oltin_sut_first_date =  $oltin_sut_topshiriq_name->first_date;
//        $oltin_sut_end_date = $oltin_sut_topshiriq_name->end_date;
//        $oltin_sut_number = $oltin_sut_topshiriq_name->number;
////        return $oltin_sut_end_date;
//        $today = now()->format('Y-m-d');
////        return $today;
//        $oltin_sut_interval = strtotime($oltin_sut_end_date) - strtotime($oltin_sut_first_date);
//
//        $oltin_sut_days = floor($oltin_sut_interval / (60 * 60 * 24)) + 1;
//
//        if ($oltin_sut_end_date == $today)
//        {
//
//            $hour = 24 -
//        }

//        $time = new DateTime();
////        return $time;
//        $sana = new DateTime('2024-02-10');
//        $soat = new DateTime('16:46');
//
//        $date =  $time->diff($sana)->format('%a:')."k ".$time->diff($soat)->format('%h:')."s ".$time->diff($soat)->format('%i:')."m ".$time->diff($soat)->format('%s:')."s ";
////        $date =  $time->diff($soat)->format('%s');
////return $date;
//
//        if ($time->diff($sana)->format('%a:') == 0 && $time->diff($soat)->format('%h:') == 0 && $time->diff($soat)->format('%i:') == 0 && $time->diff($soat)->format('%s:') == 0) {
//            return "Requestni jo'natish to'xtatildi";
//        }
//        return $date;
//        if ($date == 0){
////            return $date;
//            return "zor";
//        }else{
//            return $date;
//        }

//        $time = new DateTime();
//        $sana = new DateTime('2024-02-10');
//        $soat = new DateTime('16:48');
//
//        $intervalSana = $time->diff($sana);
//        $intervalSoat = $time->diff($soat);
//
//// Agar sanash barcha qiymatlar 0 bo'lsa
//        if ($intervalSana->days == 0 && $intervalSoat->h == 0 && $intervalSoat->i == 0 && $intervalSoat->s == 0) {
//            return "Requestni jo'natish to'xtatildi";
//        }
//
//        $date =  $intervalSana->format('%a:')."k ".$intervalSoat->format('%h:')."s ".$intervalSoat->format('%i:')."m ".$intervalSoat->format('%s:')."s ";
//        return $date;
//


        $userID = \auth()->user()->id;
        $level_user = TopshiriqLevelUsers::where('tg_user_id',$userID)->first();
        $user_star = TopshiriqStar::where('tg_user_id',$userID)->first();
        $daraja = TopshiriqLevel::where('daraja',1)->first();
        $daraja_2 = TopshiriqLevel::where('daraja',2)->first();
        $daraja_3 = TopshiriqLevel::where('daraja',3)->first();
        $daraja_4 = TopshiriqLevel::where('daraja',4)->first();
        $daraja_5 = TopshiriqLevel::where('daraja',5)->first();
        $daraja_6 = TopshiriqLevel::where('daraja',6)->first();

        $user_level_profile = [];
        if (!$level_user){
            $user_level = new TopshiriqLevelUsers();
            $user_level->tg_user_id = $userID;
            $user_level->level_user = $daraja->daraja;
            $user_level->save();

            $user_level_profile = [
                'level'=>$daraja->daraja,
                'collect_star'=>$daraja->number_star,
                'star'=>$user_star->star,
            ];
        }
        elseif ($level_user && $user_star->star >= $daraja->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_2->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_2->daraja,
                'collect_star'=>$daraja_2->number_star,
                'star'=>$user_star->star,
            ];
        }
        elseif ($level_user && $user_star->star >= $daraja_2->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_3->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_3->daraja,
                'collect_star'=>$daraja_3->number_star,
                'star'=>$user_star->star,
            ];
        }
        elseif ($level_user && $user_star->star >= $daraja_3->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_4->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_4->daraja,
                'collect_star'=>$daraja_4->number_star,
                'star'=>$user_star->star,
            ];
        }
        elseif ($level_user && $user_star->star >= $daraja_4->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_5->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_5->daraja,
                'collect_star'=>$daraja_5->number_star,
                'star'=>$user_star->star,
            ];
        }
        elseif ($level_user && $user_star->star >= $daraja_5->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_6->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_6->daraja,
                'collect_star'=>$daraja_6->number_star,
                'star'=>$user_star->star,
            ];
        }
        else{
            $daraja_find = TopshiriqLevelUsers::where('tg_user_id',$userID)->first();
            $star_find = TopshiriqLevel::where('daraja',$daraja_find->level_user)->first();
            $user_level_profile = [
                'level'=>$daraja_find->level_user,
                'collect_star'=>$star_find->number_star,
                'star'=>$user_star->star,
            ];
        }

        return $user_level_profile;

    }


}
