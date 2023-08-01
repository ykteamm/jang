<?php

namespace App\Http\Livewire;

use App\Models\UserBattle;
use App\Services\UserProfilService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Profile extends Component
{
    public $user;
    public $kubok;
    public $liga_name;
    public $liga_img;
    public $king_sold;
    public $win_battle;
    public $history_liga;
    public $sold_count;
    public $prodaja_levels = [
        [
            'level' => 1,
            'value' => 5
        ],
        [
            'level' => 2,
            'value' => 10
        ],
        [
            'level' => 3,
            'value' => 50
        ],
    ];
    public $battle_levels = [
        [
            'level' => 1,
            'value' => 5
        ],
        [
            'level' => 2,
            'value' => 10
        ],
        [
            'level' => 3,
            'value' => 50
        ],
    ];
    public $ksb_levels = [
        [
            'level' => 1,
            'value' => 5
        ],
        [
            'level' => 2,
            'value' => 10
        ],
        [
            'level' => 3,
            'value' => 50
        ],
    ];
    public $prodaja_level;
    public $battle_level;
    public $ksb_level;
    public $resime = 1;


    protected $listeners = ['for_profil' => 'profil'];

    public function profil()
    {
        $this->resime = 2;
        $id = Auth::id();
        $this->kubok = DB::table('tg_balls')->where('user_id',$id)->value('ball');

        $this->liga_name = myLiga($id)->name;
        $this->liga_img = myLiga($id)->image;

            $king_sold = DB::table('tg_king_sold')->selectRaw('count(tg_king_sold.id) as count')
            ->where('tg_king_sold.admin_check',1)->where('tg_king_sold.status',1)
            ->where('tg_user.id',$id)
            ->join('tg_order','tg_order.id','tg_king_sold.order_id')->join('tg_user','tg_user.id','tg_order.user_id')
            ->get();
            if($king_sold[0]->count == null){$count = 0;}else{$count = $king_sold[0]->count;}

            $king_sold05 = DB::table('tg_king_sold')
            ->selectRaw('count(tg_king_sold.id) as count')
            ->where('tg_king_sold.admin_check',1)->where('tg_king_sold.status',2)
            ->where('tg_user.id',$id)
            ->join('tg_order','tg_order.id','tg_king_sold.order_id')->join('tg_user','tg_user.id','tg_order.user_id')
            ->get();
            if($king_sold05[0]->count == null){$count05 = 0;}else{$count05 = $king_sold05[0]->count;}

        $this->king_sold = $count + $count05/2;

        $this->win_battle = UserBattle::where('win', $id)->count();
        
        $services = new UserProfilService;
        
        $this->history_liga = $services->historyLiga($id);
        $this->sold_count = $services->productSold($id);
        $this->user = $services->userData($id);
        // $this->user = User::find($id);
        $allprodaja = DB::table('tg_productssold')
        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
        ->where('tg_productssold.user_id', $id)
        ->first()->allprice ?? 0;
        $this->prodaja($allprodaja);
        $this->battle($this->win_battle);
        $this->ksb($this->king_sold);
    }

    public function prodaja($sum)
    {
        $mln = 1000000;
        if($sum >= 5 * $mln && $sum < 10 * $mln) {
            $this->prodaja_level = 1;
        } else if($sum >= 10 * $mln && $sum < 50 * $mln) {
            $this->prodaja_level = 2;
        } else if($sum > 50 * $mln) {
            $this->prodaja_level = 3;
        } else {
            $this->prodaja_level = 0;
        }
    }
    public function battle($count)
    {
        if($count >= 5 && $count < 10) {
            $this->battle_level = 1;
        } else if($count >= 10 && $count < 50) {
            $this->battle_level = 2;
        } else if($count > 50) {
            $this->battle_level = 3;
        } else {
            $this->battle_level = 0;
        }
    }
    public function ksb($count)
    {
        if($count >= 5 && $count < 10) {
            $this->ksb_level = 1;
        } else if($count >= 10 && $count < 50) {
            $this->ksb_level = 2;
        } else if ($count > 50){
            $this->ksb_level = 3;
        } else {
            $this->ksb_level = 0;
        }
    }
    

    

    public function render()
    {
        return view('livewire.profile');
    }
}
