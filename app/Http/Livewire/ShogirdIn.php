<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShogirdIn extends Component
{
    public $resime = 1;

    public $listeners = [
        'for_shogirdin' => 'shogirdin',
    ];

    public function shogirdin()
    {
        $this->resime = 2;
    }

    public function render()
    {
        return view('livewire.shogird-in');
    }
}
