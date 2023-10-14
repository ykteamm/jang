<?php

namespace App\Http\Livewire;

use App\Models\MegaTurnirTeacher;
use App\Models\MegaTurnirUserBattle;
use App\Models\TurnirGroup;
use App\Models\User;
use App\Services\TurnirService;
use Livewire\Component;

class MegaTurnirDori extends Component
{
    public $arrays = [];

    public $resime = 1;

    // protected $listeners = ['tab' => 'changeTab','for_turnir' => 'turnir'];
    

    public function mount()
    {

        $this->arrays = [];
        
        $this->resime = 2;

        $teachers = MegaTurnirTeacher::all();

        $user1 = MegaTurnirUserBattle::pluck('user1id')->toArray();
        $user2 = MegaTurnirUserBattle::pluck('user2id')->toArray();

        $ids = array_merge($user1,$user2);

        $users = User::whereIn('id',$ids)->get();

        foreach ($teachers as $key => $value) {
            $user = User::find($value->teacher_id);
            $name = $user->first_name.' '.substr($user->last_name,0,1).' jamoasi';
            $this->arrays[] = array('name' => $name,'ball' => 0);
        }

        foreach ($users as $key => $value) {

            $name = $value->first_name.' '.substr($value->last_name,0,1);

            $this->arrays[] = array('name' => $name,'ball' => 0);
        }

        $sums = array_column($this->arrays, 'name');
        array_multisort($sums, SORT_DESC , $this->arrays);

    }

    public function render()
    {
        return view('livewire.mega-turnir-dori');
    }
}
