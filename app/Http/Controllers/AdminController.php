<?php

namespace App\Http\Controllers;

use App\Models\ElexirExercise;
use App\Models\Topshiriq;
use App\Models\TopshiriqJavob;
use App\Models\TopshiriqLevel;
use App\Models\TopshiriqLevelUsers;
use App\Models\TopshiriqStar;
use App\Models\TopshiriqUserPlanWeek;
use App\Models\User;
use App\Services\LMSTopshiriq;
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

$user_id = \auth()->user()->id;

//        $test = DB::table('lms_oraliq_test')
//            ->join('lms_users', 'lms_users.id', '=', 'lms_oraliq_test.user_id')
//            ->where('lms_users.tg_user_id',$user_id)
//            ->where('lms_users.status', 1)
//            ->select('lms_oraliq_test.id','lms_oraliq_test.user_id','lms_oraliq_test.success','lms_oraliq_test.ball')
//            ->first();
//
//        return $test;


//        $monday = date("Y-m-d", strtotime('monday this week'));
//        $tuesday = date("Y-m-d", strtotime('tuesday this week'));
//        $wednesday = date("Y-m-d", strtotime('wednesday this week'));
//        $thursday = date("Y-m-d", strtotime('thursday this week'));
//        $friday = date("Y-m-d", strtotime('friday this week'));
//        $saturday = date("Y-m-d", strtotime('saturday this week'));
//
//        $kombo = [];
//        $daysOfWeek = [$monday, $tuesday, $wednesday, $thursday, $friday, $saturday];
//
//        $prevTotalSavdo = null;
//
//        $number = 0;
//        foreach ($daysOfWeek as $day) {
//            $totalSavdo = DB::table('tg_productssold')
//                ->selectRaw('SUM(number * price_product) as total_savdo')
//                ->where('user_id', $user_id)
//                ->whereDate('created_at', $day)
//                ->value('total_savdo');
//
//            // Check if the total sales for the current day are less than or equal to the total sales for the previous day
//            $kombo[$day] = $prevTotalSavdo !== null && $totalSavdo <= $prevTotalSavdo ? 0 : 1;
//
//            if ($prevTotalSavdo !== null && $totalSavdo <= $prevTotalSavdo)
//            {
//                $number = 0;
//            }elseif ($prevTotalSavdo !== null && $totalSavdo >= $prevTotalSavdo){
//                $number++;
//            }
//
//            // Update prevTotalSavdo for the next iteration
//            $prevTotalSavdo = $totalSavdo;
//        }
////        return $number;
//
//// Sum the values in $kombo
//        $totalKombo = array_sum($kombo);
//
//        return [
//            'kombo' => $kombo,
//            'count' => $totalKombo,
//            'number'=>$number,
//        ];

//        $topshiq = new LMSTopshiriq();
//        $data  = $topshiq->kombo_sotuv($user_id);
//
//        return $data;

//        $start = '2024-02-01';
//        $end = '2024-02-10';
////        return $user_id;
//
//        $check = DB::table('tg_productssold')
//            ->selectRaw('SUM(number * price_product) as total_savdo')
//            ->where('user_id', $user_id)
//            ->whereDate('created_at', '>=', $start)
//            ->whereDate('created_at', '<=', $end)
//            ->first();
//
////        return $check;
////
//        $weeks['sum'] = DB::table("tg_productssold AS p")
//            ->selectRaw("SUM(p.number * p.price_product) AS prodaja")
//            ->where('p.user_id', $user_id)
//            ->whereBetween('p.created_at', [$start, $end])
//            ->first()->prodaja ?? 0;
//        return [
//            'weeks'=>$weeks,
//            'check'=>$check
//        ];

//        $weeks = $this->weekDays();
//        foreach ($weeks as $week => $value) {
//            try {
//                $weeks[$week]['sum'] = DB::table("tg_productssold AS p")
//                    ->selectRaw("SUM(p.number * p.price_product) AS prodaja")
//                    ->where('p.user_id', $user_id)
//                    ->whereBetween('p.created_at', [$value['start'], $value['end']])
//                    ->first()->prodaja ?? 0;
//            } catch (\Throwable $th) {
//                $weeks[$week]['sum'] = 0;
//            }
//        }
//        return $weeks;




    }

    private function weekDays()
    {
        $startM = Carbon::now()->startOfMonth()->format("Y-m-d");
        $endM = Carbon::now()->endOfMonth()->format("Y-m-d");
        $endWeek = Carbon::parse($startM)->endOfWeek()->format("Y-m-d");

        $weeks = [];
        for ($i = 1; $i < 5; $i++) {
            $week = "$i-hafta";
            $weeks[$week] = [];
            switch ($i) {
                case 1:
                    $weeks[$week]['start'] = $startM;
                    if ((strtotime($endWeek) - strtotime($startM)) > 4 * 86400) {
                        $weeks[$week]['end'] = $endWeek;
                    } else {
                        $weeks[$week]['end'] = date("Y-m-d", strtotime("+7 day", strtotime($endWeek)));
                    }
                    break;
                case 2:
                    $weeks[$week]['start'] = date("Y-m-d", strtotime("+1 day", strtotime($weeks['1-hafta']['end'])));
                    $weeks[$week]['end'] = date("Y-m-d", strtotime("+7 day", strtotime($weeks['1-hafta']['end'])));
                    break;
                case 3:
                    $weeks[$week]['start'] = date("Y-m-d", strtotime("+1 day", strtotime($weeks['2-hafta']['end'])));
                    $weeks[$week]['end'] = date("Y-m-d", strtotime("+7 day", strtotime($weeks['2-hafta']['end'])));
                    break;
                case 4:
                    $weeks[$week]['start'] = date("Y-m-d", strtotime("+1 day", strtotime($weeks['3-hafta']['end'])));
                    $weeks[$week]['end'] = $endM;
                    break;
            }
        }
        return $weeks;

    }



}
