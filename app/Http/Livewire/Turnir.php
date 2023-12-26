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
    public $user_battle_sold2 = [];
    protected $listeners = ['tab' => 'changeTab','for_turnir' => 'turnir'];


    public function turnir()
    {

        $this->arrays = [];

        $this->user_battle_sold = [];
        $this->user_battle_sold2 = [];

        $this->resime = 2;


        // }

        $arr = [];

        #fargona
        $arr[429] = ['name' => 'Umidaxon O','ball' => 0]; // chiqdi
        $arr[516] = ['name'=> 'Durdona N' , 'ball'=> 0]; // chiqdi2
        $arr[505] = ['name' => 'Shahlo H','ball' => 0];  // chiqdi2
        $arr[512] = ['name' => 'Nozima R','ball' => 1];
        #fargona

        #toshkent
        $arr[64] = ['name' => 'Dilrabo N','ball' => 0]; //chiqdi4
        #toshkent

        #qoraqalpoq
        $arr[286] = ['name' => 'Elmira B','ball' => 0]; //chiqdi
        $arr[454] = ['name' => 'Janat B','ball' => 0]; //chiqdi
        $arr[499] = ['name' => 'Bibinaz A','ball' => 0]; //chiqdi

        #qoraqalpoq

        #qarshi
        $arr[279] = ['name' => 'Aziza N','ball' => 0]; //chiqdi4
        $arr[323] = ['name' => 'Qizlarxon T','ball' => 11];
        $arr[491] = ['name' => 'Rushana Y','ball' => 2];
        $arr[508] = ['name' => 'Malika X','ball' => 2];
        #qarshi

        #buxoro
        $arr[79] = ['name' => 'Komola I','ball' => 0]; //chiqdi6
        $arr[502] = ['name' => 'Mavjuda Q','ball' => 0]; //chiqdi
        $arr[500] = ['name' => 'Xurshida X','ball' => 0]; //chiqdi5
        #buxoro

        #namangan
        $arr[483] = ['name' => 'Gozal A','ball' => 0];  //chiqdi
        $arr[495] = ['name' => 'Marjona B','ball' => 9];
        #namangan

        #andijon
        $arr[177] = ['name' => 'Gulzar K','ball' => 0]; //chiqdi5
        $arr[467] = ['name' => 'Dilnoza G','ball' => 0]; //chiqdi
        $arr[5] = ['name' => 'Nilufar M','ball' => 0]; //chiqdi3
        $arr[437] = ['name' => 'Dilnoza M','ball' => 0]; // chiqdi
        $arr[488] = ['name' => 'Shukrona Q','ball' => 0]; //chiqdi3
        $arr[504] = ['name' => 'Sayfura O','ball' => 0]; //chiqdi4
        $arr[511] = ['name' => 'Shoira E','ball' => 0]; //chiqdi3
        $arr[172] = ['name' => 'Nasiba X','ball' => 0]; //chiqdi3
        $arr[86] = ['name' => 'Shaxnoza S','ball' => 0]; //chiqdi6
        #andijon

        #samarqand
        $arr[232] = ['name' => 'Shaxnoza X','ball' => 1];
        $arr[469] = ['name' => 'Chehroz O','ball' => 0]; //chiqdi6
        $arr[466] = ['name' => 'Durdona Y','ball' => 0]; //chiqdi4
        $arr[503] = ['name' => 'Ruxsora R','ball' => 0]; //chiqdi
        #samarqand

        #xorazm
        $arr[344] = ['name' => 'Dilfuza X','ball' => 0]; //chiqdi6
        $arr[506] = ['name' => 'Aybibi A','ball' => 0]; //chiqdi4
        #xorazm




        $this->arrays = $arr;


        $sums = array_column($this->arrays, 'ball');
        array_multisort($sums, SORT_DESC , $this->arrays);

        $date_mini = megaMini();
        $begin = $date_mini['begin'];
        $end = $date_mini['end'];
        $sold = $date_mini['sold'];

        $users_battles = MegaTurnirUserBattle::with('user1','user2')
            ->whereDate('begin','=',$begin)
            ->whereDate('end','=',$end)
            ->get();


        foreach ($users_battles as $key => $value) {
            $sold1 = AllSold::where('user_id',$value->user1id)
                ->whereDate('created_at','=',$sold)
                ->sum(DB::raw('number*price_product'));

            $sold2 = AllSold::where('user_id',$value->user2id)
                ->whereDate('created_at','=',$sold)
                ->sum(DB::raw('number*price_product'));

                $sold11 = AllSold::where('user_id',$value->user1id)
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=',$end)
                ->sum(DB::raw('number*price_product'));

            $sold22 = AllSold::where('user_id',$value->user2id)
            ->whereDate('created_at','>=',$begin)
            ->whereDate('created_at','<=',$end)
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
                'sold11' => $sold11,'sold22' => $sold22,
                'sum' => ($sold1 + $sold2));
        }


        $sums = array_column($this->user_battle_sold, 'sum');
        array_multisort($sums, SORT_DESC , $this->user_battle_sold);

        $date_mini = megaTurnir();
        $begin = $date_mini['begin'];
        $end = $date_mini['end'];
        $sold = $date_mini['sold'];

        $ard = [];
        $ard[] = ['user1' => 323, 'user2' =>232, 'limit' => 1000];

        foreach ($ard as $key => $value) {
            $sold1 = AllSold::where('user_id',$value['user1'])
                ->whereDate('created_at','=',$sold)
                ->sum(DB::raw('number*price_product'));

            $sold2 = AllSold::where('user_id',$value['user2'])
                ->whereDate('created_at','=',$sold)
                ->sum(DB::raw('number*price_product'));

                $sold11 = AllSold::where('user_id',$value['user1'])
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=',$end)
                ->sum(DB::raw('number*price_product'));

            $sold22 = AllSold::where('user_id',$value['user2'])
            ->whereDate('created_at','>=',$begin)
            ->whereDate('created_at','<=',$end)
                ->sum(DB::raw('number*price_product'));

            $ids1 = $value['user1'];
            $ids2 = $value['user2'];

            $user1 = User::find($value['user1']);
            $user2 = User::find($value['user2']);
            $this->user_battle_sold2[] = array(
                'id1'=>$ids1, 'id2'=> $ids2,
                'limit' => $value['limit'],
                'user1' => $user1,'user2' => $user2,
                'sold1' => $sold1,'sold2' => $sold2,
                'sold11' => $sold11,'sold22' => $sold22,
                'sum' => ($sold1 + $sold2));
        }


        $sums = array_column($this->user_battle_sold2, 'sum');
        array_multisort($sums, SORT_DESC , $this->user_battle_sold2);

    }

    public function render()
    {
        return view('livewire.turnir');
    }
}
