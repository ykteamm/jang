<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Shogird extends Component
{
    public $resime = 1;
    public $pharm;
    public $pul_data;
    public $start_week;
    public $end_week;
    public $month_name;
    public $week_smena;

    public $listeners = [
        'for_shogird' => 'shogird',
    ];

    public function shogird()
    {
        $this->resime = 2;

        $this->pharm = DB::table('tg_pharmacy')->get();


        $ustoz = DB::table('tg_jamoalar')->where('teacher_id', Auth::id())->pluck('user_id')->toArray();

        $user = User::whereIn('id', $ustoz)->whereIn('status', [0,1,2,4])->get();

        $ustoz_id = DB::table('tg_jamoalar')->where('teacher_id', Auth::id())->first();
        $ids = $ustoz_id->teacher_id;
        $teacher_user = User::where('id', $ids)->first();

// Prepend $teacher_user to the beginning of $user array
        $user->prepend($teacher_user);

        $data_id = $user->pluck('id');
//        return $data;


        $monday = date("Y-m-d", strtotime('monday this week'));
        $sunday = date("Y-m-d", strtotime('sunday this week'));

        $this->week_smena = DB::table('tg_shift')
            ->whereIn('user_id',$data_id)
            ->whereDate('created_at', '>=', $monday)
            ->whereDate('created_at', '<=', $sunday)
            ->get();



        $this->start_week = Carbon::now()->startOfWeek()->locale('uz_UZ')->isoFormat('D MMMM');
        $this->end_week =  Carbon::now()->endOfWeek()->locale('uz_UZ')->isoFormat('D MMMM');
        $this->month_name = Carbon::now()->locale('uz_UZ')->monthName;

        $hafta = DB::table('tg_productssold')
            ->selectRaw('SUM(number * price_product) as total_savdo')
            ->whereIn('user_id', $data_id)
            ->whereDate('created_at', '>=', $monday)
            ->whereDate('created_at', '<=', $sunday)
            ->first();

        $first_day_month = date("Y-m-01");
        $end_day_month = date("Y-m-t");

//        $this->month = $first_day_month
        $oy = DB::table('tg_productssold')
            ->selectRaw('SUM(number * price_product) as total_savdo')
            ->whereIn('user_id', $data_id)
            ->whereDate('created_at', '>=', $first_day_month)
            ->whereDate('created_at', '<=', $end_day_month)
            ->first();

        $pul = [
            'hafta'=>$hafta->total_savdo,
            'oy'=>$oy->total_savdo,
        ];
        $this->pul_data = $pul;
    }

    public function render()
    {
        return view('livewire.shogird');
    }
}
