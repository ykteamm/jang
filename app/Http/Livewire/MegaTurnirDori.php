<?php

namespace App\Http\Livewire;

use App\Models\AllSold;
use App\Models\MegaTurnirTeacher;
use App\Models\MegaTurnirUserBattle;
use App\Models\TurnirGroup;
use App\Models\User;
use App\Services\TurnirService;
use Illuminate\Support\Facades\DB;
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

        $teachers = MegaTurnirTeacher::with('teacher_shogird')->get();



        $user1 = MegaTurnirUserBattle::pluck('user1id')->toArray();
        $user2 = MegaTurnirUserBattle::pluck('user2id')->toArray();

        $ids = array_merge($user1,$user2);


        foreach ($teachers as $key => $value) {
            $idf = [];
            foreach ($value->teacher_shogird as $j => $k) {
                $idf[] = $k->shogird_id;
            }

            $idf[] = $value->teacher_id;

            $sold1 = AllSold::whereIn('user_id',$idf)
                ->whereDate('created_at','>=','2023-10-19')
                ->whereDate('created_at','<=','2023-10-26')
                ->where('medicine_id',29)
                ->sum('number');

            $user = User::find($value->teacher_id);
            $name = $user->first_name.' '.substr($user->last_name,0,1).' jamoasi';
            $this->arrays[] = array('name' => $name,'ball' => $sold1/count($idf));
        }

        $users = User::whereIn('id',$ids)->whereNotIn('id',$idf)->get();


        foreach ($users as $key => $value) {

            $name = $value->first_name.' '.substr($value->last_name,0,1);

            $sold1 = AllSold::where('user_id',$value->id)
                ->whereDate('created_at','>=','2023-10-19')
                ->whereDate('created_at','<=','2023-10-26')
                ->where('medicine_id',29)
                ->sum('number');

            $this->arrays[] = array('name' => $name,'ball' => $sold1);
        }

        $sums = array_column($this->arrays, 'ball');
        array_multisort($sums, SORT_DESC , $this->arrays);

    }

    public function render()
    {
        return view('livewire.mega-turnir-dori');
    }
}
