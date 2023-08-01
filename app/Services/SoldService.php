<?php

namespace App\Services;

use App\Models\FirewallSold;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SoldService
{
    public function firewallSold($inputs)
    {
        $pharm_id = Shift::where('user_id',Auth::user()->id)
        ->whereDate('open_date',Carbon::now())
        ->where('active',1)
        ->value('pharma_id');

        if($pharm_id == 42)
        {
            $in_or_out = 1;
        }else{
            $in_or_out = 2;
        }

        $order_id = DB::table('tg_order')->insertGetId([
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => Auth::user()->id,
            'pharm_id' => $pharm_id,
            // 'full_name' => $fio,
            // 'phone_number' => '+998'.$phone,
        ]);

        foreach ($inputs as $key => $value) {
            if($value !=0 )
            {
                $str = $key;
                $arr = explode("-",$str);
                // $sold = DB::table('tg_productssold')->insertGetId([
                //     'number' => $value,
                //     'created_at' => date('Y-m-d H:i:s'),
                //     'medicine_id' => $arr[0],
                //     'user_id' => Auth::user()->id,
                //     'order_id' => $order_id,
                //     'price_product' => $arr[1],
                //     'is_active' => TRUE,
                //     'pharm_id' => $pharm_id,
                // ]);

                $new = FirewallSold::create([
                    'user_id' => Auth::user()->id,
                    'pharmcy_id' => $pharm_id,
                    'number' => $value,
                    'order_id' => $order_id,
                    'medicine_id' => $arr[0],
                    'price' => $arr[1],
                    'in_or_out' => $in_or_out,
                ]);
            }
        }

        
    }
}
