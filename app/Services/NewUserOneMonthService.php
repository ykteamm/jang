<?php

namespace App\Services;

use App\Items\MyBattleItems;
use App\Items\SummaNull;
use App\Items\SundayItems;
use App\Models\ElchiBall;
use App\Models\ElchiElexir;
use App\Models\ElexirForBattle;
use App\Models\ElexirHistory;
use App\Models\NewUserOneMonth;
use App\Models\UserBattle;
use App\Models\UserBattleDay;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewUserOneMonthService
{
    public $elo = 30;
    
    public function getBattle($id)
    {
        $exists_battle = $this->existsBattle($id);
        if($exists_battle == 0)
        {
            // dd($exists_battle);
            $str_day = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ) ));
            $start_index_day = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $str_day ) ) ));
            $end_index_day = date('Y-m-d',(strtotime ( '+3 day' , strtotime ( $str_day ) ) ));
            $no_sundays = $this->deleteSunday($start_index_day,$end_index_day);
            $start_day = $no_sundays->start_day;
            $end_day = $no_sundays->end_day;
            // dd($end_day);
            $new_battle = new UserBattle([
                'u1id' => $id,
                'u2id' => 104,
                'price1' => 0,
                'price2' => 0,
                'days' => 3,
                'start_day' => $start_day,
                'end_day' => $end_day,
                'bot' => 1
            ]);
            $new_battle->save();
        }
        


    }
    public function myFirstFakeBattle($my_battle,$sold_date)
    {
        if(count($my_battle) > 0)
        {
                $summa1 = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                ->whereDate('tg_productssold.created_at','=',$sold_date)
                ->where('tg_productssold.user_id','=',$my_battle[0]->u1id)
                ->groupBy('uid')->get();
                    
                $summa2 = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                ->where('tg_productssold.user_id','=',$my_battle[0]->u2id)
                ->groupBy('uid')->get();
                if(count($summa1) != 0){

                    if($summa1[0]->allprice == 0 || $summa1[0]->allprice < 200000)
                        {
                            $summa2[0]->allprice = 0;
                        }elseif($summa1[0]->allprice < 1000000)
                        {
                            $summa2[0]->allprice = $summa1[0]->allprice - 234000;
                        }
                        else{
                            $summa2[0]->allprice = $summa1[0]->allprice - 468000;
                        }
                }else{
                    $summa1=[];
                    $summa2=[];
                }
                
                $summa_bugun1 = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                ->whereDate('tg_productssold.created_at','>=',$my_battle[0]->start_day)
                ->whereDate('tg_productssold.created_at','<=',Carbon::now())
                ->where('tg_productssold.user_id','=',$my_battle[0]->u1id)
                ->groupBy('uid')->get();
                $summa_bugun2 = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                ->where('tg_productssold.user_id','=',$my_battle[0]->u2id)
                ->groupBy('uid')->get();
                if(count($summa_bugun1) != 0){

                    if($summa_bugun1[0]->allprice == 0 || $summa_bugun1[0]->allprice < 200000)
                        {
                            $summa_bugun2[0]->allprice = 0;
                        }elseif($summa_bugun1[0]->allprice < 1000000)
                        {
                            $summa_bugun2[0]->allprice = $summa_bugun1[0]->allprice - 234000;
                        }
                        else{
                            $summa_bugun2[0]->allprice = $summa_bugun1[0]->allprice - 468000;
                        }
                }else{
                    $summa_bugun1=[];
                    $summa_bugun2=[];
                }
                    
            $battle_start_day = $my_battle[0]->start_day;

        }else{
            $summa1=0;
            $summa2=0;
            $summa_bugun1=0;
            $summa_bugun2=0;
            $battle_start_day = Carbon::now();

        }
        $n = new MyBattleItems;
        $n->summa1= $summa1;
        $n->summa2= $summa2;
        $n->summa_bugun1=$summa_bugun1;
        $n->summa_bugun2=$summa_bugun2;
        $n->battle_start_day = $battle_start_day;
        return $n;
    }
    public function mySecondFakeBattle($my_battle,$sold_date)
    {
        if(count($my_battle) > 0)
        {
                $summa1 = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                ->whereDate('tg_productssold.created_at','=',$sold_date)
                ->where('tg_productssold.user_id','=',$my_battle[0]->u1id)
                ->groupBy('uid')->get();
                    
                $summa2 = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                ->where('tg_productssold.user_id','=',$my_battle[0]->u2id)
                ->groupBy('uid')->get();
                if(count($summa1) != 0){

                    if($summa1[0]->allprice == 0 || $summa1[0]->allprice < 200000)
                        {
                            $summa2[0]->allprice = $summa1[0]->allprice + 127000;
                        }elseif($summa1[0]->allprice < 1000000)
                        {
                            $summa2[0]->allprice = $summa1[0]->allprice + 234000;
                        }
                        else{
                            $summa2[0]->allprice = $summa1[0]->allprice + 468000;
                        }
                }else{
                    $summa1=[];
                    $summa2=[];
                }
                
                $summa_bugun1 = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                ->whereDate('tg_productssold.created_at','>=',$my_battle[0]->start_day)
                ->whereDate('tg_productssold.created_at','<=',Carbon::now())
                ->where('tg_productssold.user_id','=',$my_battle[0]->u1id)
                ->groupBy('uid')->get();
                $summa_bugun2 = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                ->where('tg_productssold.user_id','=',$my_battle[0]->u2id)
                ->groupBy('uid')->get();
                if(count($summa_bugun1) != 0){

                    if($summa_bugun1[0]->allprice == 0 || $summa_bugun1[0]->allprice < 200000)
                        {
                            $summa_bugun2[0]->allprice = $summa_bugun1[0]->allprice + 167000;
                        }elseif($summa_bugun1[0]->allprice < 1000000)
                        {
                            $summa_bugun2[0]->allprice = $summa_bugun1[0]->allprice + 234000;
                        }
                        else{
                            $summa_bugun2[0]->allprice = $summa_bugun1[0]->allprice + 468000;
                        }
                }else{
                    $summa_bugun1=[];
                    $summa_bugun2=[];
                }
                    
            $battle_start_day = $my_battle[0]->start_day;

        }else{
            $summa1=0;
            $summa2=0;
            $summa_bugun1=0;
            $summa_bugun2=0;
            $battle_start_day = Carbon::now();

        }
        $n = new MyBattleItems;
        $n->summa1= $summa1;
        $n->summa2= $summa2;
        $n->summa_bugun1=$summa_bugun1;
        $n->summa_bugun2=$summa_bugun2;
        $n->battle_start_day = $battle_start_day;
        return $n;
    }
    public function firstFakeBattleDay($dates)
    {
        $battle_date = $dates;
        $sold_date = $dates;
        // $battle_date = '2023-02-02';
        // $sold_date = '2023-02-02';
        $new_user_id = NewUserOneMonth::where('active',1)->pluck('user_id')->toArray();
        $arr_new = [];
        foreach ($new_user_id as $key => $value) {
            $my_battle_all = UserBattle::with('u1ids','u2ids')
            ->where(function($query) use ($value){
                        $query->where('u1id',$value)
                        ->orWhere('u2id',$value);
                    })->where('ends',1)->get();

            if(count($my_battle_all) < 2)
            {
                $arr_new[] = $value;
            }
        }
        $all_battles = UserBattle::whereDate('start_day','<=',$battle_date)->whereDate('end_day','>=',$battle_date)
        ->whereIn('u1id',$arr_new)->where('ends',0)->get();
        if(count($all_battles) > 0)
        {
            foreach ($all_battles as $key => $value) {
                $summa1 = DB::table('tg_productssold')
                                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                                ->whereDate('tg_productssold.created_at','=',$sold_date)
                                ->where('tg_productssold.user_id','=',$value->u1id)
                                ->groupBy('uid')->get();
                $summa2 = DB::table('tg_productssold')
                                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                                ->whereDate('tg_productssold.created_at','=',$sold_date)
                                ->where('tg_productssold.user_id','=',$value->u2id)
                                ->groupBy('uid')->get();
                

                if(count($summa1) != 0){
                    if(count($summa2) == 0)
                    {
                        $summa2=[];

                    }else{
                        if($summa1[0]->allprice == 0 || $summa1[0]->allprice < 200000)
                        {
                            $summa2[0]->allprice = 0;
                        }elseif($summa1[0]->allprice < 1000000)
                        {
                            $summa2[0]->allprice = $summa1[0]->allprice - 234000;
                        }
                        else{
                            $summa2[0]->allprice = $summa1[0]->allprice - 468000;
                        }
                    }
                    
                }else{
                    $summa1=[];
                    $summa2=[];
                }

                $u1 = $this->summaNull($summa1,$value->u1id);
                $u1id = $u1->uid;
                $price1 = $u1->price;
                $u2 = $this->summaNull($summa2,$value->u2id);
                $u2id = $u2->uid;
                $price2 = $u2->price;

                if($price1 == 0 || $price1 < 200000)
                    {
                        $price2 = 0;
                    }elseif($price1 < 1000000)
                    {
                        $price2 = $price1 - 234000;
                    }
                    else{
                        $price2 = $price1 - 468000;
                    }
                // $u1_ball = $this->existsBall($u1id);
                // $u2_ball = $this->existsBall($u2id);
                // dd($price2);

                if($price1 > $price2)
                {
                    $win = $u1id;
                    $lose = $u2id;
                }elseif($price1 < $price2)
                {
                    $win = $u2id;
                    $lose = $u1id;
                }else{
                    $win = NULL;
                    $lose = NULL;
                }

                $this->userBattleDaySave($value,$u1id,$u2id,$price1,$price2,$win,$lose,$battle_date);

            }

        }
    }
    public function secondFakeBattleDay($dates)
    {
        $battle_date = $dates;
        $sold_date = $dates;
        // $battle_date = '2023-02-02';
        // $sold_date = '2023-02-02';
        $new_user_id = NewUserOneMonth::where('active',1)->pluck('user_id')->toArray();
        $arr_new = [];
        foreach ($new_user_id as $key => $value) {
            $my_battle_all = UserBattle::with('u1ids','u2ids')
            ->where(function($query) use ($value){
                        $query->where('u1id',$value)
                        ->orWhere('u2id',$value);
                    })->where('ends',1)->get();

            if(count($my_battle_all) < 2)
            {
                $arr_new[] = $value;
            }
        }
        $all_battles = UserBattle::whereDate('start_day','<=',$battle_date)->whereDate('end_day','>=',$battle_date)
        ->whereIn('u1id',$arr_new)->where('ends',0)->get();
        if(count($all_battles) > 0)
        {
            foreach ($all_battles as $key => $value) {
                $summa1 = DB::table('tg_productssold')
                                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                                ->whereDate('tg_productssold.created_at','=',$sold_date)
                                ->where('tg_productssold.user_id','=',$value->u1id)
                                ->groupBy('uid')->get();
                $summa2 = DB::table('tg_productssold')
                                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                                ->whereDate('tg_productssold.created_at','=',$sold_date)
                                ->where('tg_productssold.user_id','=',$value->u2id)
                                ->groupBy('uid')->get();
                

                if(count($summa1) != 0){
                    if(count($summa2) == 0)
                    {
                        $summa2=[];

                    }else{
                        if($summa1[0]->allprice == 0 || $summa1[0]->allprice < 200000)
                        {
                            $summa2[0]->allprice = $summa1[0]->allprice + 167000;
                        }elseif($summa1[0]->allprice < 1000000)
                        {
                            $summa2[0]->allprice = $summa1[0]->allprice + 234000;
                        }
                        else{
                            $summa2[0]->allprice = $summa1[0]->allprice + 468000;
                        }
                    }
                    
                }else{
                    $summa1=[];
                    $summa2=[];
                }

                $u1 = $this->summaNull($summa1,$value->u1id);
                $u1id = $u1->uid;
                $price1 = $u1->price;
                $u2 = $this->summaNull($summa2,$value->u2id);
                $u2id = $u2->uid;
                $price2 = $u2->price;

                if($price1 == 0 || $price1 < 200000)
                    {
                        $price2 = $price1 + 167000;
                    }elseif($price1 < 1000000)
                    {
                        $price2 = $price1 + 234000;
                    }
                    else{
                        $price2 = $price1 + 468000;
                    }
                // $u1_ball = $this->existsBall($u1id);
                // $u2_ball = $this->existsBall($u2id);
                // dd($price2);

                if($price1 > $price2)
                {
                    $win = $u1id;
                    $lose = $u2id;
                }elseif($price1 < $price2)
                {
                    $win = $u2id;
                    $lose = $u1id;
                }else{
                    $win = NULL;
                    $lose = NULL;
                }

                $this->userBattleDaySave($value,$u1id,$u2id,$price1,$price2,$win,$lose,$battle_date);

            }

        }
    }
    public function userBattleDaySave($battle,$u1id,$u2id,$price1,$price2,$win,$lose,$battle_date)
    {

        $new_battle = new UserBattleDay([
            'battle_id' => $battle->id,
            'u1id' => $u1id,
            'u2id' => $u2id,
            'sold1' => $price1,
            'sold2' => $price2,
            'win' => $win,
            'lose' => $lose,
            'battle_date' => $battle_date,
        ]);
        $new_battle->save();
        if($new_battle->id){
            $this->battleEnds($battle);
        }
    }
    public function battleEnds($battle)
    {
        if($battle->days == $battle->day + 1)
            {
                $update = UserBattle::where('id',$battle->id)->update([
                    'day' => $battle->day+1,
                    'ends' => 1,
                ]);
            }else{
                $update = UserBattle::where('id',$battle->id)->update([
                    'day' => $battle->day+1,
                ]);
            }
    }
    public function endBattle($dates)
    {
        $end_date = $dates;

        $new_user_id = NewUserOneMonth::where('active',1)->pluck('user_id')->toArray();
        $arr_new = [];
        foreach ($new_user_id as $key => $value) {
            $my_battle_all = UserBattle::with('u1ids','u2ids')
            ->where(function($query) use ($value){
                        $query->where('u1id',$value)
                        ->orWhere('u2id',$value);
                    })->where('ends',1)->get();

            if(count($my_battle_all) < 2)
            {
                $arr_new[] = $value;
            }
        }
        $all_battles = UserBattle::whereDate('end_day',$end_date)
        ->whereIn('u1id',$arr_new)
        ->where('ends',1)->get();
        // $all_battles = UserBattle::where('id',130)->get();
        if(count($all_battles) > 0)
        {
            foreach($all_battles as $b)
            {
                $sold1 = UserBattleDay::where('battle_id',$b->id)->sum('sold1');
                $sold2 = UserBattleDay::where('battle_id',$b->id)->sum('sold2');
                // $sold2 = UserBattleDay::where('u1id',$b->u1id)->where('u2id',$b->u2id)->sum('sold2');
                $u1_ball = $this->existsBall($b->u1id);
                $u2_ball = $this->existsBall($b->u2id);


                if($sold1 > $sold2)
                    {
                    $this->ifPrice1($b,$u1_ball,$u2_ball,$sold1,$sold2,$this->elo);

                    }
                    elseif($sold2 > $sold1)
                    {
                        $this->ifPrice2($b,$u1_ball,$u2_ball,$sold1,$sold2,$this->elo);

                    }
                    else
                    {
                        $this->draw($b,$u1_ball,$u2_ball,$sold1,$sold2);

                    }

            }
        }

    }

    public function existsBattle($my_id)
    {

        $my_battle = UserBattle::with('u1ids','u2ids')
        ->whereDate('start_day','<=',date('Y-m-d'))
        ->whereDate('end_day','>=',date('Y-m-d'))
        ->where(function($query) use ($my_id){
                    $query->where('u1id',$my_id)
                    ->orWhere('u2id',$my_id);
                })->count();
        return $my_battle;
    }
    public function deleteSunday($start_index_day,$end_index_day)
    {
        $arrayDate = array();
                $Variable1 = strtotime($start_index_day);
                $Variable2 = strtotime($end_index_day);
                $sum = 0;
                for ($currentDate = $Variable1; $currentDate <= $Variable2;$currentDate += (86400)) 
                {                        
                    $Store = date('w', $currentDate);
                    if($Store == 0)
                    {
                        $sum += 1;
                    }else{
                        $arrayDate[] = date('Y-m-d', $currentDate);

                    }
                }
                if($sum > 0)
                {
                    for ($i=1; $i <= $sum; $i++) { 
                        $ends = date('w',(strtotime ( '+1 day' , strtotime ( end($arrayDate) ) ) ));
                        if($ends == 0)
                        {
                            $endsw = date('Y-m-d',(strtotime ( '+2 day' , strtotime ( end($arrayDate) ) ) ));
                        }else{
                            $endsw = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( end($arrayDate) ) ) ));
                        }
                        $arrayDate[] = $endsw;
                    }
                }
                $start_day = $arrayDate[0];
                $end_day = end($arrayDate);
            
                $item=new SundayItems();
                $item->start_day=$start_day;
                $item->end_day=$end_day;
                return $item;
    }
    public function summaNull($summa,$id)
    {
        if(count($summa) == 0)
        {
            $uid = $id;
            $price = 0;
        }else{
            $uid = $summa[0]->uid;
            $price = $summa[0]->allprice;
        }
        $item = new SummaNull();
        $item->uid = $uid;
        $item->price = $price;
        return $item;

    }
    public function ifPrice1($b,$u1_ball,$u2_ball,$price1,$price2,$d)
    {

                $pow = pow(10,($u2_ball-$u1_ball)/400);
                $e = 1/(1+$pow);
                $r1 = round($d*(1-$e)) + round($price1/200000);
                
                $pow = pow(10,($u1_ball-$u2_ball)/400);
                $e = 1/(1+$pow);
                $r2 = round($d*(0-$e)) - round($price2/200000);

                if(($u2_ball-abs($r2)) <= 50)
                {
                    $r2 = $u2_ball-50;
                }
                if($b->bot == 0)
                {   
                    
                    $ball2 = abs($r2);
                    $uball2 = $u2_ball-abs($r2);
                    $bot = 0;
                }else{
                    $ball2 = 0;
                    $uball2 = $u2_ball;
                    $bot = 1;
                }
                $dif_ball1 = ElchiBall::where('user_id',$b->u1id)->update([
                    'ball' => $u1_ball+$r1,
                ]);
                $dif_ball2 = ElchiBall::where('user_id',$b->u2id)->update([
                    'ball' => $uball2,
                ]);
                
                $this->updateElexir($b->u1id,$b->id);
                
                $new_battle = UserBattle::where('id',$b->id)->update([
                    // 'battle_id' => $battle->id,
                    // 'u1id' => $u1id,
                    // 'u2id' => $u2id,
                    // 'price1' => $price1,
                    // 'price2' => $price2,
                    'win' => $b->u1id,
                    'lose' => $b->u2id,
                    'ball1' => abs($r1),
                    'ball2' => $ball2,
                    'uball1' => $u1_ball+$r1,
                    'uball2' => $uball2,
                    'bot' => $bot,
                ]);
                // $new_battle->save();
                // if($new_battle->id){
                //     $this->battleEnds($battle);
                // }
    }
    public function ifPrice2($b,$u1_ball,$u2_ball,$price1,$price2,$d)
    {
        $pow = pow(10,($u2_ball-$u1_ball)/400);
        $e = 1/(1+$pow);
        $r1 = round($d*(0-$e)) - round($price1/200000); 
        $pow = pow(10,($u1_ball-$u2_ball)/400);
        $e = 1/(1+$pow);
        $r2 = round($d*(1-$e)) + round($price2/200000);

        if(($u1_ball-abs($r1)) <= 50)
        {
            $r1 = $u1_ball-50;
        }
        if($b->bot == 0)
        {   
            $ball2 = abs($r2);
            $uball2 = $u2_ball+abs($r2);
            $bot = 0;
        }else{
            $ball2 = 0;
            $uball2 = $u2_ball;
            $bot = 1;
        }

        $dif_ball1 = ElchiBall::where('user_id',$b->u1id)->update([
            'ball' => $u1_ball-abs($r1),
        ]);
        $dif_ball2 = ElchiBall::where('user_id',$b->u2id)->update([
            'ball' => $uball2,
        ]);

        if($b->bot == 0)
        {
            $this->updateElexir($b->u2id,$b->id);
        }else{
            $newsd = UserBattle::where('id',$b->id)->first();
            if($b->u2id != $newsd->u2id)
            {
                $this->updateElexir($b->u1id,$b->id);
            }
        }



        $new_battle = UserBattle::where('id',$b->id)->update([
            // 'battle_id' => $battle->id,
            // 'u1id' => $u1id,
            // 'u2id' => $u2id,
            // 'price1' => $price1,
            // 'price2' => $price2,
            'win' => $b->u2id,
            'lose' => $b->u1id,
            'ball1' => abs($r1),
            'ball2' => $ball2,
            'uball1' => $u1_ball-abs($r1),
            'uball2' => $uball2,
            // 'battle_date' => $this->battle_date,
            'bot' => $bot,
        ]);
        // $new_battle->save();

        // if($new_battle->id){
        //     $this->battleEnds($battle);
        // }
    }
    public function draw($b,$u1_ball,$u2_ball,$sold1,$sold2)
    {
        $new_battle = UserBattle::where('id',$b->id)->update([
            // 'battle_id' => $battle->id,
            // 'u1id' => $u1id,
            // 'u2id' => $u2id,
            // 'price1' => $price1,
            // 'price2' => $price2,
            'win' => NULL,
            'lose' => NULL,
            'ball1' => 0,
            'ball2' => 0,
            'uball1' => $u1_ball,
            'uball2' => $u2_ball,
            // 'battle_date' => $this->battle_date,
        ]);
        // $new_battle->save();

        // if($new_battle->id){
        //     $this->battleEnds($battle);
        // }
    }
    public function existsBall($id)
    {
        $ball = ElchiBall::where('user_id',$id)->get();
            if(count($ball) == 0)
            {
                $new = new ElchiBall([
                    'user_id' => $id,
                    'ball' => 100,
                    'active' => 0,
                ]);
                $new->save();
            }
        $ball = ElchiBall::where('user_id',$id)->get()[0]->ball;
        return $ball;
        
    }
    public function updateElexir($win,$battle_id)
    {
        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');
        $price = DB::table('tg_productssold')
                        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                        ->whereDate('tg_productssold.created_at','>=',$start)
                        ->whereDate('tg_productssold.created_at','<=',$end)
                        ->where('tg_productssold.user_id','=',$win)
                        ->join('tg_user','tg_user.id','tg_productssold.user_id')
                        ->get()[0]->allprice;  
            if($price == null)
            {
                $price = 0;
            }

        $for_battle = ElexirForBattle::where('plan','<=',floor($price/1000000))->orderBy('plan','DESC')->first();
        if($for_battle == null)
        {
            $for_battle_el = ElexirForBattle::orderBy('id','ASC')->limit(1)->value('elexir');
        }
        else{
            $for_battle_el = $for_battle->elexir;
        }
        $elexir = floor($for_battle_el/8);

        $elexir_count = ElchiElexir::where('user_id',$win)->get();

        if(count($elexir_count) > 0)
        {
            ElchiElexir::where('user_id',$win)->update([
                'elexir' => $elexir_count[0]->elexir + $elexir,
            ]);
        }else{
            $new = DB::table('tg_elchi_elexir')->insert([
                'user_id' => $win,
                'elexir' => $elexir,
            ]);
        }

        $battle = UserBattle::find($battle_id);
        
        $new_history = new ElexirHistory([
            'user_id' => $win,
            'elexir' => $elexir,
            'reason' => 'G\'alaba uchun',
            'start_day' => $battle->start_day,
            'end_day' => $battle->end_day,
        ]);

        $new_history->save();

    }

}