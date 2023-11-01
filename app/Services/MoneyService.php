<?php
namespace App\Services;

use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MoneyService
{

    public function week()
    {
        $redline = 10000000;
        $protsent = 20;
        $protsent_medicine = 10;
        $monthStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');

        $endday = date('Y-m-d',(strtotime ( Carbon::now() ) ));
        $startday = date('Y-m-d',(strtotime ( '-6 day' , strtotime ( Carbon::now() ) ) ));
        $Variable1 = strtotime($startday);
        $Variable2 = strtotime($endday);
        $arr = [];
        $arr2 = [];
        $arr3 = [];
        for ($currentDate = $Variable1; $currentDate <= $Variable2;$currentDate += (86400))
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

            $arr[date('Y-m-d', $currentDate)] = $this->dayweek(date('w',$currentDate));
            if (Auth::user()->specialty_id == 1) {
                $arr2[date('Y-m-d', $currentDate)] = maosh($day_sol);
            } else {
                $arr2[date('Y-m-d', $currentDate)] = $day_sol/10;
            }


        }
        $arr3[] = $arr;
        $arr3[] = $arr2;
        return $arr3;

    }
    public function dayweek($number)
    {
        if($number == 0)
        {
            $t = 'ya';
        }
        if($number == 1)
        {
            $t = 'du';
        }
        if($number == 2)
        {
            $t = 'se';
        }
        if($number == 3)
        {
            $t = 'ch';
        }
        if($number == 4)
        {
            $t = 'pa';
        }
        if($number == 5)
        {
            $t = 'ju';
        }
        if($number == 6)
        {
            $t = 'sh';
        }
        return $t;
    }
    public function day($date)
    {
        if($date == 'Bugun')
        {
            $day_sol = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->whereDate('tg_productssold.created_at',date('Y-m-d'))
            ->where('tg_productssold.user_id',Auth::id())
            ->get()[0]->allprice;
            if($day_sol == NULL)
            {
                $day_sol = 0;
            }
            $count = DB::table('tg_productssold')
            ->selectRaw('COUNT(tg_productssold.order_id) as count')
            ->whereDate('tg_productssold.created_at',date('Y-m-d'))
            ->where('tg_productssold.user_id',Auth::id())
            ->get()[0]->count;
            if($count == NULL)
            {
                $count = 0;
            }
        }else{
            $day_sol = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->whereDate('tg_productssold.created_at',$date)
            ->where('tg_productssold.user_id',Auth::id())
            ->get()[0]->allprice;
            if($day_sol == NULL)
            {
                $day_sol = 0;
            }
            $count = DB::table('tg_productssold')
            ->selectRaw('COUNT(tg_productssold.order_id) as count')
            ->whereDate('tg_productssold.created_at',$date)
            ->where('tg_productssold.user_id',Auth::id())
            ->get()[0]->count;
            if($count == NULL)
            {
                $count = 0;
            }
        }
        // $redline = 10000000;
        // $protsent = 20;
        // $protsent_medicine = 10;
        $monthStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $month_sol = DB::table('tg_productssold')
        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
        ->whereDate('tg_productssold.created_at','>=',$monthStartDate)
        ->whereDate('tg_productssold.created_at','<',date('Y-m-d'))
        ->where('tg_productssold.user_id',Auth::id())
        ->get()[0]->allprice;
        if($month_sol == NULL)
            {
                $month_sol = 0;
            }
        // if($month_sol <= $redline)
        // {
            if (Auth::user()->specialty_id == 1) {
                $pul = maosh($day_sol);
            } else {
                $pul = $day_sol/10;
            }
        // }else{
        //     $pul = $day_sol;
        // }
        $a=[];
        $a[] = $date;
        $a[] = $pul;
        $a[] = $count;
        return $a;
    }
    public function getMonthMaosh($month)
    {

        $calendar = Calendar::where('id','>',28)->orderBy('id','DESC')->pluck('year_month')->toArray();

        // $month = $month - 1;
        // for($i=$month;$i>=0;$i--)
        // for($i=0;$i<=$month;$i++)
        foreach($calendar as $cl)

        {
            $date = date('Y-m-d',strtotime('01.'.$cl));
            $date_begin = $this->getFirstDate($date);
            $date_end = $this->getLastDate($date);
            $month_sol = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->whereDate('tg_productssold.created_at','>=',$date_begin)
            ->whereDate('tg_productssold.created_at','<=',$date_end)
            ->where('tg_productssold.user_id',Auth::id())
            ->get()[0]->allprice;

            if($month_sol == NULL)
            {
                $month_sol = 0;
            }

            $servi = new WorkDayServices(Auth::id());

            $jarima = $servi->getReportAllSum($date);
            $time = $servi->getReportAllTime($date);
            $month_name = date('F',strtotime($date_begin));
            $maosh = maosh($month_sol);
            if($maosh > 5000000)
            {
                $maosh = 5000000;
            }

            $shtraf = DB::table('tg_details')->where('user_id',Auth::id())->where('status',2)
            ->whereDate('created_at','>=',$date_begin)
            ->whereDate('created_at','<=',$date_end)
            ->get();

            $premya = DB::table('tg_details')->where('user_id',Auth::id())->where('status',1)
            ->whereDate('created_at','>=',$date_begin)
            ->whereDate('created_at','<=',$date_end)
            ->get();

            $st[] = array
            (
                'month_name' => ($month_name),
                'maosh' => $maosh,
                'summa' => $month_sol,
                'jarima' => $jarima,
                'time' => $time,
                'date_begin' => $date_begin,
                'date_end' => $date_end,
                'premya' => $premya,
                'shtraf' => $shtraf,
            );
        }

        return $st;

    }
    public function getMonthMaoshProvizor($month)
    {
        $month = $month - 1;
        // for($i=$month;$i>=0;$i--)
        for($i=0;$i<=$month;$i++)
        {
            $date = date('Y-m-d',(strtotime ( '-'.$i.' month' , strtotime ( Carbon::now() ) ) ));
            $date_begin = $this->getFirstDate($date);
            $date_end = $this->getLastDate($date);
            $month_sol = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->whereDate('tg_productssold.created_at','>=',$date_begin)
            ->whereDate('tg_productssold.created_at','<=',$date_end)
            ->where('tg_productssold.user_id',Auth::id())
            ->get()[0]->allprice;

            if($month_sol == NULL)
            {
                $month_sol = 0;
            }
            $maosh = $month_sol/10;
            $month_name = date('F',strtotime($date_begin));
            $st[] = array('month_name' => ($month_name),'maosh' => $maosh,'summa' => $month_sol,);
        }

        return $st;

    }
    public function getFirstDate($date)
    {
        $d = Carbon::createFromFormat('Y-m-d', $date)
                        ->firstOfMonth()
                        ->format('Y-m-d');
        return $d;
    }
    public function getLastDate($date)
    {
        $d = Carbon::createFromFormat('Y-m-d', $date)
                        ->lastOfMonth()
                        ->format('Y-m-d');
        return $d;
    }
}
