<?php

namespace App\Services;

use App\Models\ElchiElexir;
use App\Models\ElexirExercise;
use App\Models\ElexirForExercise;
use App\Models\ElexirHistory;
use App\Models\Medicine;
use App\Models\PromoProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExerciseServices
{
    
    public function  getExercise($id)
    {
        $king_services = new HelperServices;
        $get_date = $king_services->kingSoldDay('Shu hafta');

        $exists = ElexirExercise::whereDate('start_day',$get_date->date_begin)
        ->whereDate('end_day',$get_date->date_end)->where('user_id',$id)->get();

        if(count($exists) == 0)
        {
            $price = $this->getLastMonthSold($id);
            $koef = $this->getKoef($price,$id);
    
            $promos = $this->getPromo();
    
    
            $start = new Carbon('first day of last month');
            $end = new Carbon('last day of last month');
            $plan_product = [];
            $sdf2 = 0;
            foreach ($promos as $key => $p) {
                $count = DB::table('tg_productssold')
                            ->selectRaw('SUM(tg_productssold.number) as count')
                            ->whereDate('tg_productssold.created_at','>=',$start)
                            ->whereDate('tg_productssold.created_at','<=',$end)
                            ->where('tg_productssold.user_id','=',$id)
                            ->where('tg_productssold.medicine_id','=',$p)
                            ->first();  
                $price_p = DB::table('tg_prices')->where('medicine_id',$p)->where('shablon_id',3)->value('price');
            
                $name = Medicine::find($p);
                $plan_p = round(($this->getDefaultSum($price)*1000000)/(count($promos)*$price_p)/4);
                if ($plan_p == 0) {
                    $plan_p = 1;
                }
                $make_p= $this->getProductSoldByDate($id,$p);
                $bonus = floor(($this->getDefaultElexir($price)/count($promos))/4);
                // $plan_product[] = array('make' => $make_p,'plan' => $plan_p,'bonus' => $bonus,'name' => $name->id);
                
                $new = new ElexirExercise([
                    'user_id' => $id,
                    'medicine_id' => $name->id,
                    'elexir' => $bonus,
                    'plan' => $plan_p,
                    'success' => 0,
                    'start_day' => $get_date->date_begin,
                    'end_day' => $get_date->date_end,
                ]);
                $new->save();
            }
        }
        
        $exercises = ElexirExercise::whereDate('start_day',$get_date->date_begin)
        ->whereDate('end_day',$get_date->date_end)->where('user_id',$id)->get();
        $plan_product = [];

        foreach ($exercises as $key => $value) {
            $make_p= $this->getProductSoldByDate($value->user_id,$value->medicine_id);
            $name = Medicine::find($value->medicine_id);
            if($make_p >= $value->plan && $value->success == 0)
            {
                $exercises = ElexirExercise::where('id',$value->id)
                ->update([
                    'success' => 1 
                ]);

                $this->addElexir($value->user_id,$value->elexir);

                $new_history = new ElexirHistory([
                    'user_id' => $value->user_id,
                    'elexir' => $value->elexir,
                    'reason' => 'Topshiriq uchun',
                    'start_day' => $get_date->date_begin,
                    'end_day' => $get_date->date_end,
                ]);
        
                $new_history->save();
            }

            $plan_product[] = array('make' => $make_p,'plan' => $value->plan,'bonus' => $value->elexir,'name' => $name->name);
            
        }

        return $plan_product;
        // dd($plan_product);
    }
    public function addElexir($id,$elexir)
    {
        
        $elexir_count = ElchiElexir::where('user_id',$id)->get();

        if(count($elexir_count) > 0)
        {
            ElchiElexir::where('user_id',$id)->update([
                'elexir' => $elexir_count[0]->elexir + $elexir,
            ]);
        }else{
            $new = DB::table('tg_elchi_elexir')->insert([
                'user_id' => $id,
                'elexir' => $elexir,
            ]);
        }
    }
    public function getProductSoldByDate($user_id,$product_id)
    {
        $king_services = new HelperServices;
        $get_date = $king_services->kingSoldDay('Shu hafta');
        
        $price = DB::table('tg_productssold')
                        ->selectRaw('SUM(tg_productssold.number) as count')
                        ->whereDate('tg_productssold.created_at','>=',$get_date->date_begin)
                        ->whereDate('tg_productssold.created_at','<=',$get_date->date_end)
                        ->where('tg_productssold.user_id','=',$user_id)
                        ->where('tg_productssold.medicine_id',$product_id)
                        ->get()[0]->count;  
            if($price == null)
            {
                $price = 0;
            }
        return $price;
    }

    public function getKoef($price,$id)
    {
        $promo_price = $this->getLastMonthPromoSold($id);
        $for_battle_sum = $this->getDefaultSum($price);
        
        if($for_battle_sum == 0)
        {
            $koef = 1;
        }else{
            if($promo_price == 0)
            {
                $koef = 1;
            }else{
                $koef = ($for_battle_sum*1000000)/$promo_price;
            }
        }
        return $koef;
    }
    public function getDefaultElexir($price)
    {
        if($price == 0)
        {
            $for_battle_el = ElexirForExercise::orderBy('id','ASC')->limit(1)->value('elexir');
        }else{
            $for_battle = ElexirForExercise::where('plan','<=',floor($price/1000000))->orderBy('plan','DESC')->first();
            if($for_battle == null)
            {
                $for_battle_el = ElexirForExercise::orderBy('id','ASC')->limit(1)->value('elexir');
            }else{
                $for_battle_el = $for_battle->elexir;
            }
        }
        return $for_battle_el;
    }
    public function getDefaultSum($price)
    {
        $for_battle = ElexirForExercise::where('plan','<=',floor($price/1000000))->orderBy('plan','DESC')->first();
        if($for_battle == null)
        {
            $for_battle_sum = ElexirForExercise::orderByDesc('id')->limit(1)->value('promo');
        }else{
            $for_battle_sum = $for_battle->promo;
        }
        return $for_battle_sum;
    }
    public function getLastMonthPromoSold($id)
    {
        $promo = $this->getPromo();
        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');
        $price = DB::table('tg_productssold')
                        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                        ->whereDate('tg_productssold.created_at','>=',$start)
                        ->whereDate('tg_productssold.created_at','<=',$end)
                        ->where('tg_productssold.user_id','=',$id)
                        ->whereIn('tg_productssold.medicine_id',$promo)
                        ->get()[0]->allprice;  
            if($price == null)
            {
                $price = 0;
            }
        return $price;
    }
    public function getLastMonthSold($id)
    {
        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');
        $price = DB::table('tg_productssold')
                        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                        ->whereDate('tg_productssold.created_at','>=',$start)
                        ->whereDate('tg_productssold.created_at','<=',$end)
                        ->where('tg_productssold.user_id','=',$id)
                        ->join('tg_user','tg_user.id','tg_productssold.user_id')
                        ->get()[0]->allprice;  
            if($price == null)
            {
                $price = 0;
            }
        return $price;
    }

    public function getPromo()
    {
        $promoArray = PromoProduct::pluck('medicine_id')->toArray();
        return $promoArray;
    }

}