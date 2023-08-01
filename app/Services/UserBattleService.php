<?php

namespace App\Services;

use App\Items\SummaNull;
use App\Items\SundayItems;
use App\Models\User;
use App\Models\BattleDay;
use App\Models\AllSold;
use App\Models\BattleElchi;
use App\Models\ElchiBall;
use App\Models\ElchiElexir;
use App\Models\ElexirForBattle;
use App\Models\ElexirHistory;
use App\Models\NewUserOneMonth;
use App\Models\Shift;
use App\Models\UserBattle;
use App\Models\UserBattleDay;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserBattleService
{
    public $str_day;
    public $sold_date;
    public $battle_date;
    public $elo = 30;

    public function battle($dates)
    {
        $this->str_day = $dates;
        // $this->str_day = date('Y-m-d');
            $endday = date('Y-m-d',(strtotime ( '-0 day' , strtotime ( $this->str_day ) ) ));
            $startday = date('Y-m-d',(strtotime ( '-20 day' , strtotime ( $this->str_day ) ) ));

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


        $all_user = User::pluck('id');
        $u1id = UserBattle::where('ends',0)->whereNotIn('u1id',$arr_new)->pluck('u1id')->toArray();
        $u2id = UserBattle::where('ends',0)->whereNotIn('u1id',$arr_new)->pluck('u2id')->toArray();


        $alluid = array_unique(array_merge($u1id,$u2id));

        $users = [];
        $users2 = [];

        foreach($all_user as $id)
        {

            $Variable1 = strtotime($startday);
            $Variable2 = strtotime($endday);
            $sum = 0;
            if(!in_array($id,$alluid))
            {
                for ($currentDate = $Variable1; $currentDate <= $Variable2;$currentDate += (86400))
                {
                    $summa = DB::table('tg_productssold')
                        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                        ->whereDate('tg_productssold.created_at','=',date('Y-m-d',$currentDate))
                        ->where('tg_productssold.user_id','=',$id)
                        ->join('tg_user','tg_user.id','tg_productssold.user_id')
                        ->get()[0]->allprice;
                    if($summa != null)
                    {
                        $sum += 1;
                    }

                }


                if($sum >= 2)
                {
                    $users[] = $id;
                }

            }
        }


        if(count($users) > 1)
        {
            $foruser = [];
            $forpro = [];
            foreach ($users as $key => $value) {

                $us = User::find($value);
                if($us->specialty_id == 1)
                {
                    $foruser[] = $value;
                }else{
                    $forpro[] = $value;
                }
            }





            if(count($foruser) > 1)
                {
                    $bat = $this->getWinLoseAlgoritm($foruser);

                    $defaultuser = [];
                    foreach($foruser as $all_user)
                    {
                        if(!in_array($all_user,$bat))
                        {
                            $defaultuser[] = $all_user;
                        }
                    }
                     $this->forKubok($defaultuser,$this->str_day,$bat);
                }
            if(count($forpro) > 1)
                {
                    $batpro = $this->getWinLoseAlgoritm($forpro);

                    $defaultpro = [];
                    foreach($forpro as $all_user_pro)
                    {
                        if(!in_array($all_user_pro,$batpro))
                        {
                            $defaultpro[] = $all_user_pro;
                        }
                    }
                     $this->forKubok($defaultpro,$this->str_day,$batpro);
                }
        }

    }
    public function getWinLoseAlgoritm($foruser)
    {
        $wins = [];
            $loses = [];
            foreach($foruser as $ids)
            {
                $my_battle_all = UserBattle::where(function($query) use ($ids){
                            $query->where('u1id',$ids)
                            ->orWhere('u2id',$ids);
                        })->orderBy('id','ASC')->limit(3)->get();

                $win0 = 0;
                $lose0 = 0;

                foreach ($my_battle_all as $key => $value) {
                    if($my_battle_all[count($my_battle_all)-$key-1]->win == $ids)
                    {
                        $win0 += 1;
                        $lose0 = 0;
                    }else{
                        $win0 = 0;
                        $lose0 += 1;
                    }
                    if($lose0 == 0 && $win0 != 1)
                    {
                        $wins[$ids] = $win0;
                    }
                    if($win0 == 0 && $lose0 != 1)
                    {
                        $loses[$ids] = $lose0;
                    }

                }
            }
            arsort($loses);
            arsort($wins);
            $loswer = $loses;
            $winwer = $wins;
            $battle = [];
            $bids = [];

            $winpartner = $this->getWinPartner($wins);
            $losepartner = $this->getlosePartner($loses);

            $winpart = $winpartner;
            $losepart = $losepartner;

                foreach($losepartner as $key => $value)
                {
                    foreach($winpartner as $keyl => $valuel)
                    {
                        if($value > $valuel)
                        {
                            // $battle[]= array('id' => $key);
                            // $battle[]= array('id' => $keyl);
                            $battle[] = $key;
                            $battle[] = $keyl;
                            unset($winpartner[$keyl]);
                            break;
                        }
                    }
                }
            if(count($winpart) > count($losepart))
            {
                foreach($winpart as $ks => $vs)
                {
                    if(!in_array($ks,$battle))
                    {
                        $battle[] = $ks;
                    }
                }
            }
            if(count($winpart) < count($losepart))
            {
                foreach($losepart as $ks => $vs)
                {
                    if(!in_array($ks,$battle))
                    {
                        $battle[] = $ks;
                    }
                }
            }
        return $battle;
    }
    public function getWinPartner($wins)
    {
        $arr = [];
        foreach($wins as $key => $value)
        {
            $ortacha = $this->getSoldAverage($key);
            $arr[$key] = $ortacha;

        }
        asort($arr);
        return $arr;
    }
    public function getLosePartner($loses)
    {
        $arr = [];
        foreach($loses as $key => $value)
        {
            $ortacha = $this->getSoldAverage($key);
            $arr[$key] = $ortacha;

        }
        asort($arr);
        return $arr;
    }
    public function getSoldAverage($id)
    {
        $enddayw = strtotime(date('Y-m-d',(strtotime ( '-0 day' , strtotime ( $this->str_day ) ) )));
        $startdayw = strtotime(date('Y-m-d',(strtotime ( '-20 day' , strtotime ( $this->str_day ) ) )));
        $sumortacha = 0;
        $shiftcount = 0;
                for ($currentDate = $startdayw; $currentDate <= $enddayw;$currentDate += (86400))
                    {

                        $shift = Shift::where('user_id',$id)->first();
                        if($shift)
                        {
                            $summa = DB::table('tg_productssold')
                            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                            ->whereDate('tg_productssold.created_at','=',date('Y-m-d',$currentDate))
                            ->where('tg_productssold.user_id','=',$id)
                            ->join('tg_user','tg_user.id','tg_productssold.user_id')
                            ->get()[0]->allprice;
                            if($summa != null)
                            {
                                $sumortacha += $summa;
                            }

                            $shiftcount += 1;

                        }

                        $ortacha = $sumortacha/$shiftcount;


                    }
        return $ortacha;
    }
    public function forKubok($users,$str_day,$algoritm)
    {

        // $user = [33,104,194,197,5,211,215];



        $kubok = DB::table('tg_balls')->whereIn('user_id',$users)->orderBy('ball','DESC')->get();
        $kubok_users = DB::table('tg_balls')->whereIn('user_id',$users)->orderBy('ball','DESC')->pluck('user_id')->toArray();
        $battle=array();
        $sdf = $kubok;



        foreach($kubok as $k => $v)
        {
            $my_id = $v->user_id;

            if(in_array($my_id,$kubok_users))
            {
                    $last_battle = UserBattle::select('u1id','u2id')->where(function($query) use ($my_id){
                        $query->where('u1id',$my_id)
                        ->orWhere('u2id',$my_id);
                    })->orderBy('id','DESC')->first();

                    if($last_battle){

                    array_shift($kubok_users);


                    if($my_id == $last_battle->u1id??0)
                    {
                        $partner_id = $last_battle->u2id;
                    }else{
                        $partner_id = $last_battle->u1id;
                    }


                    if(count($kubok_users) > 1)
                    {
                        if($partner_id == $kubok_users[0])
                        {
                            $kb = $kubok_users[1];
                            $kubok_users = $this->deleteSecondValue($kubok_users,$kubok_users[1]);
                        }else{
                            $kb = $kubok_users[0];
                            array_shift($kubok_users);
                        }
                    }else{
                        $kb = 0;
                    }

                    $ball1 = $this->getBall($my_id);
                    $battle[]= array('id' => $my_id, 'price' => $ball1->ball);
                    if($kb != 0)
                    {
                        $ball2 = $this->getBall($kb);
                        $battle[]= array('id' => $kb, 'price' => $ball2->ball);
                    }

                }

            }
        }

        $start_index_day = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $str_day ) ) ));
        $end_index_day = date('Y-m-d',(strtotime ( '+3 day' , strtotime ( $str_day ) ) ));
        $no_sundays = $this->deleteSunday($start_index_day,$end_index_day);
        $start_day = $no_sundays->start_day;
        $end_day = $no_sundays->end_day;
        $bbb = [];

        foreach($algoritm as $al)
        {
            $al_ball = $this->getBall($al);

            $bbb[]= array('id' => $al, 'price' => $al_ball->ball);

        }

        foreach($battle as $b => $vb)
        {
            $bbb[]= array('id' => $vb['id'], 'price' => $vb['price']);
        }

        $no_sundays = $this->battleSaveKubok($bbb,$start_day,$end_day);
    }
    public function getBall($id)
    {
        $ball = DB::table('tg_balls')->where('user_id',$id)->first();
        return $ball;
    }
    public function deleteSecondValue($array,$second)
    {
        $arr = [];
        foreach ($array as $key => $value) {
            if($second != $value)
            {
                $arr[] = $value;
            }
        }
        return $arr;
    }
    public function forSold($users)
    {
        $battle=array();
        $day = 13;
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
        $no_sundays = $this->battleSave($battle,$start_day,$end_day);
    }
    public function battleSaveKubok($battle,$start_day,$end_day)
    {
        // dd($battle);
        if (count($battle)%2 == 0) {
            for ($i=0; $i < count($battle)/2; $i++) {
                $new_battle = new UserBattle([
                    'u1id' => $battle[$i*2]['id'],
                    'u2id' => $battle[($i*2)+1]['id'],
                    'price1' => 0,
                    'price2' => 0,
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
                $new_battle = new UserBattle([
                    'u1id' => $battle[$i*2]['id'],
                    'u2id' => $battle[($i*2)+1]['id'],
                    'price1' => 0,
                    'price2' => 0,
                    'days' => 3,
                    'start_day' => $start_day,
                    'end_day' => $end_day,
                ]);
                $new_battle->save();
            }
            $new_battle = new UserBattle([
                'u1id' => $last['id'],
                'u2id' => $battle[count($battle)-1]['id'],
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
    public function battleSave($battle,$start_day,$end_day)
    {
        if (count($battle)%2 == 0) {
            for ($i=0; $i < count($battle)/2; $i++) {
                $new_battle = new UserBattle([
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
                $new_battle = new UserBattle([
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
            $new_battle = new UserBattle([
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
    public function battleDay($dates)
    {

        $this->battle_date = $dates;
        $this->sold_date = $dates;
        // $this->battle_date = '2023-02-02';
        // $this->sold_date = '2023-02-02';
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
        $all_battles = UserBattle::whereDate('start_day','<=',$this->battle_date)->whereDate('end_day','>=',$this->battle_date)
        ->whereNotIn('u1id',$arr_new)
        ->where('ends',0)->get();


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

                // $u1_ball = $this->existsBall($u1id);
                // $u2_ball = $this->existsBall($u2id);

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

                $this->userBattleDaySave($value,$u1id,$u2id,$price1,$price2,$win,$lose,$this->battle_date);

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
    public function endBattle($dates)
    {
        $end_date = $dates;
        $all_battles = UserBattle::whereDate('end_day',$end_date)->where('ends',1)->get();
        // $all_battles = UserBattle::where('id',130)->get();
        if(count($all_battles))
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
    public function deleteSundayForCalendar($start_index_day,$end_index_day)
    {
        $arrayDate = array();
                $Variable1 = strtotime($start_index_day);
                $Variable2 = strtotime($end_index_day);
                $sum = 0;
                for ($currentDate = $Variable1; $currentDate <= $Variable2;$currentDate += (86400))
                {
                    $Store = date('w', $currentDate);
                    if($Store != 0)
                    {
                        $sum += 1;
                    }
                }
                return $sum;
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
}
