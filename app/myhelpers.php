<?php

use App\Services\WorkDayServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if(!function_exists('fff')){
    function fff() {
        $monthStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endday = date('Y-m-d',(strtotime ( Carbon::now() ) ));
        // $monthStartDate = '2023-03-01';
        // $endday = '2023-03-31';
        $Variable1 = strtotime($monthStartDate);
        $Variable2 = strtotime($endday);
        $arr = [];
        $arr2 = [];
        $arr3 = [];
        for ($currentDate = $Variable2; $currentDate >= $Variable1;$currentDate -= (86400))
        {

            $day_sol = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                ->whereDate('tg_productssold.created_at',date('Y-m-d', $currentDate))
                ->where('tg_productssold.user_id',Auth::id())
                ->get()[0]->allprice;
            if($day_sol == NULL)
                {
                    $day_sol = 0;
                }
            $service = new WorkDayServices(Auth::id());
            // $arr2[date('Y-m-d', $currentDate)] = array('maosh' => maosh($day_sol));
            if($currentDate >= strtotime('2023-03-15') && $currentDate != strtotime(date('Y-m-d')))
            {
                $jarima = $service->getDayJarima(date('Y-m-d', $currentDate));
            }else{
                $jarima = 0;
            }
            $smena = DB::table('tg_shift')
                ->whereDate('created_at', date('Y-m-d', $currentDate))
                ->where('user_id', Auth::id())
                ->first();
            $workSchedule = DB::table("daily_works");
            $arr2[date('Y-m-d', $currentDate)] = array(
                'maosh' => maosh($day_sol),
                'fact' => $day_sol,
                'jarima' => $jarima,
                'minut' => $service->getMinutesDate(date('Y-m-d', $currentDate),Auth::id()),
                'open_date' => $smena ? $smena->open_date : null,
                'close_date' => $smena ? $smena->close_date : null
            );
        }
        return $arr2;
    }
}
