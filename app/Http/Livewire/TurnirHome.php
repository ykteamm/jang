<?php

namespace App\Http\Livewire;
use App\Services\TurnirService;
use Illuminate\Support\Facades\Auth;
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
        $this->tour = $service->tour->tour;
        $this->tourTitle = $service->tour->title;
        $this->turnir = $service->turnirbattle;
        $this->team1images = $service->team1images();
        $this->team2images = $service->team2images();
        $this->team1names = $service->team1names();
        $this->team2names = $service->team2names();
        $this->team1summa = $service->team1summa();
        $this->team2summa = $service->team2summa();
        $this->team1ksb = $service->team1ksb();
        $this->team2ksb = $service->team2ksb();
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
