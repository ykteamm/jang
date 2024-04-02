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
        $users = DB::table('tg_user')
            ->orWhere('status',1)
            ->orWhere('status',0)
            ->select('id','first_name','last_name','status')
            ->get();
        $userIds = $users->pluck('id');
        $tgProductssoldData = DB::table('tg_productssold')
            ->whereIn('user_id', $userIds)
            ->select('user_id', DB::raw('SUM(number * price_product) as total_number'))
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('user_id')
            ->orderBy('user_id', 'asc')
            ->get();

        $monday = date("Y-m-d", strtotime('monday this week'));
        $sunday = date("Y-m-d", strtotime('sunday this week'));
        $topshiriq = new LMSTopshiriq();
//        return $tgProductssoldData;
        foreach ($tgProductssoldData as $user)
        {
            $user_id = $user->user_id;
            $have = TopshiriqUserPlanWeek::where(['user_id'=>$user_id,'status'=>1,'start_day'=>$monday,'end_day'=>$sunday])->first();
            $data = $topshiriq->HaftalikPlan($user_id);
//            echo ' pul ' . $data['pul'] . '   '. $user_id;
            if (!$have){
                $plan = new TopshiriqUserPlanWeek();
                $plan->user_id = $user_id;
                $plan->star = 30;
                $plan->plan_week = $data['pul'];
                $plan->status = 1;
                $plan->start_day = $monday;
                $plan->end_day = $sunday;
                $plan->save();
            }
        }
    }


}
