<?php

namespace App\Http\Livewire;

use App\Models\OuterMarket;
use Livewire\Component;

class Market extends Component
{
    public $outerMarket;
    public $resime = 1;

    protected $listeners = ['for_market' => 'market'];

    public function market()
    {
        $this->resime = 2;
        $this->outerMarket = OuterMarket::all();
    }
    
    public function render()
    {
        return view('livewire.market');
    }
}
