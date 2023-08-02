<?php

namespace App\Http\Livewire;

use App\Services\TeamBattleServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TeamBattleRound extends Component
{

    public $resime = 1;
    public $myTeamBattle;
    protected $listeners = ['for_teambattleround' => 'teambattleround'];


    public function teambattleround()
    {
        $this->resime = 2;
        $new = new TeamBattleServices(Auth::id());
        $this->myTeamBattle = $new->getMyTeamBattle();

    }

    public function render()
    {
        return view('livewire.team-battle-round');
    }
}
