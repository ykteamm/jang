<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Shogird extends Component
{
    public $resime = 1;

    public $listeners = [
        'for_shogird' => 'shogird',
    ];

    public function shogird()
    {
        $this->resime = 2;
    }
    
    public function render()
    {
        return view('livewire.shogird');
    }
}
