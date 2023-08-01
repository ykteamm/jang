<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HistoryCrystal extends Component
{
    
    public $resime = 1;
    public $crystalhistory;

    protected $listeners = ['for_history_crystal' => 'history_crystal'];

    public function history_crystal()
    {
        $this->resime = 2;
        $this->crystalhistory = DB::table('crystal_users')->where('user_id', Auth::id())->get();

    }

    public function render()
    {
        return view('livewire.history-crystal');
    }
}
