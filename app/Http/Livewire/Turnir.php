<?php

namespace App\Http\Livewire;

use App\Models\MegaTurnirTeacher;
use App\Models\MegaTurnirUserBattle;
use App\Models\TurnirGroup;
use App\Models\User;
use App\Services\TurnirService;
use Livewire\Component;

class Turnir extends Component
{
    public $arrays = [];

    public $resime = 1;

    protected $listeners = ['tab' => 'changeTab','for_turnir' => 'turnir'];


    public function turnir()
    {

        $this->arrays = [];
        
        $this->resime = 2;

        // $teachers = MegaTurnirTeacher::all();

        // $user1 = MegaTurnirUserBattle::pluck('user1id')->toArray();
        // $user2 = MegaTurnirUserBattle::pluck('user2id')->toArray();

        // $ids = array_merge($user1,$user2);

        // $users = User::whereIn('id',$ids)->get();

        // foreach ($teachers as $key => $value) {
        //     $user = User::find($value->teacher_id);
        //     $name = $user->first_name.' '.substr($user->last_name,0,1).' jamoasi';
        //     $this->arrays[] = array('name' => $name,'ball' => 0);
        // }

        // foreach ($users as $key => $value) {

        //     $name = $value->first_name.' '.substr($value->last_name,0,1);

        //     $this->arrays[] = array('name' => $name,'ball' => 0);
        // }

        $arr = [];


        $arr[] = ['name' => 'Umidaxon O','ball' => 18];
        $arr[] = ['name' => 'Dirabo N','ball' => 8];
        $arr[] = ['name' => 'Elmira B','ball' => 9];
        $arr[] = ['name' => 'Shaxnoza S','ball' => 10];
        $arr[] = ['name' => 'Aziza N','ball' => 12];
        $arr[] = ['name' => 'Qizlarxon T','ball' => 17];
        $arr[] = ['name' => 'Zebo T','ball' => 0];
        $arr[] = ['name' => 'Nigoraxon U','ball' => 9];
        $arr[] = ['name' => 'Elmira U','ball' => 6];
        $arr[] = ['name' => 'Janat B','ball' => 12];
        $arr[] = ['name' => 'Oysanam M','ball' => 0];
        $arr[] = ['name' => 'Aysuluw B','ball' => 0];
        $arr[] = ['name' => 'Feruza S','ball' => 0];
        $arr[] = ['name' => 'Saodat S','ball' => 3];
        $arr[] = ['name' => 'Gulnora N','ball' => 6];


        $arr[] = ['name' => 'Guzal Y jamoasi','ball' => 10];
        $arr[] = ['name' => 'Komola I jamoasi','ball' => 11];
        $arr[] = ['name' => 'Nargiza K jamoasi','ball' => 11];
        $arr[] = ['name' => 'Marxabo G jamoasi','ball' => 6];
        $arr[] = ['name' => 'Gulzar K jamoasi','ball' => 10];
        $arr[] = ['name' => 'Nilufar M jamoasi','ball' => 10];
        $arr[] = ['name' => 'Shaxnoza X jamoasi','ball' => 9];


        $arr[] = ['name' => 'Nargiza B jamoasi','ball' => 11];


        // $arr[] = ['name' => 'Dilfuza X','ball' => 0];

        $this->arrays = $arr;

        $sums = array_column($this->arrays, 'ball');
        array_multisort($sums, SORT_DESC , $this->arrays);

    }

    public function render()
    {
        return view('livewire.turnir');
    }
}
