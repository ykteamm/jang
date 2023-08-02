<?php

namespace App\Http\Livewire;

use App\Models\TeamBattleKarma;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Karma extends Component
{

    public $resime = 1;
    public $team_id;
    public $karmahistory;

    protected $listeners = ['for_karma' => 'karma'];

    public function karma()
    {
        
        $this->resime = 2;

        $this->team_id = TeamMember::where('user_id',Auth::id())->first();

        if($this->team_id)
        {
            $this->karmahistory = TeamBattleKarma::with('user')->where('team_id', $this->team_id->team_id)->get();
        }


    }

    public function render()
    {
        return view('livewire.karma');
    }
}
