<?php

namespace App\Services;

use App\Items\ShiftItems;
use App\Models\PharmacyUser;
use App\Models\Shift;
use App\Models\ShiftCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ShiftService
{
    public function shift()
    {
        $shifts = Shift::with('pharmacy')->where('user_id',Auth::user()->id)
        ->whereDate('open_date',Carbon::now())
        ->where('active')->get();
        dd($shifts);
        if($shifts == 0)
        {
            $shift_code = ShiftCode::whereDate('created_at',Carbon::now())->count();
            if($shift_code == 0)
            {
                $new_code = createShiftCode(1);
            }
        }else{
            $shift_code = ShiftCode::whereDate('created_at',Carbon::now())->where('number',$shifts+1)->count();
            if($shift_code == 0)
            {
                $new_code = createShiftCode($shifts+1);
            }
        }

        
        if($shifts == 0)
        {
            $shift_code = ShiftCode::whereDate('created_at',Carbon::now())->where('number',1)->first();

        }else{
            $shift_code = ShiftCode::whereDate('created_at',Carbon::now())->where('number',$shifts+1)->first();
        }

        if($shifts <= 1)
        {
            $shift_close_code = ShiftCode::whereDate('created_at',Carbon::now())->where('number',1)->first();

        }else{
            $shift_close_code = ShiftCode::whereDate('created_at',Carbon::now())->where('number',$shifts)->first();
        }
        $pharmacy = PharmacyUser::with('pharmacy')->where('user_id',Auth::user()->id)->get();
        $shifts = Shift::with('pharmacy')->where('user_id',Auth::user()->id)
        ->whereDate('open_date',Carbon::now())
        ->where('active',1)
        ->get();

        $item=new ShiftItems();
        $item->shifts=$shifts;
        $item->pharmacy=$pharmacy;
        $item->shift_code=$shift_code;
        $item->shift_close_code=$shift_close_code;
        
        return $item;
    }
}