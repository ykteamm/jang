<?php
namespace App\Services;

use App\Models\BonusKingSoldForRegion;
use App\Models\BonusKingSoldForUser;
use App\Models\KingSoldBattle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KingSoldBattleService
{
    public function endsBattle($date)
    {
        $end_date = $date;
        
        $win_bonus = 1;
        $lose_bonus = 1;
        $all_ksb = KingSoldBattle::whereDate('end_date',$end_date)->where('start',1)->get();
        foreach ($all_ksb as $key => $value) {
            $offer_count = getKSCount($value->offer_uid,$value->start_date,$value->end_date);
            $accept_count = getKSCount($value->accept_uid,$value->start_date,$value->end_date);
            
            if($offer_count > $accept_count)
            {
                $update = KingSoldBattle::where('id',$value->id)->update([
                    'offer_count' => $offer_count,
                    'accept_count' => $accept_count,
                    'win' => $value->offer_uid,
                    'lose' => $value->accept_uid,
                ]);

                $new_bonus_user = new BonusKingSoldForUser([
                    'user_id' => $value->offer_uid,
                    'bonus' => $win_bonus,
                    'end_date' => $value->end_date
                ]);
                $new_bonus_user->save();

                $exists = BonusKingSoldForRegion::whereDate('end_date',$value->end_date)
                ->where('region_id',getUser($value->accept_uid)->region_id)->get();
                if(count($exists) > 0)
                {
                    BonusKingSoldForRegion::whereDate('end_date',$value->end_date)
                    ->where('region_id',getUser($value->accept_uid)->region_id)->update([
                        'bonus' => $exists[0]->bonus + $lose_bonus,
                    ]);
                }else{
                    $new_bonus_user = new BonusKingSoldForRegion([
                        'region_id' => getUser($value->accept_uid)->region_id,
                        'bonus' => $lose_bonus,
                        'end_date' => $value->end_date
                    ]);
                    $new_bonus_user->save();
                }
                

            }elseif($offer_count < $accept_count)
            {
                $update = KingSoldBattle::where('id',$value->id)->update([
                    'offer_count' => $offer_count,
                    'accept_count' => $accept_count,
                    'win' => $value->accept_uid,
                    'lose' => $value->offer_uid,
                ]);
                $new_bonus_user = new BonusKingSoldForUser([
                    'user_id' => $value->accept_uid,
                    'bonus' => $win_bonus,
                    'end_date' => $value->end_date
                ]);
                $new_bonus_user->save();

                $exists = BonusKingSoldForRegion::whereDate('end_date',$value->end_date)
                ->where('region_id',getUser($value->offer_uid)->region_id)->get();
                if(count($exists) > 0)
                {
                    BonusKingSoldForRegion::whereDate('end_date',$value->end_date)
                    ->where('region_id',getUser($value->offer_uid)->region_id)->update([
                        'bonus' => $exists[0]->bonus + $lose_bonus,
                    ]);
                }else{
                    $new_bonus_user = new BonusKingSoldForRegion([
                        'region_id' => getUser($value->offer_uid)->region_id,
                        'bonus' => $lose_bonus,
                        'end_date' => $value->end_date
                    ]);
                    $new_bonus_user->save();
                }

            }else{
                $update = KingSoldBattle::where('id',$value->id)->update([
                    'offer_count' => $offer_count,
                    'accept_count' => $accept_count,
                ]);
            }
        }
    }
}