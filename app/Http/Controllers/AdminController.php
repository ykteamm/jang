<?php

namespace App\Http\Controllers;

use App\Models\AllSold;
use App\Models\ElexirExercise;
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
        $user_id = Auth::id();
        $monday = date("Y-m-d", strtotime('monday this week'));
        $saturday = date("Y-m-d", strtotime('saturday this week'));
        $origin_savdo = ElexirExercise::where('user_id',579)->orderBy('id','desc')
            ->get();

        return $origin_savdo;

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
