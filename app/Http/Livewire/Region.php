<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Region extends Component
{
    public $date = 'Oy';
    public $regions;
    public $bestRegions = [];
    public $listeners = ['changeRegTime' => 'changeTime','for_region' => 'region'];

    public function region() 
    {
        $this->bestRegions = $this->bestRegs($this->date);
        $this->regions = $this->getRegions($this->date);
    }
    public function render()
    {
        return view('livewire.region');
    }

    public function changeTime($time)
    {
        $this->bestRegions = $this->bestRegs($time);
        $this->regions = $this->getRegions($time);
        $this->date = $time;
    }

    public function getRegions($date)
    {
        if($date == 'Oy') {
            $start = date("Y-m-d");
            $end = date("Y-m-d");
        } else {
            $start = Carbon::parse()->startOfMonth()->format("Y-m-d");
            $end = Carbon::parse()->endOfMonth()->format("Y-m-d");
        }
        return DB::select("SELECT 
            rg.id, rg.name,
            SUM(CASE WHEN us.status = 1 OR us.status = 0 THEN 1 ELSE 0 END) AS count,
            (SELECT 
                COALESCE(SUM(pr.number * pr.price_product), 0) 
                FROM tg_productssold AS pr 
                LEFT JOIN tg_user AS u ON u.id = pr.user_id
                WHERE u.region_id = rg.id
                AND DATE(pr.created_at) BETWEEN ? AND ?
            ) AS allprice
            FROM tg_region AS rg
            LEFT JOIN tg_user AS us ON  us.region_id = rg.id
            GROUP BY rg.id
            ORDER BY allprice DESC
        ", [$start, $end]);
    }

    public function bestRegs($date)
    {
        if($date == 'Oy') {
            $start = date("Y-m-d");
            $end = date("Y-m-d");
        } else {
            $start = Carbon::parse()->startOfMonth()->format("Y-m-d");
            $end = Carbon::parse()->endOfMonth()->format("Y-m-d");
        }
        $regs = DB::select("SELECT 
            rg.id, rg.name,
            COUNT(rg.id) AS count,
            (SELECT 
                COALESCE(SUM(pr.number * pr.price_product), 0) 
                FROM tg_productssold AS pr 
                LEFT JOIN tg_user AS u ON u.id = pr.user_id
                WHERE u.region_id = rg.id
                AND DATE(pr.created_at) BETWEEN ? AND ?
            ) AS allprice
            FROM tg_region AS rg
            LEFT JOIN tg_user AS us ON  us.region_id = rg.id
            GROUP BY rg.id
            ORDER BY allprice DESC
            LIMIT 3
        ", [$start, $end]);
        foreach ($regs as $reg) {
            $reg->{'users'} = DB::select("SELECT 
                u.id, u.image_url,u.first_name, u.last_name,
                COALESCE(SUM(CASE WHEN DATE(pr.created_at) BETWEEN ? AND ? THEN pr.number * pr.price_product ELSE 0 END), 0) AS allprice
                FROM tg_productssold AS pr 
                LEFT JOIN tg_user AS u ON u.id = pr.user_id
                WHERE u.region_id = ?
                GROUP BY u.id
                ORDER BY allprice DESC
                LIMIT 3
            ", [$start, $end, $reg->id]);
        }
        return $regs;
    }
}
