<?php

namespace App\Http\Controllers;

use App\Models\AllSold;
use App\Models\ElexirExercise;
use App\Models\MegaTurnirUserBattle;
use App\Models\NewUserOneMonth;
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

        $data = DB::table('user_battles')->orderBy('id','desc')->get();

        return $data;
    }

    public function MonthPlan(Request $request)
    {
        $teacherId = $request->input('teacher_id');
        $userIds = $request->input('user_id');
        $plans = $request->input('user_plan');
        $first_day_month = date("Y-m-01");
        $end_day_month = date("Y-m-t");

        $data = [];

        // Ma'lumotlarni to'plab bo'sh massivga joylash
        foreach ($userIds as $key => $userId) {
            $data[] = [
                'teacher_id' => $teacherId,
                'user_id' => $userId,
                'plan' => $plans[$key]
            ];
        }

        foreach ($data as $dat){
            DB::table('tg_jamoalar_plan')->insert([
                'teacher_id'=> $dat['teacher_id'],
                    'user_id'=>$dat['user_id'],
                    'plan_pul'=>$dat['plan'],
                    'start_day'=>$first_day_month,
                    'end_day'=>$end_day_month,
                    'created_at'=>now(),
            ]);
        }
        return redirect()->back();
    }

    public function MonthPlanEdit(Request $request,$id)
    {
        $userIds = $request->input('user_id');
        $plans = $request->input('user_plan');

        $first_day_month = date("Y-m-01");
        $end_day_month = date("Y-m-t");

        $data = [];

        // Ma'lumotlarni to'plab bo'sh massivga joylash
        foreach ($userIds as $key => $userId) {
            $data[] = [
                'user_id' => $userId,
                'plan' => $plans[$key]
            ];
        }

//        return $data;

        foreach ($data as $dat){
            $user_plan = DB::table('tg_jamoalar_plan')->where('teacher_id',$id)->where('user_id',$dat['user_id'])->first();

            if ($user_plan){
                DB::table('tg_jamoalar_plan')->where('teacher_id',$id)->where('user_id',$dat['user_id'])
                    ->update([
//                'user_id'=>$dat['user_id'],
                        'plan_pul'=>$dat['plan'],
                        'start_day'=>$first_day_month,
                        'end_day'=>$end_day_month,
                        'updated_at'=>now(),
                    ]);
            }else{
                DB::table('tg_jamoalar_plan')->insert([
                    'teacher_id'=> $id,
                    'user_id'=>$dat['user_id'],
                    'plan_pul'=>$dat['plan'],
                    'start_day'=>$first_day_month,
                    'end_day'=>$end_day_month,
                    'created_at'=>now(),
                ]);
            }


        }
        return redirect()->back();
    }


}
