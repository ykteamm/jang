<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MoneyComp extends Component
{

    public $resime = 1;

    protected $listeners = ['for_money' => 'money'];
    
    public function money()
    {
        $this->resime = 2;
    }

    public function render()
    {
        return view('livewire.money-comp');
    }
}
