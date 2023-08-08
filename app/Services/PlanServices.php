<?php

namespace App\Services;

use App\Items\TimeItems;
use App\Models\Calendar;
use App\Models\Liga;
use App\Models\Medicine;
use App\Models\NewUserOneMonth;
use App\Models\Plan;
use App\Models\PlanWeek;
use App\Models\UserPlans;
use Carbon\Carbon;
use Faker\Provider\Medical;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanServices
{

    public function createPlan($user_id)
    {
        // $month_start = Carbon::now()->startOfMonth()->format('Y-m-d');
            // $month_end = Carbon::now()->endOfMonth()->format('Y-m-d');
        // dd($this->getPlan($month_start,$month_end,Auth::id()));


        $is_one_month = NewUserOneMonth::where('user_id',$user_id)->exists();

        $now_plans = UserPlans::where('user_id',$user_id)->whereDate('created_at','>=',date('Y-m').'-01')->first('plan');
        if($now_plans)
        {
            if($is_one_month){
                if($now_plans->plan < 12000000)
                {
                    $this->changePlanForFakt(12000000);
                }
            }else{
                if($now_plans->plan < 15000000)
                {
                    $this->changePlanForFakt(15000000);
                }
            }
        }
        // dd($now_plans);


        $last_plan = DB::table('tg_plans')->where('user_id',$user_id)

        ->whereDate('created_at','>=',date('Y-m').'-01')->get();
        // ->whereDate('created_at','>=','2023-05-05')->get();



        if(count($last_plan) == 0)
        {

            $month_start = Carbon::now()->startOfMonth()->format('Y-m-d');
            $month_end = Carbon::now()->endOfMonth()->format('Y-m-d');
            $last_month_start = date('Y-m-d',(strtotime ( '-1 month' , strtotime ( $month_start ) ) ));
            $first_date = $this->getFirstDate($last_month_start);
            $last_date = $this->getLastDate($last_month_start);


            $sum = DB::table('tg_productssold')
                        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                        ->whereDate('tg_productssold.created_at','>=',$first_date)
                        ->whereDate('tg_productssold.created_at','<=',$last_date)
                        ->where('tg_user.id',$user_id)
                        // ->where('tg_user.id',178)
                        ->join('tg_user','tg_user.id','tg_productssold.user_id')
                        ->get()[0]->allprice;
            if($sum == NULL)
            {
                $sum = 0;
            }

            if($sum >= 35000000)
            {
                $sum = 35000000;
            }


            $liga = Liga::where('plan','>=',$sum)->orderBy('id','asc')->first()->plan;



            $new_plan = floor(($sum + $liga)/2);



            if($new_plan < 15000000)
            {
                // $status = Auth::user()->status;

                $is_one_month = NewUserOneMonth::where('user_id',$user_id)->exists();


                if($is_one_month){
                    $new_plan = 12000000;
                }else{
                    $new_plan = 15000000;
                }

                // if($status == 0)
                // {
                //     $new_plan = 12000000;
                // }

                // $new_plan = floor(($sum + $liga)/2);

            }


            if($sum == 0)
            {
                $koef = 1;
            }else{
                $koef = $new_plan/$sum;
            }





            // $month_start = Carbon::now()->startOfMonth()->format('Y-m-d');
            // $month_end = Carbon::now()->endOfMonth()->format('Y-m-d');
            // dd($this->getPlan($month_start,$month_end,$user_id));
            $product = $this->getProductSold($first_date,$last_date);
            $new_plan_product = [];
            $new_plan_productd = 0;

            if(count($product) > 0)
            {
                foreach ($product as $key => $value) {

                    $new_plan_product[$value->id] = (round($value->allprice*$koef/$value->price_product));
                }
            }else{
            $product = $this->getProductSoldId($first_date,$last_date);

                foreach ($product as $key => $value) {

                    $new_plan_product[$value->id] = (round($new_plan/count($product)/$value->price_product));
                }
            }



            $this->store($new_plan_product,$user_id);
            $this->saveUserPlan($new_plan,$user_id);

        }
    }
    public function changePlanForFakt($new_plan)
    {

        // dd(Auth::id());

        $last_plan = DB::table('tg_plans')->where('user_id',Auth::id())
        ->whereDate('created_at','>=',date('Y-m').'-01')->delete();

        $last_plan_weeks = DB::table('tg_planweeks')->where('user_id',Auth::id())
        ->whereDate('created_at','>=',date('Y-m').'-01')->delete();

        $last_plan = UserPlans::where('user_id',Auth::id())->delete();

        $month_start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $month_end = Carbon::now()->endOfMonth()->format('Y-m-d');
        $last_month_start = date('Y-m-d',(strtotime ( '-1 month' , strtotime ( $month_start ) ) ));
        $first_date = $this->getFirstDate($last_month_start);
        $last_date = $this->getLastDate($last_month_start);


        $sum = DB::table('tg_productssold')
                        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                        ->whereDate('tg_productssold.created_at','>=',$first_date)
                        ->whereDate('tg_productssold.created_at','<=',$last_date)
                        ->where('tg_user.id',Auth::id())
                        // ->where('tg_user.id',178)
                        ->join('tg_user','tg_user.id','tg_productssold.user_id')
                        ->get()[0]->allprice;
        if($sum == NULL)
        {
            $sum = 0;
        }

        if($sum == 0)
        {
            $koef = 1;
        }else{
            $koef = $new_plan/$sum;
        }

        $product = $this->getProductSold($first_date,$last_date);
            $new_plan_product = [];
            $new_plan_productd = 0;

            if(count($product) > 0)
            {
                foreach ($product as $key => $value) {

                    $new_plan_product[$value->id] = (round($value->allprice*$koef/$value->price_product));
                }
            }else{
            $product = $this->getProductSoldId($first_date,$last_date);

                foreach ($product as $key => $value) {

                    $new_plan_product[$value->id] = (round($new_plan/count($product)/$value->price_product));
                }
            }



            $this->store($new_plan_product,Auth::id());
            $this->saveUserPlan($new_plan,Auth::id());
    }
    public function changePlan($liga_id)
    {
        $last_plan = DB::table('tg_plans')->where('user_id',Auth::id())
        ->whereDate('created_at','>=',date('Y-m').'-01')->delete();

        $last_plan_weeks = DB::table('tg_planweeks')->where('user_id',Auth::id())
        ->whereDate('created_at','>=',date('Y-m').'-01')->delete();

        $last_plan = UserPlans::where('user_id',Auth::id())->delete();
        // dd()
        $new_plan = Liga::find($liga_id)->plan;


            $month_start = Carbon::now()->startOfMonth()->format('Y-m-d');
            $month_end = Carbon::now()->endOfMonth()->format('Y-m-d');

            $last_month_start = date('Y-m-d',(strtotime ( '-1 month' , strtotime ( $month_start ) ) ));
            $first_date = $this->getFirstDate($last_month_start);
            $last_date = $this->getLastDate($last_month_start);

            $sum = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->whereDate('tg_productssold.created_at','>=',$first_date)
            ->whereDate('tg_productssold.created_at','<=',$last_date)
            ->where('tg_user.id',Auth::id())
            // ->where('tg_user.id',178)
            ->join('tg_user','tg_user.id','tg_productssold.user_id')
            ->get()[0]->allprice;

            if($sum == NULL)
            {
                $sum = 0;
            }

            if($sum == 0)
            {
                $koef = 1;
            }else{
                $koef = $new_plan/$sum;
            }

            $product = $this->getProductSold($first_date,$last_date);

            // dd($product);

            $new_plan_product = [];
            $new_plan_productd = 0;

            if(count($product) > 0)
            {
                foreach ($product as $key => $value) {

                    $new_plan_product[$value->id] = (round($value->allprice*$koef/$value->price_product));
                }
            }else{
            $product = $this->getProductSoldId($first_date,$last_date);

                foreach ($product as $key => $value) {

                    $new_plan_product[$value->id] = (round($new_plan/count($product)/$value->price_product));
                }
            }

            $this->store($new_plan_product,Auth::id());
            $this->saveUserPlan($new_plan,Auth::id());
    }
    public function saveUserPlan($plan,$id)
    {
        $new = new UserPlans;
        $new->plan = $plan;
        $new->user_id = $id;
        $new->save();
    }
    public function getProductSoldId($first_date,$last_date)
    {
        $product = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number) as count,tg_medicine.id,tg_productssold.price_product')
                    ->whereDate('tg_productssold.created_at','>=',$first_date)
                    ->whereDate('tg_productssold.created_at','<=',$last_date)
                    ->join('tg_medicine','tg_medicine.id','tg_productssold.medicine_id')
                    ->orderBy('count','DESC')
                    ->groupBy('tg_medicine.id','tg_productssold.price_product')
                    ->limit(20)
                    ->get();
        return $product;
    }
    public function getProductSold($first_date,$last_date)
    {
        $product = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_medicine.id,tg_productssold.price_product')
                    ->whereDate('tg_productssold.created_at','>=',$first_date)
                    ->whereDate('tg_productssold.created_at','<=',$last_date)
                    ->where('tg_user.id',Auth::id())
                    // ->where('tg_user.id',178)
                    ->join('tg_user','tg_user.id','tg_productssold.user_id')
                    ->join('tg_medicine','tg_medicine.id','tg_productssold.medicine_id')
                    ->orderBy('allprice','DESC')
                    ->groupBy('tg_medicine.id','tg_productssold.price_product')
                    ->get();
        return $product;
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
    public function store($request,$id)
    {

        $r=$request;

        // unset($r['_token']);
        $shablon_id=3;
        // unset($r['shablon_id']);

        // date_default_timezone_set('Asia/Tashkent');
        $cal=Calendar::where('year_month',date('m.Y'))->first();
        $arr=json_decode($cal->day_json);
        

        foreach ($r as $key => $item){
            if($item!=0){
                $plan=$this->save($key,$item,$id,$shablon_id);

                $workday=$cal->work_day;
                $count=0;
                $start=0;
                $sikl=0;
                if($workday>0&&$workday<14){
                    $count==1;
                }elseif ($workday>=14&&$workday<=20){
                    $count=2;
                }elseif ($workday>=21&&$workday<=26){
                    $count=3;
                }else{
                    $count=4;
                }

                $planwork=$plan->number/$cal->work_day;
                for($i=0;$i<$count;$i++){
                    $pw=new PlanWeek();
                    $pw->plan_id=$plan->id;
                    $pw->user_id=$plan->user_id;
                    if($workday>13){
                        $pw->workday=7;
                        $workday=$workday-7;
                    }else{
                        $pw->workday=$workday;

                    }
                    $ct=0;
                    $cf=0;
                    $l=$pw->workday;
                    for($j=$start;$j<$start+$l;$j++){

                        if($arr[$j] == 'true' && $arr[$j] == 'false')
                        {

                            if($arr[$j]=='true'){
                                $ct++;
                            }else{
                                $cf++;
                                $l++;
                            }

                            if($ct==1){
                                $d=$j;
                                $d=$d.' day';
                                $pw->startday=date("Y-m-d", strtotime($d, strtotime((Carbon::now()->startOfMonth()))));
                            }


                            if($ct==$pw->workday){
                                $d=$j;
                                $start=$j+1;
                                $d=$d.' day';

                                $pw->endday=date("Y-m-d", strtotime($d, strtotime((Carbon::now()->startOfMonth()))));
                                if($i!=$count-1){
                                    $pw->plan=round($planwork*$pw->workday);
                                }else{
                                    $pw->plan=$plan->number;
                                }

                                $plan->number=$plan->number-$pw->plan;
                                $pw->calendar_id=$cal->id;
                                $pw->medicine_id=$plan->medicine_id;
                                $pw->save();
                                break;

                            }
                        }

                    }

                }




            }
        }
    }
    public function save($key,$item,$id,$shablon_id)
    {
        $plan=new Plan();
        $plan->medicine_id = $key;
        $plan->number=$item;
        $plan->shablon_id=$shablon_id;
        $plan->user_id=$id;
        $plan->save();
        return $plan;
    }
    public function getPlanMonth($date,$user_id)
    {

        $dates = $this->getDay($date);
        $start_date = $dates->date_begin;
        $end_date = $dates->date_end;

        $plan = DB::table('tg_plans')->where('user_id',$user_id)
        ->whereDate('created_at','>=',$start_date)
        ->whereDate('created_at','<=',$end_date)
        ->get();
        $plan_array=[];
        foreach ($plan as $key => $value) {
            $count = DB::table('tg_productssold')
                        ->selectRaw('SUM(tg_productssold.number) as count')
                        ->whereDate('tg_productssold.created_at','>=',$start_date)
                        ->whereDate('tg_productssold.created_at','<=',$end_date)
                        ->where('tg_user.id',$user_id)
                        ->where('tg_medicine.id',$value->medicine_id)
                        ->join('tg_user','tg_user.id','tg_productssold.user_id')
                        ->join('tg_medicine','tg_medicine.id','tg_productssold.medicine_id')
                        ->first();
                if($count->count == NULL)
                {
                    $count = 0;
                }else{
                    $count = $count->count;
                }
            $medicine = Medicine::where('id',$value->medicine_id)->value('name');
            $plan_array[]= array('medicine' => $medicine,'plan' => $value->number, 'make' => $count);
        }
        return $plan_array;

        // dd($plan_array);
    }
    public function getPlanDay($date,$user_id)
    {
        $date_begin = Carbon::now()->startOfMonth()->format('Y-m-d');
        $date_end = Carbon::now()->endOfMonth()->format('Y-m-d');
        $dates = $this->getDay($date);
        $start_date = $dates->date_begin;
        $end_date = $dates->date_end;
        $work_day = Calendar::where('year_month',date('m.Y'))->first()->work_day;
        $plan = DB::table('tg_plans')->where('user_id',$user_id)
        ->whereDate('created_at','>=',$date_begin)
        ->whereDate('created_at','<=',$date_end)
        ->get();
        // dd($plan);

        $plan_array=[];
        foreach ($plan as $key => $value) {
            $count = DB::table('tg_productssold')
                        ->selectRaw('SUM(tg_productssold.number) as count')
                        ->whereDate('tg_productssold.created_at','>=',$start_date)
                        ->whereDate('tg_productssold.created_at','<=',$end_date)
                        ->where('tg_user.id',$user_id)
                        ->where('tg_medicine.id',$value->medicine_id)
                        ->join('tg_user','tg_user.id','tg_productssold.user_id')
                        ->join('tg_medicine','tg_medicine.id','tg_productssold.medicine_id')
                        ->first();
                if($count->count == NULL)
                {
                    $count = 0;
                }else{
                    $count = $count->count;
                }
                $day_plan = round($value->number/$work_day);
                if($day_plan == 0)
                {
                    $day_plan = 1;
                }
            $medicine = Medicine::where('id',$value->medicine_id)->value('name');
            $plan_array[]= array('medicine' => $medicine,'plan' => $day_plan, 'make' => $count);
        }

        return $plan_array;
        // dd($plan_array);
    }
    public function getPlanWeek($date,$user_id)
    {
        $date_begin = Carbon::now()->startOfMonth()->format('Y-m-d');
        $date_end = Carbon::now()->endOfMonth()->format('Y-m-d');
        $dates = $this->getDay($date);
        $start_date = $dates->date_begin;
        $end_date = $dates->date_end;
        $work_day = Calendar::where('year_month',date('m.Y'))->first()->work_day;
        $plan = DB::table('tg_plans')->where('user_id',$user_id)
        ->whereDate('created_at','>=',$date_begin)
        ->whereDate('created_at','<=',$date_end)
        ->get();
        // dd($plan);

        $plan_array=[];
        foreach ($plan as $key => $value) {
            $count = DB::table('tg_productssold')
                        ->selectRaw('SUM(tg_productssold.number) as count')
                        ->whereDate('tg_productssold.created_at','>=',$start_date)
                        ->whereDate('tg_productssold.created_at','<=',$end_date)
                        ->where('tg_user.id',$user_id)
                        ->where('tg_medicine.id',$value->medicine_id)
                        ->join('tg_user','tg_user.id','tg_productssold.user_id')
                        ->join('tg_medicine','tg_medicine.id','tg_productssold.medicine_id')
                        ->first();
                if($count->count == NULL)
                {
                    $count = 0;
                }else{
                    $count = $count->count;
                }
                $day_plan = round($value->number/4);
                if($day_plan == 0)
                {
                    $day_plan = 1;
                }
            $medicine = Medicine::where('id',$value->medicine_id)->value('name');
            $plan_array[]= array('medicine' => $medicine,'plan' => $day_plan, 'make' => $count);
        }

        return $plan_array;
        // dd($plan_array);
    }
    public function getDay($date)
    {

        if ($date == 'Bugun') {
            $date_begin = date('Y-m-d');
            $date_end = date('Y-m-d');
            $dateText = 'Bugun';
        }
        if ($date == 'Hafta') {
            $date_begin = Carbon::now()->startOfWeek()->format('Y-m-d');
            $date_end = Carbon::now()->endOfWeek()->format('Y-m-d');
            $dateText = 'Bugun';
        }
        if ($date == 'Oy') {
            $date_begin = Carbon::now()->startOfMonth()->format('Y-m-d');
            $date_end = Carbon::now()->endOfMonth()->format('Y-m-d');
            $dateText = 'Bugun';
        }
        $item=new TimeItems();
            $item->date_begin=$date_begin;
            $item->date_end=$date_end;
            $item->dateText=$dateText;
            return $item;
    }
    public function  chart()
    {
        $month_start = Carbon::now()->startOfMonth()->format('Y-m-d');
            $month_end = Carbon::now()->endOfMonth()->format('Y-m-d');
        // $dates = [];


        // $dates[$month_start] = $month_end;
        $fact = [];
        $fact = [0];
        $plan = [];
        $plan = [0];
        $liga = [];
        $liga = [0];
        $k=3;
        for ($i=3; $i >= 1; $i--) {
                $last_month_start = date('Y-m-d',(strtotime ( '-'.$i.' month' , strtotime ( $month_start ) ) ));
                $first_date = $this->getFirstDate($last_month_start);
                $last_date = $this->getLastDate($last_month_start);
                // $dates[$first_date] = $last_date;
                $fact[] = numb($this->getOylik($first_date,$last_date,Auth::id()));
                $plan[] = numb($this->getPlan($first_date,$last_date,Auth::id()));
                $liga[] = numb($this->getLiga($first_date,$last_date,Auth::id())->plan);
        }

        $fact[] = numb($this->getOylik($month_start,$month_end,Auth::id()));


        $plan[] = numb($this->getPlan($month_start,$month_end,Auth::id()));


        $liga[] = numb($this->getLiga($month_start,$month_end,Auth::id())->plan);
        $arr = [];
        $arr[] = $fact;
        $arr[] = $plan;
        $arr[] = $liga;
        return $arr;
        // dd($arr);
    }
    public function getOylik($start_date,$end_date,$id)
    {

        $month_sol = $this->getFakt($start_date,$end_date,$id);


        if($month_sol == NULL)
        {
            $month_sol = 0;
        }

        $myoylik = maosh($month_sol);
        return $myoylik;
    }
    public function getPlan($start_date,$end_date,$id)
    {

        $plan = UserPlans::where('user_id',$id)
        ->whereDate('created_at','>=',$start_date)
        ->whereDate('created_at','<=',$end_date)
        ->get();
        if(count($plan) > 0)
        {
            $user_plan = $plan[0]->plan;
        }else{
            $month_sol = $this->getFakt($start_date,$end_date,$id);

            if($month_sol == NULL)
            {
                $month_sol = 0;
            }

            $user_plan = ($month_sol + $this->getNextLiga($start_date,$end_date,$id))/2;
        }
        return $user_plan;
    }
    public function getLiga($start_date,$end_date,$id)
    {

        $month_sol = $this->getFakt($start_date,$end_date,$id);


        if($month_sol > 35000000)
        {
            $month_sol = 35000000;
        }
        if($month_sol < 8000000)
        {
            $liga = Liga::where('plan','=',0)->orderBy('id','ASC')->first();

        }else{
            $liga = Liga::where('plan','<=',$month_sol)->orderBy('plan','DESC')->first();

        }
        return $liga;
    }
    public function getNextLiga($start_date,$end_date,$id)
    {

        $sum = $this->getFakt($start_date,$end_date,$id);

        if($sum >= 35000000)
            {
                $sum = 35000000;
            }
            $liga = Liga::where('plan','>=',$sum)->orderBy('id','asc')->first()->plan;
        return $liga;
    }


    public function getFakt($start_date,$end_date,$id)
    {
        $month_sol = DB::table('tg_productssold')
        ->selectRaw('SUM(number * price_product) as allprice')
        ->whereBetween(DB::raw('DATE(created_at)'),[$start_date,$end_date])
        ->where('user_id',$id)
        ->value('allprice');

        return $month_sol??0;
    }
}
