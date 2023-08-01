<?php

namespace App\Http\Livewire;

use App\Services\TurnirService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TurnirButton extends Component
{
    public $turnir;
    public $team1names =[];
    public $point = 0;
    public function mount()
    {
        $service = new TurnirService;
        $service->getUserProfile(Auth::id());
        $this->turnir = $service->turnirbattle;
        if($service->turnirbattle) {
            $this->team1names = $service->team1names();
            $this->point = $service->getTotalPoint();
        }
        // dd($service);

    }
    public function render()
    {
        return view('livewire.turnir-button');
    }
}
