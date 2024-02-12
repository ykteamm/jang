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
use Illuminate\Support\Facades\Auth;
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

        $userID = Auth::id();

        $daraja = TopshiriqLevel::where('daraja',1)->first();
        $daraja_2 = TopshiriqLevel::where('daraja',2)->first();
        $daraja_3 = TopshiriqLevel::where('daraja',3)->first();
        $daraja_4 = TopshiriqLevel::where('daraja',4)->first();
        $daraja_5 = TopshiriqLevel::where('daraja',5)->first();
        $daraja_6 = TopshiriqLevel::where('daraja',6)->first();


        $level_user = TopshiriqLevelUsers::where('tg_user_id',$userID)->first();
        if (!$level_user){
            $user_level = new TopshiriqLevelUsers();
            $user_level->tg_user_id = $userID;
            $user_level->level_user = $daraja->daraja;
            $user_level->save();
        }

        $user_star = TopshiriqStar::where(['tg_user_id'=>$userID,'level'=>$level_user->level_user])->get();
        $star_all = 0;
        $level_all = 0;

        foreach ($user_star as $star) {
            $star_all += $star->star;
            $level_all = $star->level; // Levelni o'zgartirish uchun
        }
//        return $level_user && $daraja->daraja == $level_all && $star_all >= $daraja->number_star;

//        return Auth::id();
//        return $star_all;
//        return $level_all;
        $user_level_profile[] = [
            'level'=>$daraja->daraja,
            'collect_star'=>$daraja->number_star,
            'star'=>$star_all,
        ];
        if ($level_user && $daraja->daraja == $level_all && $star_all  >= $daraja->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_2->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_2->daraja,
                'collect_star'=>$daraja_2->number_star,
                'star'=>$star_all,
            ];
        }
        elseif ($level_user && $daraja_2->daraja == $level_all && $star_all >= $daraja_2->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_3->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_3->daraja,
                'collect_star'=>$daraja_3->number_star,
                'star'=>$star_all,
            ];
        }
        elseif ($level_user && $daraja_3->daraja == $level_all && $star_all >= $daraja_3->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_4->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_4->daraja,
                'collect_star'=>$daraja_4->number_star,
                'star'=>$star_all,
            ];
        }
        elseif ($level_user && $daraja_4->daraja == $level_all && $star_all >= $daraja_4->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_5->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_5->daraja,
                'collect_star'=>$daraja_5->number_star,
                'star'=>$star_all,
            ];
        }
        elseif ($level_user && $daraja_5->daraja == $level_all && $star_all >= $daraja_5->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_6->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_6->daraja,
                'collect_star'=>$daraja_6->number_star,
                'star'=>$star_all,
            ];
        } else{
            $daraja_find = TopshiriqLevelUsers::where('tg_user_id',$userID)->first();
            $star_find = TopshiriqLevel::where('daraja',$daraja_find->level_user)->first();
            $user_level_profile = [
                'level'=>$daraja_find->level_user,
                'collect_star'=>$star_find->number_star,
                'star'=>$star_all,
            ];
        }

        return $user_level_profile;

    }


}
