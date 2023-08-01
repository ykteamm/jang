<?php

namespace App\Http\Controllers;

use App\Models\UserBattle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function sharqKingSold()
    {
        $king_sold = DB::table('tg_king_sold')
            ->selectRaw('count(tg_king_sold.id) as count')
            ->addSelect(DB::raw('DATE(tg_king_sold.created_at) as date'))
            ->where('tg_king_sold.admin_check',1)
            ->where('tg_region.side',2)
            ->whereDate('tg_king_sold.created_at','>=','2023-02-04')
            ->whereDate('tg_king_sold.created_at','<=',date('Y-m-d'))
            ->join('tg_order','tg_order.id','tg_king_sold.order_id')
            ->join('tg_user','tg_user.id','tg_order.user_id')
            ->join('tg_region','tg_region.id','tg_user.region_id')
            ->orderBy('date','ASC')
            ->groupBy('date')
            ->get();

        return $king_sold;
    }
    public function garbKingSold()
    {
        $king_sold = DB::table('tg_king_sold')
            ->selectRaw('count(tg_king_sold.id) as count')
            ->addSelect(DB::raw('DATE(tg_king_sold.created_at) as date'))
            ->where('tg_king_sold.admin_check',1)
            ->where('tg_region.side',1)
            ->whereDate('tg_king_sold.created_at','>=','2023-02-04')
            ->whereDate('tg_king_sold.created_at','<=',date('Y-m-d'))
            ->join('tg_order','tg_order.id','tg_king_sold.order_id')
            ->join('tg_user','tg_user.id','tg_order.user_id')
            ->join('tg_region','tg_region.id','tg_user.region_id')
            ->orderBy('date','ASC')
            ->groupBy('date')
            ->get();

        return $king_sold;
    }
    public function dateKingSold($date)
    {
        $king_sold = DB::table('tg_king_sold')
            ->selectRaw('count(tg_king_sold.id) as count,tg_user.first_name,tg_user.last_name')
            ->where('tg_king_sold.admin_check',1)
            ->whereDate('tg_king_sold.created_at','=',$date)
            ->join('tg_order','tg_order.id','tg_king_sold.order_id')
            ->join('tg_user','tg_user.id','tg_order.user_id')
            ->orderBy('count','DESC')
            ->groupBy('tg_user.first_name','tg_user.last_name')
            ->get();

        return $king_sold;
    }
     public function history()
     {
        $my_id = 33;
        $all_battle = UserBattle::with('u1ids','u2ids','battle_elchi','battle_elchi.u1ids','battle_elchi.u2ids')
                ->where(function($query) use ($my_id){
                            $query->where('u1id',$my_id)
                            ->orWhere('u2id',$my_id);
                        })->orderBy('id','DESC')->get();
          foreach ($all_battle as $key => $value) {
              if($value->u2id == $my_id && $value->bot ==1)
              {
                  unset($all_battle[$key]);
              }
          }
          return $all_battle; 
     }
}
