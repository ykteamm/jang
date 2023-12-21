<?php

namespace App\Http\Livewire;
use App\Models\AllSold;
use App\Models\User;
use App\Models\MegaTurnirTeamBattle;
use App\Models\MegaTurnirUserBattle;
use App\Services\MakeImageService;
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
    public $winImage;

    public function mount()
    {
        $service = new TurnirService;
        $service->getUserProfile(Auth::id());

        $this->team2images = 'https://wallpapercave.com/wp/wp5504863.jpg';



        $userId = Auth::id();

        $date_mini = megaMini();
        $begin = $date_mini['begin'];
        $end = $date_mini['end'];
        $sold = $date_mini['sold'];
        

        $users_battles = MegaTurnirUserBattle::with('user1','user2')
        ->whereDate('begin','=',$begin)
        ->whereDate('end','=',$end)
        ->where(function($query) use ($userId){
            $query->where('user1id',$userId)
            ->orWhere('user2id',$userId);
        })
        ->first();

        if($users_battles)
        {
            $last_id = $users_battles->id;

            $last_battles = MegaTurnirUserBattle::with('user1','user2')
            ->where('id','<',$last_id)
            ->where(function($query) use ($userId){
                $query->where('user1id',$userId)
                ->orWhere('user2id',$userId);
            })
            ->orderBy('id','DESC')
            ->first();

            $image = new MakeImageService;

            $this->winImage = $image->make($last_battles);
        }else{
            $this->winImage = null;
        }

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

        if($this->turnir)
        {

            $this->tourTitle = '2 kun';

            $this->team1names = $users_battles->user1;
            $this->team2names = $users_battles->user2;

            $this->team1images = $users_battles->user1->image_url;
            $this->team2images = $users_battles->user2->image_url;


            $this->team1summa = AllSold::where('user_id',$users_battles->user1->id)
                ->whereDate('created_at','=',$sold)
                ->sum(DB::raw('price_product*number'));

            $this->team2summa = AllSold::where('user_id',$users_battles->user2->id)
                ->whereDate('created_at','=',$sold)
                ->sum(DB::raw('price_product*number'));

            $this->team1ksb = AllSold::where('user_id',$users_battles->user1->id)
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=',$end)
                ->sum(DB::raw('price_product*number'));

            $this->team2ksb = AllSold::where('user_id',$users_battles->user2->id)
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=',$end)
                ->sum(DB::raw('price_product*number'));

        }

        $ard = [323,495];
        $ard2 = [512,232];

        $userId = Auth::id();
        $date_mini = megaTurnir();
        $begin = $date_mini['begin'];
        $end = $date_mini['end'];
        $sold = $date_mini['sold'];

        if(in_array($userId,$ard))
        {
            $this->turnir = true;
            $this->tourTitle = 'Limit 7 mln';

            $this->team1names = User::find($ard[0]);
            $this->team2names = User::find($ard[1]);

            $this->team1images = User::find($ard[0])->image_url;
            $this->team2images = User::find($ard[1])->image_url;


            $this->team1summa = AllSold::where('user_id',$ard[0])
                ->whereDate('created_at','=',$sold)
                ->sum(DB::raw('price_product*number'));

            $this->team2summa = AllSold::where('user_id',$ard[1])
                ->whereDate('created_at','=',$sold)
                ->sum(DB::raw('price_product*number'));

            $this->team1ksb = AllSold::where('user_id',$ard[0])
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=',$end)
                ->sum(DB::raw('price_product*number'));

            $this->team2ksb = AllSold::where('user_id',$ard[1])
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=',$end)
                ->sum(DB::raw('price_product*number'));
        }

        if(in_array($userId,$ard2))
        {
            $this->turnir = true;
            $this->tourTitle = 'Limit 7 mln';

            $this->team1names = User::find($ard2[0]);
            $this->team2names = User::find($ard2[1]);

            $this->team1images = User::find($ard2[0])->image_url;
            $this->team2images = User::find($ard2[1])->image_url;


            $this->team1summa = AllSold::where('user_id',$ard2[0])
                ->whereDate('created_at','=',$sold)
                ->sum(DB::raw('price_product*number'));

            $this->team2summa = AllSold::where('user_id',$ard2[1])
                ->whereDate('created_at','=',$sold)
                ->sum(DB::raw('price_product*number'));

            $this->team1ksb = AllSold::where('user_id',$ard2[0])
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=',$end)
                ->sum(DB::raw('price_product*number'));

            $this->team2ksb = AllSold::where('user_id',$ard2[1])
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=',$end)
                ->sum(DB::raw('price_product*number'));
        }
    }


    public function render()
    {
        return view('livewire.turnir-home');
    }
}
