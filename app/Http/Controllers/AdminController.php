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
        $ws = DB::table('tg_user')->where('id',79)->first();

        $work_start = '2024-01-01';
        $date_end = '2024-01-31';
        $plus_date = date('Y-m-d',(strtotime ( '30 days' , strtotime ( $work_start ) ) ));

//        return $plus_date;

//        $work_day = Shift::where('user_id',79)
//            ->where('open_date','!=',NULL)
//            ->whereDate('open_date','>=',$work_start)
//            ->whereDate('open_date','<=',$date_end)
//            ->count('id');
//
//        return $work_day;
        $work_day = Shift::where('user_id', 79)
            ->where('open_date', '!=', NULL)
            ->whereDate('open_date', '>=', $work_start)
            ->whereDate('open_date', '<=', $date_end)
            ->count();

        return $work_day;
    }

}
