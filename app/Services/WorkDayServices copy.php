<?php

namespace App\Services;

use App\Models\AllSold;
use App\Models\Calendar;
use App\Models\DailyWork;
use App\Models\Shift;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkDayServices
{
    public $start_work;
    public $end_work;
    public function __construct()
    {
        $work = DailyWork::where('user_id',Auth::id())->first();

        $this->start_work = $work->start_work;
        $this->end_work = $work->finish_work;
    }

    public function getReport()
    {
        $month = date('Y-m');
        $start_month = $this->getFirstDate($month.'-01');
        $end_month = $this->getLastDate($month.'-01');

            $arrayDate = array();
            $Variable1 = strtotime($start_month);
            $Variable2 = strtotime($end_month);
            $sum = 0;
            for ($currentDate = $Variable1; $currentDate <= $Variable2;$currentDate += (86400))
            {

                if($currentDate < strtotime(date('Y-m-d')) && $currentDate >= strtotime('2023-03-15'))
                {
                    $date = date('Y-m-d', $currentDate);
                    $jarima = $this->getDayJarima($date);
                    $arrayDate[] = $jarima;
                }
            }

        dd($arrayDate);

    }
    public function getReportAllSum($month)
    {
        $start_month = $this->getFirstDate($month);
        $end_month = $this->getLastDate($month);

            $arrayDate = array();
            $Variable1 = strtotime($start_month);
            $Variable2 = strtotime($end_month);
            $sum = 0;
            $sum2 = [];

            for ($currentDate = $Variable1; $currentDate <= $Variable2;$currentDate += (86400))
            {
                if($currentDate < strtotime(date('Y-m-d')) && $currentDate >= strtotime('2023-03-15'))
                {
                    $date = date('Y-m-d', $currentDate);
                    $jarima = $this->getDayJarima($date);
                    $sum += $jarima;
                    $sum2[] = array('jarima' => $jarima,'date' => $date);

                }
            }

        return $sum;

    }
    public function getReportAllTime($month)
    {
        $start_month = $this->getFirstDate($month);
        $end_month = $this->getLastDate($month);

            $arrayDate = array();
            $Variable1 = strtotime($start_month);
            $Variable2 = strtotime($end_month);
            $sum = 0;
            $sum2 = [];
            for ($currentDate = $Variable1; $currentDate <= $Variable2;$currentDate += (86400))
            {
                if($currentDate < strtotime(date('Y-m-d')) && $currentDate >= strtotime('2023-03-15'))
                {
                    $date = date('Y-m-d', $currentDate);
                    $minut = $this->getMinutesDate($date,Auth::id());
                    $sum += $minut;
                    $sum2[] = array('time' => $minut,'date' => $date);
                }
            }

        return $sum;

    }
    public function getDayJarima($date)
    {
        $minut = $this->getMinutesDate($date,Auth::id());

        if($minut == 123123)
        {
            return $minut;
        }

        $shift = Shift::whereDate('created_at',$date)->where('user_id',Auth::id())->where('pharma_id','!=',42)->first();

        $def = 0;

        if($shift == null)
        {
            $def = 1;
        }

        $sum = $this->getOneMinutSum(Auth::id(),date('Y-m',strtotime($date)),$date,$def);
        $maosh = $this->getTaqqoslash($sum);
        $jar = $this->getOneMinutJarima($date,$maosh);
        $minut = $this->getMinutesDate($date,Auth::id());

        $one_day_minut = $this->getDayMinutes($date,Auth::id());


        return floor($jar*$minut/24);
    }
    public function getDayMinutes($date,$user_id)
    {
        $th_start_work = $this->getSpecialStartDay($date,$user_id);
        $th_end_work = $this->getSpecialFinishDay($date,$user_id);

        $all_diff = (strtotime($th_end_work) - strtotime($th_start_work))/60;

        if($all_diff/60 > 4)
        {
            $all_diff = $all_diff - 60;
        }

        return $all_diff/60;
    }
    public function getMinutesDate($date,$user_id)
    {


        $day = $this->getWorkInMonth(date('m.Y',strtotime($date)));
        $day_json = json_decode($day->day_json);

        $add_array = json_decode($day->add_day);

        $day_s = date('d', (strtotime($date)));
        // dd($add_array);

        $ddd = $day_json[$day_s-1];

        if($date < '2023-03-15' || $ddd == 'false' || in_array($day_s,$add_array))
        {
            return 0;
        }

        $th_start_work = $this->getSpecialStartDay($date,$user_id);
        $th_end_work = $this->getSpecialFinishDay($date,$user_id);


        $shift = Shift::whereDate('created_at',$date)->where('user_id',$user_id)->where('pharma_id','!=',42)->first();

        if($shift == NULL)
        {
            if (strtotime(date('Y-m-d')) > strtotime($date)) {
                $active = 1;
            } else {
                $active = 0;
            }
            if($active == 1)
            {
                $all_diff = (strtotime($th_end_work) - strtotime($th_start_work))/60;

                if($all_diff/60 > 4)
                {
                    $all_diff = $all_diff - 60;
                }
            }else{
                $all_diff = 123123;
            }
        }else{

            if($shift->close_date == null)
            {
                $table = AllSold::where('user_id',$shift->user_id)->whereDate('created_at',$shift->created_at)->orderByDesc('id')->value('created_at');
                if($table == null)
                {
                    $close_date = date('H:i:s',strtotime ( $shift->open_date ));
                }else{
                    $close_date = date('H:i:s',strtotime ( $table ));
                }
            }else{
                $close_date = date('H:i:s',strtotime($shift->close_date));
            }

            $open_date = date('H:i:s',strtotime($shift->open_date));

            // $th_start_work = $this->getSpecialStartDay($date,$user_id);
            // $th_end_work = $this->getSpecialFinishDay($date,$user_id);


            if(strtotime($open_date) > strtotime($th_start_work))
            {
                $diff_open = (strtotime($open_date) - strtotime($th_start_work))/60;
                if($diff_open <= 10)
                {
                    $diff_open = 0;
                }
            }else{
                $diff_open = 0;
            }

            if(strtotime($close_date) < strtotime($th_end_work))
            {
                $diff_close = (strtotime($th_end_work) - strtotime($close_date))/60;
                if($diff_close <= 10)
                {
                    $diff_close = 0;
                }
            }else{
                $diff_close = 0;
            }

            $all_diff = $diff_open + $diff_close;
        }

        return $all_diff;
    }
    public function getSpecialStartDay($date,$user_id)
    {
        $work = DailyWork::where('user_id',$user_id)
        ->whereDate('start','<=',$date)
        ->orderBy('id','DESC')
        ->first();
        return $work->start_work;
    }
    public function getSpecialFinishDay($date,$user_id)
    {
        $work = DailyWork::where('user_id',$user_id)
        ->whereDate('start','<=',$date)
        ->orderBy('id','DESC')
        ->first();
        return $work->finish_work;
    }
    public function getOneMinutSum($user_id,$month,$date,$def)
    {
        $start_month = $this->getFirstDate($month.'-01');
        $end_month = $this->getLastDate($month.'-01');
        if($def == 1)
        {
            $summa = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->whereDate('tg_productssold.created_at','>=',$start_month)
            ->whereDate('tg_productssold.created_at','<=',$end_month)
            ->where('tg_productssold.user_id','=',$user_id)
            ->first()->allprice;
        }else{
            $summa = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->whereDate('tg_productssold.created_at','>=',$month.'-01')
            ->whereDate('tg_productssold.created_at','<=',$date)
            ->where('tg_productssold.user_id','=',$user_id)
            ->first()->allprice;
        }

        if($summa == NULL)
        {
            $summa = 0;
        }
        return $summa;
    }

    public function getTaqqoslash($sum)
    {
        // if($sum < 15000000)
        // {
        //     $compare = 2000000;
        // }elseif($sum >= 15000000 && $sum < 25000000)
        // {
        //     $compare = ($sum*20)/150;
        // }elseif($sum >= 25000000 && $sum < 35000000)
        // {
        //     $compare = ($sum*35)/150;
        // }else{
        //     $compare = ($sum*50)/150;
        // }
        // return $compare;
        if($sum < 25000000)
        {
            $koef = 2000000/15000000;
            $oylik = $sum*$koef;
        }elseif ($sum >= 25000000 && $sum < 35000000) {
            $koef = 3500000/25000000;
            $oylik = $sum*$koef;
        }else{
            $koef = 5000000/35000000;
            $oylik = $sum*$koef;
        }

        return $oylik;
    }

    public function getOneMinutJarima($month,$sum)
    {
        $start_month = $this->getFirstDate($month);
        $end_month = $this->getLastDate($month);

        $start = strtotime($start_month);
        $end = strtotime($end_month);

        $count = 0;
        while(date('Y-m-d', $start) <= date('Y-m-d', $end)){
            $count += date('w', $start) == 0 ? 0 : 1;
            $start = strtotime("+1 day", $start);
        }

        // $work_day = $this->getWorkInMonth($month)->work_day;

        // $add_array = json_decode($this->getWorkInMonth($month)->add_day);

        $all_minuts = $count*60;

        $jar = $sum/$all_minuts;

        // dd($count);

        return $jar;
    }
    // public function getOneDayTime()
    // {
    //     $start_work = strtotime($this->start_work);
    //     $end_work = strtotime($this->end_work);

    //     $interval = ($end_work - $start_work)/3600;

    //     if($interval > 6)
    //     {
    //         $interval = ($end_work - $start_work - 3600);
    //     }else{
    //         $interval = ($end_work - $start_work);
    //     }
    //     return $interval;
    // }

    public function getWorkInMonth($month)
    {
        $cal = Calendar::where('year_month',$month)->first();
        return $cal;
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
