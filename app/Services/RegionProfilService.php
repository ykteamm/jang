<?php

namespace App\Services;

use App\Items\RegionProfilItems;
use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegionProfilService
{
    
    public function region($id)
    {
        $region = Region::find($id);
        return $region;
    }

    public function regionUsers($id)
    {
        $weekStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $weekEndDate = Carbon::now()->endOfMonth()->format('Y-m-d');

        $users = User::where('region_id',$id)
        ->whereIn('id',$this->userin())
        ->pluck('id')->toArray();



        $facts = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as sold,tg_user.id,tg_user.first_name,tg_user.last_name,tg_user.image_url')
            ->whereDate('tg_productssold.created_at','>=',$weekStartDate)
            ->whereDate('tg_productssold.created_at','<=',$weekEndDate)
            ->whereIn('tg_productssold.user_id',$users)
            ->join('tg_user','tg_user.id','tg_productssold.user_id')
            ->orderBy('sold','DESC')
            ->groupBy('tg_user.id')
            ->get();

        $grade = [];

        foreach ($facts as $key => $value) {
            $date_joined = User::find($value->id)->date_joined;

            $earlier = new DateTime(date('Y-m-d',strtotime($date_joined)));
            $later = new DateTime(date('Y-m-d'));

            $pos_diff = $earlier->diff($later)->format("%r%a");
            $grade[$value->id] = $pos_diff;

        }

        $items = new RegionProfilItems;

        $items->users = $facts;
        $items->grades = $grade;

        return $items;
    }

    public function allFact($id)
    {
        $weekStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $weekEndDate = Carbon::now()->endOfMonth()->format('Y-m-d');

        $users = User::where('region_id',$id)
        ->whereIn('id',$this->userin())
        ->pluck('id')->toArray();
        $facts = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as number')
            ->whereDate('created_at','>=',$weekStartDate)
            ->whereDate('created_at','<=',$weekEndDate)
            ->whereIn('user_id',$users)
            ->get()[0]->number;
        if($facts == null)
        {
            $facts = 0;
        }
        return $facts;
    }

    public function allKubok($id)
    {
        $users = User::where('region_id',$id)
        ->whereIn('id',$this->userin())
        ->pluck('id')->toArray();
        $kuboks = DB::table('tg_balls')
            ->selectRaw('SUM(tg_balls.ball) as number')
            ->whereIn('user_id',$users)
            ->get()[0]->number;
        if($kuboks == null)
        {
            $kuboks = 0;
        }
        return $kuboks;
    }

    public function allKingSold($id)
    {
        $weekStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $weekEndDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $king_sold = DB::table('tg_king_sold')
            ->selectRaw('count(tg_king_sold.id) as count')
            ->where('tg_king_sold.admin_check',1)
            ->where('tg_king_sold.status',1)
            ->whereDate('tg_king_sold.created_at','>=',$weekStartDate)
            ->whereDate('tg_king_sold.created_at','<=',$weekEndDate)
            ->where('tg_region.id',$id)
            ->whereIn('tg_user.id',$this->userin())

            ->join('tg_order','tg_order.id','tg_king_sold.order_id')
            ->join('tg_user','tg_user.id','tg_order.user_id')
            ->join('tg_region','tg_region.id','tg_user.region_id')
            ->get();
            if($king_sold[0]->count == null)
            {
                $count = 0;
            }else{
                $count = $king_sold[0]->count;
            }

            $king_sold05 = DB::table('tg_king_sold')
            ->selectRaw('count(tg_king_sold.id) as count')
            ->where('tg_king_sold.admin_check',1)
            ->where('tg_king_sold.status',2)
            ->whereDate('tg_king_sold.created_at','>=',$weekStartDate)
            ->whereDate('tg_king_sold.created_at','<=',$weekEndDate)
            ->where('tg_region.id',$id)
            ->whereIn('tg_user.id',$this->userin())
            ->join('tg_order','tg_order.id','tg_king_sold.order_id')
            ->join('tg_user','tg_user.id','tg_order.user_id')
            ->join('tg_region','tg_region.id','tg_user.region_id')
            ->get();
            if($king_sold05[0]->count == null)
            {
                $count05 = 0;
            }else{
                $count05 = $king_sold05[0]->count;
            }
            $all_count = $count + $count05/2;
        return $all_count;
    }

    public function userin()
    {
        // if(Auth::user()->rm == 0)
        // {
        //     if(Auth::user()->specialty_id == 1)
        //     {
        //         $userin = User::where('specialty_id',1)->pluck('id')->toArray();
        //     }else{
        //         $userin = User::where('specialty_id',9)->pluck('id')->toArray();
        //     }
        // }else{
            $userin = User::pluck('id')->toArray();
        // }
        return $userin;
    }
}