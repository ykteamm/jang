<?php
namespace App\Services;

use App\Models\SmsBattles;
use App\Models\UserBattle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SmsBattleService
{
    public function sms()
    {
        $isset = $this->isset();
        if($isset)
        {
            if($isset[0]->u1id == Auth::id())
            {
                $myid = $isset[0]->u1id;
                $partnerid = $isset[0]->u2id;
            }else{
                $myid = $isset[0]->u2id;
                $partnerid = $isset[0]->u1id;
            }
            $smsid = $isset[0]->sms;
            $get_battle = UserBattle::where('id',$isset[0]->battle_id)->select('start_day','end_day')->get();

            $soldis = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->whereDate('tg_productssold.created_at','=',date('Y-m-d',$currentDate))
            ->where('tg_productssold.user_id',Auth::id())
            ->get()[0]->allprice;
        }
        // dd($get_battle);
    }
    public function isset()
    {
        $my_id = Auth::id();
        $my_battle = SmsBattles::where(function($query) use ($my_id){
            $query->where('u1id',$my_id)
                ->orWhere('u2id',$my_id);
            })->get();
        // dd($my_battle);
        if(count($my_battle) > 0)
        {
            return $my_battle;
        }else{
            $my_battle = UserBattle::where(function($query) use ($my_id){
                $query->where('u1id',$my_id)
                    ->orWhere('u2id',$my_id);
                })->where('ends',0)->get();
            if(count($my_battle) > 0)
            {
                $sms = new SmsBattles([
                    'u1id' => $my_battle[0]->u1id,
                    'u2id' => $my_battle[0]->u2id,
                    'battle_id' => $my_battle[0]->id,
                    'sms' => 0,
                    'bot' => $my_battle[0]->bot,
                ]);
                $sms->save();
                return $sms;
            }
        }
        
                
    }
}