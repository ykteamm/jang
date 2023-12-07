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

        $this->user_battle_sold = [];

        $this->resime = 2;


        // }

        $arr = [];

        #fargona
        $arr[429] = ['name' => 'Umidaxon O','ball' => 5];
        $arr[516] = ['name'=> 'Durdona N' , 'ball'=> 6];
        $arr[505] = ['name' => 'Shahlo H','ball' => 7];
        $arr[512] = ['name' => 'Nozima R','ball' => 8];
        $arr[517] = ['name' => 'Mohira B','ball' => 0]; // oooooooooo
        $arr[523] = ['name' => 'Madina U','ball' => 0]; // oooooooooo
        #fargona

        #toshkent
        $arr[64] = ['name' => 'Dilrabo N','ball' => 10];
        #toshkent

        #qoraqalpoq
        $arr[286] = ['name' => 'Elmira B','ball' => 3];
        $arr[454] = ['name' => 'Janat B','ball' => 6];
        $arr[499] = ['name' => 'Bibinaz A','ball' => 9];
        $arr[468] = ['name' => 'Elmira U','ball' => 0]; // oooooooooo
        $arr[514] = ['name' => 'Nigora T','ball' => 0]; // oooooooooo

        #qoraqalpoq

        #qarshi
        $arr[279] = ['name' => 'Aziza N','ball' => 8];
        $arr[323] = ['name' => 'Qizlarxon T','ball' => 13];
        $arr[491] = ['name' => 'Rushana Y','ball' => 9];
        $arr[508] = ['name' => 'Malika X','ball' => 8];
        $arr[10] = ['name' => 'Saodat S','ball' => 0]; // oooooooooo
        $arr[519] = ['name' => 'Eliza S','ball' => 0]; // oooooooooo
        #qarshi

        #buxoro
        $arr[79] = ['name' => 'Komola I','ball' => 9];
        $arr[502] = ['name' => 'Mavjuda Q','ball' => 4];
        $arr[500] = ['name' => 'Xurshida X','ball' => 9];
        $arr[521] = ['name' => 'Charos J','ball' => 0]; // oooooooooo
        $arr[515] = ['name' => 'Mehrangiz U','ball' => 0]; // oooooooooo
        #buxoro

        #namangan
        $arr[483] = ['name' => 'Gozal A','ball' => 3];
        $arr[495] = ['name' => 'Marjona B','ball' => 15];
        #namangan

        #andijon
        $arr[177] = ['name' => 'Gulzar K','ball' => 9];
        $arr[467] = ['name' => 'Dilnoza G','ball' => 5];
        $arr[5] = ['name' => 'Nilufar M','ball' => 8];
        $arr[437] = ['name' => 'Dilnoza M','ball' => 5];
        $arr[488] = ['name' => 'Shukrona Q','ball' => 5];
        $arr[504] = ['name' => 'Sayfura O','ball' => 8];
        $arr[511] = ['name' => 'Shoira E','ball' => 10];
        $arr[172] = ['name' => 'Nasiba X','ball' => 9];
        $arr[86] = ['name' => 'Shaxnoza S','ball' => 9];
        #andijon

        #samarqand
        $arr[232] = ['name' => 'Shaxnoza X','ball' => 11];
        $arr[469] = ['name' => 'Chehroz O','ball' => 10];
        $arr[466] = ['name' => 'Durdona Y','ball' => 12];
        $arr[503] = ['name' => 'Ruxsora R','ball' => 6];
        #samarqand

        #xorazm
        $arr[344] = ['name' => 'Dilfuza X','ball' => 7];
        $arr[506] = ['name' => 'Aybibi A','ball' => 8];
        #xorazm




        $this->arrays = $arr;


        $sums = array_column($this->arrays, 'ball');
        array_multisort($sums, SORT_DESC , $this->arrays);

        $begin = '2023-12-05';
        $end = '2023-12-07';
        $soldd = '2023-12-07';

        $users_battles = MegaTurnirUserBattle::with('user1','user2')
            ->whereDate('begin','=',$begin)
            ->whereDate('end','=',$end)
            ->get();


        foreach ($users_battles as $key => $value) {
            $sold1 = AllSold::where('user_id',$value->user1id)
                ->whereDate('created_at','=',date('2023-12-06'))
                ->sum(DB::raw('number*price_product'));

            $sold2 = AllSold::where('user_id',$value->user2id)
                ->whereDate('created_at','=',date('2023-12-06'))
                ->sum(DB::raw('number*price_product'));

            $ids1 = $value->user1id;
            $ids2 = $value->user2id;

            $user1 = User::find($value->user1id);
            $user2 = User::find($value->user2id);
            $limit = $value->tour;
            $this->user_battle_sold[] = array(
                'b1'=>$arr[$ids1]['ball']??20,
                'b2'=>$arr[$ids2]['ball']??20,
                'id1'=>$ids1, 'id2'=> $ids2,
                'limit' => $limit,
                'user1' => $user1,'user2' => $user2,
                'sold1' => $sold1,'sold2' => $sold2,
                'sum' => ($sold1 + $sold2));
        }


        $sums = array_column($this->user_battle_sold, 'sum');
        array_multisort($sums, SORT_DESC , $this->user_battle_sold);

    }

    public function render()
    {
        return view('livewire.turnir');
    }
}
