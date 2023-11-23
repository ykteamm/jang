<?php

namespace App\Http\Livewire;

use App\Models\MegaTurnirTeacher;
use App\Models\MegaTurnirUserBattle;
use App\Models\TurnirGroup;
use App\Models\User;
use App\Services\TurnirService;
use Livewire\Component;

use App\Models\AllSold;
use Illuminate\Support\Facades\DB;
class Turnir extends Component
{
    public $arrays = [];

    public $resime = 1;

    public $user_battle_sold = [];
    protected $listeners = ['tab' => 'changeTab','for_turnir' => 'turnir'];


    public function turnir()
    {

        $this->arrays = [];
        
        $this->resime = 2;

      
        // }

        $arr = [];


        $arr[] = ['name' => 'Umidaxon O','ball' => 15];
        $arr[] = ['name' => 'Dilrabo N','ball' => 15];
        $arr[] = ['name' => 'Elmira B','ball' => 15];
        $arr[] = ['name' => 'Shaxnoza S','ball' => 15];
        $arr[] = ['name' => 'Aziza N','ball' => 15];
        $arr[] = ['name' => 'Qizlarxon T','ball' => 15];
        $arr[] = ['name' => 'Janat B','ball' => 15];
        $arr[] = ['name' => 'Bibinaz A','ball' => 15];
        $arr[] = ['name' => 'Guzal Y jamoasi','ball' => 45];
        $arr[] = ['name' => 'Komola I jamoasi','ball' => 45];
        $arr[] = ['name' => 'G\'olibjon M jamoasi','ball' => 45];
        $arr[] = ['name' => 'Gulzar K jamoasi','ball' => 60];
        $arr[] = ['name' => 'Nilufar M jamoasi','ball' => 90];
        $arr[] = ['name' => 'Shaxnoza X jamoasi','ball' => 60];
        $arr[] = ['name' => 'Hamida P jamoasi','ball' => 30];
        $arr[] = ['name' => 'Nasiba X','ball' => 15];


        $this->arrays = $arr;

        $sums = array_column($this->arrays, 'ball');
        array_multisort($sums, SORT_DESC , $this->arrays);

        $begin = '2023-11-24';
        $end = '2023-11-27';
        $soldd = '2023-11-27';

        $users_battles = MegaTurnirUserBattle::with('user1','user2')
            ->whereDate('begin','=',$begin)
            ->whereDate('end','=',$end)
            ->get();


        foreach ($users_battles as $key => $value) {
            $sold1 = AllSold::where('user_id',$value->user1id)
                ->whereDate('created_at','=',date('Y-m-d'))
                ->sum(DB::raw('number*price_product'));

            $sold2 = AllSold::where('user_id',$value->user2id)
                ->whereDate('created_at','=',date('Y-m-d'))
                ->sum(DB::raw('number*price_product'));

            $user1 = User::find($value->user1id);
            $user2 = User::find($value->user2id);
            $limit = $value->tour;
            $this->user_battle_sold[] = array('limit' => $limit,'user1' => $user1,'user2' => $user2,'sold1' => $sold1,'sold2' => $sold2,'sum' => ($sold1 + $sold2));
        }

        $sums = array_column($this->user_battle_sold, 'sum');
        array_multisort($sums, SORT_DESC , $this->user_battle_sold);

    }

    public function render()
    {
        return view('livewire.turnir');
    }
}
