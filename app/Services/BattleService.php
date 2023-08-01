<?php

namespace App\Services;

use App\Items\SummaNull;
use App\Items\SundayItems;
use App\Models\User;
use App\Models\BattleDay;
use App\Models\AllSold;
use App\Models\BattleElchi;
use App\Models\ElchiBall;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BattleService
{
    public $str_day;
    public $sold_date;
    public $battle_date;
    public $elo = 30;
    
    public function battleDay()
    {
        // $this->str_day = '2023-01-18';
        $this->str_day = date('Y-m-d');

        $endday = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( Carbon::now() ) ) ));
        $startday = date('Y-m-d',(strtotime ( '-7 day' , strtotime ( Carbon::now() ) ) ));
        $all_user = User::pluck('id');
        $u1id = BattleDay::where('ends',0)->pluck('u1id')->toArray();
        $u2id = BattleDay::where('ends',0)->pluck('u2id')->toArray();
        $alluid = array_unique(array_merge($u1id,$u2id));
        $users = [];
        foreach($all_user as $id)
        {
            $transactions= AllSold::whereBetween('created_at', [$startday, $endday])
            ->select(DB::raw('DATE(created_at) as date'))
            ->where('user_id',$id)
            ->groupBy('date')
            ->get('date');
            $sizeof = sizeof($transactions);
                if($sizeof >= 2 && !in_array($id,$alluid))
                {
                    $users[] = $id;
                }
        }
        // dd(count($users));
        if(count($users) > 1)
        {

            $battle=array();
            $day = 10;
            foreach ($users as $key => $user) {
                    $count = 0;
                    $sum = 0;
                    for ($i=0; $i < $day; $i++) { 
                        $date = date('Y-m-d',(strtotime ( '-'.$i.' day' , strtotime ( $startday) ) ));
                        $summa = DB::table('tg_productssold')
                                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id')
                                ->whereDate('tg_productssold.created_at','=',$date)
                                ->where('tg_user.id','=',$user)
                                ->join('tg_user','tg_user.id','tg_productssold.user_id')
                                ->orderBy('tg_user.id','ASC')
                                ->groupBy('tg_user.id')->first();
                        if(isset($summa->allprice))
                        {
                            $sum+=$summa->allprice;
                        }
                        $count += DB::table('tg_smena')->whereDate('created_from',$date)
                        ->where('user_id',$user)
                        ->count();
                    }
                    if($count != 0)
                    {
                        $battle[]= array('id' => $user, 'price' => round($sum/$count));
                    }else{
                        $battle[]= array('id' => $user, 'price' => 0);
                    }
            }

            $sums = array_column($battle, 'price');
            array_multisort($sums, SORT_ASC, $battle);
            $start_index_day = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $this->str_day ) ) ));
            $end_index_day = date('Y-m-d',(strtotime ( '+3 day' , strtotime ( $this->str_day ) ) ));
            $no_sundays = $this->deleteSunday($start_index_day,$end_index_day);
            $start_day = $no_sundays->start_day;
            $end_day = $no_sundays->end_day;
            $no_sundays = $this->battleDaySave($battle,$start_day,$end_day);
        }

    }
    public function battleDaySave($battle,$start_day,$end_day)
    {
        if (count($battle)%2 == 0) {
            for ($i=0; $i < count($battle)/2; $i++) {
                $new_battle = new BattleDay([
                    'u1id' => $battle[$i*2]['id'],
                    'u2id' => $battle[($i*2)+1]['id'],
                    'price1' => $battle[$i*2]['price'],
                    'price2' => $battle[($i*2)+1]['price'],
                    'days' => 3,
                    'start_day' => $start_day,
                    'end_day' => $end_day,
                ]);
                $new_battle->save();
            }
        } else {
            $last = $battle[count($battle)-1];
            unset($battle[count($battle)-1]);
            for ($i=0; $i < count($battle)/2; $i++) { 
                $new_battle = new BattleDay([
                    'u1id' => $battle[$i*2]['id'],
                    'u2id' => $battle[($i*2)+1]['id'],
                    'price1' => $battle[$i*2]['price'],
                    'price2' => $battle[($i*2)+1]['price'],
                    'days' => 3,
                    'start_day' => $start_day,
                    'end_day' => $end_day,
                ]);
                $new_battle->save();
            }
            $new_battle = new BattleDay([
                'u1id' => $last['id'],
                'u2id' => $battle[count($battle)-1]['id'],
                'price1' => $last['price'],
                'price2' => $battle[count($battle)-1]['price'],
                'days' => 3,
                'start_day' => $start_day,
                'end_day' => $end_day,
                'bot' => 1
            ]);
            $new_battle->save();
        }
    }
    public function battleElchi()
    {
        $this->battle_date = date('Y-m-d');
        $this->sold_date = date('Y-m-d');
        // $this->battle_date = '2023-01-24';
        // $this->sold_date = '2023-01-24';
        $all_battles = BattleDay::whereDate('start_day','<=',$this->battle_date)->whereDate('end_day','>=',$this->battle_date)->where('ends',0)->get();
        if(count($all_battles) > 0)
        {
            foreach ($all_battles as $key => $value) {
                $summa1 = DB::table('tg_productssold')
                                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                                ->whereDate('tg_productssold.created_at','=',$this->sold_date)
                                ->where('tg_productssold.user_id','=',$value->u1id)
                                ->groupBy('uid')->get();
                $summa2 = DB::table('tg_productssold')
                                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                                ->whereDate('tg_productssold.created_at','=',$this->sold_date)
                                ->where('tg_productssold.user_id','=',$value->u2id)
                                ->groupBy('uid')->get();
                $u1 = $this->summaNull($summa1,$value->u1id);
                $u1id = $u1->uid;
                $price1 = $u1->price;
                $u2 = $this->summaNull($summa2,$value->u2id);
                $u2id = $u2->uid;
                $price2 = $u2->price;

                $u1_ball = $this->existsBall($u1id);
                $u2_ball = $this->existsBall($u2id);

                if($price1 > $price2)
                {
                    $this->ifPrice1($u1id,$u2id,$value,$u1_ball,$u2_ball,$price1,$price2,$this->elo);
                }
                if($price2 > $price1)
                {
                    $this->ifPrice2($u1id,$u2id,$value,$u1_ball,$u2_ball,$price1,$price2,$this->elo);
                }
                if($price2 == $price1)
                {
                    $this->draw($u1id,$u2id,$value,$u1_ball,$u2_ball,$price1,$price2);
                }

            }
        }
    }
    public function ifPrice1($u1id,$u2id,$battle,$u1_ball,$u2_ball,$price1,$price2,$d)
    {
        $pow = pow(10,($u2_ball-$u1_ball)/400);
                $e = 1/(1+$pow);
                $r1 = round($d*(1-$e)) + round($price1/100000);
                
                $pow = pow(10,($u1_ball-$u2_ball)/400);
                $e = 1/(1+$pow);
                $r2 = round($d*(0-$e)) - round($price2/100000);
                if(($u2_ball-abs($r2)) <= 50)
                {
                    $r2 = $u2_ball-50;
                }
                if($battle->bot == 0)
                {   
                    $ball2 = abs($r2);
                    $uball2 = $u2_ball-abs($r2);
                    $bot = 0;
                }else{
                    $ball2 = 0;
                    $uball2 = $u2_ball;
                    $bot = 1;
                }
                $dif_ball1 = ElchiBall::where('user_id',$u1id)->update([
                    'ball' => $u1_ball+$r1,
                ]);
                $dif_ball2 = ElchiBall::where('user_id',$u2id)->update([
                    'ball' => $uball2,
                ]);

                $new_battle = new BattleElchi([
                    'battle_id' => $battle->id,
                    'u1id' => $u1id,
                    'u2id' => $u2id,
                    'price1' => $price1,
                    'price2' => $price2,
                    'win' => 1,
                    'lose' => 0,
                    'ball1' => abs($r1),
                    'ball2' => $ball2,
                    'uball1' => $u1_ball+$r1,
                    'uball2' => $uball2,
                    'battle_date' => $this->battle_date,
                    'bot' => $bot,
                ]);
                $new_battle->save();
                if($new_battle->id){
                    $this->battleEnds($battle);
                }
    }
    public function ifPrice2($u1id,$u2id,$battle,$u1_ball,$u2_ball,$price1,$price2,$d)
    {
        $pow = pow(10,($u2_ball-$u1_ball)/400);
        $e = 1/(1+$pow);
        $r1 = round($d*(0-$e)) - round($price1/100000); 

        $pow = pow(10,($u1_ball-$u2_ball)/400);
        $e = 1/(1+$pow);
        $r2 = round($d*(1-$e)) + round($price2/100000);
        
        if(($u1_ball-abs($r1)) <= 50)
        {
            $r1 = $u1_ball-50;
        }
        if($battle->bot == 0)
        {   
            $ball2 = abs($r2);
            $uball2 = $u2_ball+abs($r2);
            $bot = 0;
        }else{
            $ball2 = 0;
            $uball2 = $u2_ball;
            $bot = 1;
        }

        $dif_ball1 = ElchiBall::where('user_id',$u1id)->update([
            'ball' => $u1_ball-abs($r1),
        ]);
        $dif_ball2 = ElchiBall::where('user_id',$u2id)->update([
            'ball' => $uball2,
        ]);

        $new_battle = new BattleElchi([
            'battle_id' => $battle->id,
            'u1id' => $u1id,
            'u2id' => $u2id,
            'price1' => $price1,
            'price2' => $price2,
            'win' => 0,
            'lose' => 1,
            'ball1' => abs($r1),
            'ball2' => $ball2,
            'uball1' => $u1_ball-abs($r1),
            'uball2' => $uball2,
            'battle_date' => $this->battle_date,
            'bot' => $bot,
        ]);
        $new_battle->save();

        if($new_battle->id){
            $this->battleEnds($battle);
        }
    }
    public function draw($u1id,$u2id,$battle,$u1_ball,$u2_ball,$price1,$price2)
    {
        $new_battle = new BattleElchi([
            'battle_id' => $battle->id,
            'u1id' => $u1id,
            'u2id' => $u2id,
            'price1' => $price1,
            'price2' => $price2,
            'win' => 3,
            'lose' => 3,
            'ball1' => 0,
            'ball2' => 0,
            'uball1' => $u1_ball,
            'uball2' => $u2_ball,
            'battle_date' => $this->battle_date,
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
                $update = BattleDay::where('id',$battle->id)->update([
                    'day' => $battle->day+1,
                    'ends' => 1,
                ]);
            }else{
                $update = BattleDay::where('id',$battle->id)->update([
                    'day' => $battle->day+1,
                ]);
            }
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
}

// $if_array=[];
        // foreach ($alluid as $aid) {
        //     $finds = BattleDay::where('ends',0)
        //     ->whereDate('start_day','>',date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $this->str_day ) ) )))
        //     // ->whereDate('end_day','>=',date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $this->str_day ) ) )))
        //     ->where(function($query) use ($aid){
        //         $query->where('u1id',$aid)
        //         ->orWhere('u2id',$aid);
        //     })->get();
        //     if(count($finds) != 0)
        //     {
        //         $if_array[$finds[0]->id] = $aid;
        //     }
        // }
        

        // $if_battle1 = BattleDay::whereDate('start_day','<=',date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $this->str_day ) ) )))
        // ->whereDate('end_day','>=',date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $this->str_day ) ) )))
        // ->where('ends',0)->pluck('u1id')->toArray();
        // $if_battle2 = BattleDay::whereDate('start_day','<=',date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $this->str_day ) ) )))
        // ->whereDate('end_day','>=',date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $this->str_day ) ) )))
        // ->where('ends',0)->pluck('u2id')->toArray();
        // $if_battle = array_unique(array_merge($if_battle1,$if_battle2));
        
        // $yes_battle=array_diff($alluid,$if_battle);
        // $finds = BattleDay::where('ends',0)->where(function($query) use ($yes_battle){
        //         $query->where('u1id',$yes_battle)
        //         ->orWhere('u2id',$yes_battle);
        //     })->get()[0];
        
        
        // dd($finds->start_day);