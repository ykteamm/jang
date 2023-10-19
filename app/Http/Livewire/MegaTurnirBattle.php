<?php

namespace App\Http\Livewire;

use App\Models\AllSold;
use App\Models\MegaTurnirTeacher;
use App\Models\MegaTurnirTeacherStudent;
use App\Models\MegaTurnirTeamBattle;
use App\Models\MegaTurnirUserBattle;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MegaTurnirBattle extends Component
{
    public $user_battle_sold = [];
    public $team_battle_sold = [];

    public $resime = 2;

    protected $listeners = ['tab' => 'changeTab','for_megaturnir' => 'megaturnir'];

    public function mount()
    {
        // $this->resime = 2;

        $tour = 2;
        $begin = '2023-10-16';
        $end = '2023-10-19';

        $users_battles = MegaTurnirUserBattle::with('user1','user2')
            ->where('tour',$tour)
            ->where('ends',0)
            // ->whereDate('begin','<=',date('Y-m-d'))
            // ->whereDate('end','>=',date('Y-m-d'))
            ->whereDate('begin','=',$begin)
            ->whereDate('end','<=',$end)
            ->get();


        foreach ($users_battles as $key => $value) {
            $sold1 = AllSold::where('user_id',$value->user1id)
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=','2023-10-18')
                ->sum(DB::raw('number*price_product'));

            $sold2 = AllSold::where('user_id',$value->user2id)
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=','2023-10-18')
                ->sum(DB::raw('number*price_product'));
            $user1 = $value->user1;
            $user2 = $value->user2;
            $this->user_battle_sold[] = array('user1' => $user1,'user2' => $user2,'sold1' => $sold1,'sold2' => $sold2,'sum' => ($sold1 + $sold2));
        }

        $sums = array_column($this->user_battle_sold, 'sum');
        array_multisort($sums, SORT_DESC , $this->user_battle_sold);

        // dd($this->user_battle_sold);

        $team_battles = MegaTurnirTeamBattle::with('user1','user2')
            ->where('tour',$tour)
            ->where('ends',0)
            ->whereDate('begin','=',$begin)
            ->whereDate('end','<=',$end)
            ->get();

        $teacher_id = MegaTurnirTeacher::pluck('teacher_id')->toArray();
        $shogird_id = MegaTurnirTeacherStudent::pluck('shogird_id')->toArray();
        
        foreach ($team_battles as $key => $value) {

            $sold1 = AllSold::where('user_id',$value->user1id)
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=','2023-10-18')
                ->sum(DB::raw('number*price_product'));

            $sold2 = AllSold::where('user_id',$value->user2id)
                ->whereDate('created_at','>=',$begin)
                ->whereDate('created_at','<=','2023-10-18')
                ->sum(DB::raw('number*price_product'));

            $user1 = $value->user1;
            $user2 = $value->user2;

            if(in_array($value->user1id,$teacher_id))
            {
                $teacher1 = User::find($value->user1id);
            }

            if(in_array($value->user1id,$shogird_id))
            {
                $sh = MegaTurnirTeacherStudent::where('shogird_id',$value->user1id)->first();

                $teach = MegaTurnirTeacher::find($sh->teacher_id);

                $teacher1 = User::find($teach->teacher_id);
            }

            if(in_array($value->user2id,$teacher_id))
            {
                $teacher2 = User::find($value->user2id);
            }

            if(in_array($value->user2id,$shogird_id))
            {
                $sh = MegaTurnirTeacherStudent::where('shogird_id',$value->user2id)->first();

                $teach = MegaTurnirTeacher::find($sh->teacher_id);

                $teacher2 = User::find($teach->teacher_id);
            }


            $this->team_battle_sold[] = array('user1' => $user1,'teacher1' => $teacher1,'user2' => $user2,'teacher2' => $teacher2,'sold1' => $sold1,'sold2' => $sold2,'sum' => ($sold1 + $sold2));
        }

        $sums = array_column($this->team_battle_sold, 'sum');
        array_multisort($sums, SORT_DESC , $this->team_battle_sold);

    }

    public function render()
    {
        return view('livewire.mega-turnir-battle');
    }
}
