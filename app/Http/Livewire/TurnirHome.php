<?php

namespace App\Http\Livewire;
use App\Models\AllSold;
use App\Models\MegaTurnirTeamBattle;
use App\Models\MegaTurnirUserBattle;
use App\Services\TurnirService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TurnirHome extends Component
{
    public $turnir;
    public $tour;
    public $tourTitle;
    public $team1images =[];
    public $team2images =[];
    public $team1names =[];
    public $team2names =[];
    public $team1summa = 0;
    public $team2summa = 0;
    public $team1ksb = 0;
    public $team2ksb = 0;

    public function mount()
    {
        $service = new TurnirService;
        $service->getUserProfile(Auth::id());
        // $this->tour = $service->tour->tour;
        $this->tourTitle = '9 Tur';
       
        $this->team2images = 'https://wallpapercave.com/wp/wp5504863.jpg';
        
        

        $userId = Auth::id();
        $this->tour = 9;
        $begin = '2023-11-10';
        $end = '2023-11-15';
        $soldd = '2023-11-15';

        $users_battles = MegaTurnirUserBattle::with('user1','user2')
        ->where('tour',$this->tour)
        ->where('ends',0)
        ->whereDate('begin','=',$begin)
        ->whereDate('end','=',$end)
        ->where(function($query) use ($userId){
            $query->where('user1id',$userId)
            ->orWhere('user2id',$userId);
        })
        ->first();

        if($users_battles)
        {
            $this->turnir = true;
            
        }else{
            $users_battles = MegaTurnirTeamBattle::with('user1','user2')
            ->where('tour',$this->tour)
            ->where('ends',0)
            ->whereDate('begin','=',$begin)
            ->whereDate('end','=',$end)
            ->where(function($query) use ($userId){
                $query->where('user1id',$userId)
                ->orWhere('user2id',$userId);
            })
            ->first();

            if($users_battles)
            {
                $this->turnir = true;
            }else{
                $this->turnir = false;
            }
        }

        // $this->team1names = 'dasd';
        // dd($this->turnir);
        if($this->turnir)
        {

            $this->team1names = $users_battles->user1;
            $this->team2names = $users_battles->user2;

            $this->team1images = $users_battles->user1->image_url;
            $this->team2images = $users_battles->user2->image_url;


            // $this->team1summa = DB::table('tg_productssold')->where('id',$users_battles->user1->id)
            //     ->whereDate('created_at','>=','2023-10-16')
            //     ->whereDate('created_at','<=','2023-10-18')
            //     ->sum(DB::raw('price_product*number'));

            // $this->team2summa = DB::table('tg_productssold')->where('id',$users_battles->user2->id)
            //     ->whereDate('created_at','>=','2023-10-16')
            //     ->whereDate('created_at','<=','2023-10-18')
            //     ->sum(DB::raw('price_product*number'));
            
            $this->team1summa = AllSold::where('user_id',$users_battles->user1->id)
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=',$end)
                ->sum(DB::raw('price_product*number'));

            $this->team2summa = AllSold::where('user_id',$users_battles->user2->id)
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=',$end)
                ->sum(DB::raw('price_product*number'));

        }

        // dd($this->turnir);
        // dd($this->team1names);
        // dd($this->team1summa);
        // $sum1 = DB::table('tg_productssold')
        // ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
        // ->whereBetween('tg_productssold.created_at', ['2023-04-10', '2023-04-18'])
        // ->where('tg_productssold.user_id', 33)
        // ->first()->allprice;

        // $sum2 = DB::table('tg_productssold')
        // ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
        // ->whereBetween('tg_productssold.created_at', ['2023-04-10', '2023-04-18'])
        // ->where('tg_productssold.user_id', 264)
        // ->first()->allprice;

        // $k1 = DB::table('tg_king_sold')
        // ->selectRaw('SUM(CASE WHEN tg_king_sold.status = 1 THEN 1 ELSE 0.5 END) AS count')
        // ->leftJoin('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
        // ->whereBetween('tg_king_sold.created_at', ['2023-04-10', '2023-04-18'])
        // ->where('tg_order.user_id', 33)
        // ->first()->count;

        // $k2 = DB::table('tg_king_sold')
        // ->selectRaw('SUM(CASE WHEN tg_king_sold.status = 1 THEN 1 ELSE 0.5 END) AS count')
        // ->leftJoin('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
        // ->whereBetween('tg_king_sold.created_at', ['2023-04-10', '2023-04-18'])
        // ->where('tg_order.user_id', 267)
        // ->first()->count;

        // dd($this->team1summa, $sum1, $sum2);
        // dd($this->team1images);
    } 


    public function render()
    {
        return view('livewire.turnir-home');
    }
}
