<?php

namespace App\Http\Controllers;

use App\Models\AllSold;
use App\Models\ElexirExercise;
use App\Models\Shift;
use App\Models\Topshiriq;
use App\Models\TopshiriqJavob;
use App\Models\TopshiriqLevel;
use App\Models\TopshiriqLevelUsers;
use App\Models\TopshiriqStar;
use App\Models\TopshiriqUserPlanWeek;
use App\Models\User;
use App\Models\UserBattle;
use App\Services\LMSTopshiriq;
use App\Services\LockService;
use App\Services\MakeImageService;
use App\Services\UserBattleService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Scheduling\Schedule;
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

        $stars = TopshiriqStar::select(
            'topshiriq_star.tg_user_id',
            'tg_user.first_name',
            'tg_user.last_name',
            DB::raw('SUM(topshiriq_star.star) as total_star')
        )
            ->join('tg_user', 'tg_user.id', '=', 'topshiriq_star.tg_user_id')
            ->groupBy('topshiriq_star.tg_user_id',  'tg_user.first_name', 'tg_user.last_name')
            ->orderBy('total_star','desc')
            ->get();

        return $stars;

    }

    public function Test()
    {
        $userID = 585;
        $monday = date("Y-m-d", strtotime('monday this week'));
        $saturday = date("Y-m-d", strtotime('saturday this week'));
        $users = DB::table('topshiriq_user_plan_week')->where(['status'=>1,'user_id'=>$userID])
            ->whereDate('start_day','>=',$monday)
            ->whereDate('end_day','<=',$saturday)
            ->first();

        return [
            'user_id'=>$userID,
            'users'=>$users
        ];
    }

}
