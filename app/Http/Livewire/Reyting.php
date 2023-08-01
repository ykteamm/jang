<?php

namespace App\Http\Livewire;

use App\Models\ElchiBall;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reyting extends Component
{
    public $ligas;
    public $solds;
    public $date = 'Kun';
    public $liga;
    public $kubok;

    public $listeners = [
        'changeLiga' => 'change_Liga',
        'changeRegTime2' => 'change_RegTime',
        'for_reyting' => 'reyting'
    ];


    public function reyting()
    {
        $userin = $this->userOrProv();
        $this->solds = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id,tg_user.first_name,tg_user.last_name,tg_region.name as t,tg_user.image_url')
            ->whereDate('tg_productssold.created_at', date('Y-m-d'))
            ->join('tg_user', 'tg_user.id', 'tg_productssold.user_id')
            ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
            ->where('tg_user.id', '!=', 72)
            ->whereIn('tg_user.id', $userin)
            ->orderBy('allprice', 'DESC')
            ->groupBy('tg_user.id', 'tg_user.first_name', 'tg_user.last_name', 't')->get();

        $this->liga = 'all';

        $this->kubok = $this->kubokReyting();
    }

    public function kubokReyting()
    {
        if(Auth::user()->rm == 0)
        {
            if(Auth::user()->specialty_id == 1)
            {
                $userin = User::where('specialty_id',1)->pluck('id')->toArray();
            }else{
                $userin = User::where('specialty_id',9)->pluck('id')->toArray();
            }
        }else{
            $userin = User::pluck('id')->toArray();
        }



        $startday = date('Y-m-d',(strtotime ( '-30 day' , strtotime ( date('Y-m-d') ) ) ));

        $new_user_in = [];

        foreach ($userin as $key => $value) {

            $summa = DB::table('tg_productssold')
                        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                        ->whereDate('tg_productssold.created_at','>=',$startday)
                        ->where('tg_productssold.user_id','=',$value)
                        ->get()[0]->allprice;
            if($summa != null)
            {
                $new_user_in[] = $value;
            }
        }

        $kuboks = ElchiBall::with('user')
        ->whereIn('user_id',$new_user_in)
        ->orderBy('ball','DESC')->get();

        return $kuboks;
    }

    public function calculateLigaUsers($start, $end, $ligaId)
    {
        $isAll = $ligaId == 'all';
        $ligaId = $isAll ? 0 : $ligaId;
        return DB::select("SELECT
            us.id, us.first_name, us.last_name,
            (SELECT name FROM tg_region AS rg WHERE rg.id = us.region_id) AS t,
            (
                SELECT COALESCE(SUM(pr.price_product * pr.number), 0) FROM tg_productssold AS pr
                WHERE pr.user_id = us.id AND DATE(pr.created_at) BETWEEN ? AND ?
            ) AS allprice
            FROM tg_user AS us
            LEFT JOIN user_ligas AS ul ON CASE WHEN ? THEN ul.user_id = us.id END
            WHERE CASE WHEN ? THEN ul.liga_id = ? END
        ", [$start, $end, !$isAll, !$isAll, $ligaId]);
    }

    public function change_Liga($l, $time)
    {
        $monthStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $monthEndDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $userin = $this->userOrProv();

        if ($time == 'Kun') {  
            if ($l == 'all') {
                $summa = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id,tg_user.first_name,tg_user.last_name,tg_region.name as t,tg_user.image_url')
                    ->whereDate('tg_productssold.created_at', date('Y-m-d'))
                    ->join('tg_user', 'tg_user.id', 'tg_productssold.user_id')
                    ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
                    ->where('tg_user.id', '!=', 72)
                    ->whereIn('tg_user.id', $userin)
                    ->orderBy('allprice', 'DESC')
                    ->groupBy('tg_user.id', 'tg_user.first_name', 'tg_user.last_name', 't')->get();
            } else {
                $summa = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id,tg_user.first_name,tg_user.last_name,tg_region.name as t,tg_user.image_url')
                    ->whereDate('tg_productssold.created_at', date('Y-m-d'))
                    ->join('tg_user', 'tg_user.id', 'tg_productssold.user_id')
                    ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
                    ->join('user_ligas', 'user_ligas.user_id', 'tg_user.id')
                    ->where('tg_user.id', '!=', 72)
                    ->whereIn('tg_user.id', $userin)
                    ->where('user_ligas.liga_id', $l)
                    ->orderBy('allprice', 'DESC')
                    ->groupBy('tg_user.id', 'tg_user.first_name', 'tg_user.last_name', 't')->get();
            }
        } else {
            if ($l == 'all') {
                $summa = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id,tg_user.first_name,tg_user.last_name,tg_region.name as t,tg_user.image_url')
                    ->whereDate('tg_productssold.created_at', '>=', $monthStartDate)
                    ->whereDate('tg_productssold.created_at', '<=', $monthEndDate)
                    ->join('tg_user', 'tg_user.id', 'tg_productssold.user_id')
                    ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
                    ->where('tg_user.id', '!=', 72)
                    ->whereIn('tg_user.id', $userin)
                    ->orderBy('allprice', 'DESC')
                    ->groupBy('tg_user.id', 'tg_user.first_name', 'tg_user.last_name', 't')->get();
            } else {
                $summa = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id,tg_user.first_name,tg_user.last_name,tg_region.name as t,tg_user.image_url')
                    ->whereDate('tg_productssold.created_at', '>=', $monthStartDate)
                    ->whereDate('tg_productssold.created_at', '<=', $monthEndDate)
                    ->join('tg_user', 'tg_user.id', 'tg_productssold.user_id')
                    ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
                    ->join('user_ligas', 'user_ligas.user_id', 'tg_user.id')
                    ->where('tg_user.id', '!=', 72)
                    ->whereIn('tg_user.id', $userin)
                    ->where('user_ligas.liga_id', $l)
                    ->orderBy('allprice', 'DESC')
                    ->groupBy('tg_user.id', 'tg_user.first_name', 'tg_user.last_name', 't')->get();
            }
        }

        $this->liga = $l;
        $this->solds = $summa;
    }

    public function change_RegTime($time, $l)
    {
        $monthStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $monthEndDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        $userin = $this->userOrProv();

        if ($time == 'Kun') {
            if ($l == 'all') {
                $summa = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id,tg_user.first_name,tg_user.last_name,tg_region.name as t,tg_user.image_url')
                    ->whereDate('tg_productssold.created_at', date('Y-m-d'))
                    ->join('tg_user', 'tg_user.id', 'tg_productssold.user_id')
                    ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
                    ->where('tg_user.id', '!=', 72)
                    ->whereIn('tg_user.id', $userin)
                    ->orderBy('allprice', 'DESC')
                    ->groupBy('tg_user.id', 'tg_user.first_name', 'tg_user.last_name', 't')->get();
            } else {
                $summa = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id,tg_user.first_name,tg_user.last_name,tg_region.name as t,tg_user.image_url')
                    ->whereDate('tg_productssold.created_at', date('Y-m-d'))
                    ->join('tg_user', 'tg_user.id', 'tg_productssold.user_id')
                    ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
                    ->join('user_ligas', 'user_ligas.user_id', 'tg_user.id')
                    ->where('tg_user.id', '!=', 72)
                    ->whereIn('tg_user.id', $userin)
                    ->where('user_ligas.liga_id', $l)
                    ->orderBy('allprice', 'DESC')
                    ->groupBy('tg_user.id', 'tg_user.first_name', 'tg_user.last_name', 't')->get();
            }
            $this->date = 'Kun';
        } else {
            if ($l == 'all') {
                $summa = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id,tg_user.first_name,tg_user.last_name,tg_region.name as t,tg_user.image_url')
                    ->whereDate('tg_productssold.created_at', '>=', $monthStartDate)
                    ->whereDate('tg_productssold.created_at', '<=', $monthEndDate)
                    ->join('tg_user', 'tg_user.id', 'tg_productssold.user_id')
                    ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
                    ->where('tg_user.id', '!=', 72)
                    ->whereIn('tg_user.id', $userin)
                    ->orderBy('allprice', 'DESC')
                    ->groupBy('tg_user.id', 'tg_user.first_name', 'tg_user.last_name', 't')->get();
            } else {
                $summa = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id,tg_user.first_name,tg_user.last_name,tg_region.name as t,tg_user.image_url')
                    ->whereDate('tg_productssold.created_at', '>=', $monthStartDate)
                    ->whereDate('tg_productssold.created_at', '<=', $monthEndDate)
                    ->join('tg_user', 'tg_user.id', 'tg_productssold.user_id')
                    ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
                    ->join('user_ligas', 'user_ligas.user_id', 'tg_user.id')
                    ->where('tg_user.id', '!=', 72)
                    ->whereIn('tg_user.id', $userin)
                    ->where('user_ligas.liga_id', $l)
                    ->orderBy('allprice', 'DESC')
                    ->groupBy('tg_user.id', 'tg_user.first_name', 'tg_user.last_name', 't')->get();
            }
            $this->date = 'Oy';
        }

        $this->liga = $l;
        $this->solds = $summa;
    }

    public function userOrProv()
    {
        if (Auth::user()->rm == 0) {
            if (Auth::user()->specialty_id == 1) {
                $userin = User::where('specialty_id', 1)->pluck('id')->toArray();
            } else {
                $userin = User::where('specialty_id', 9)->pluck('id')->toArray();
            }
        } else {
            $userin = User::pluck('id')->toArray();
        }
        return $userin;
    }
    public function render()
    {
        $this->ligas = DB::table('ligas')->where('plan', '>', 0)->orderBy('plan', 'DESC')->get();

        return view('livewire.reyting');
    }
}
