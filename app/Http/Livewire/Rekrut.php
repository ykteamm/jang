<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Rekrut extends Component
{
    public $resime = 1;

    public $listeners = [
        'for_rekrut' => 'rekrut',
    ];

    public function rekrut()
    {
        $this->resime = 2;
    }

    public function render()
    {
        return view('livewire.rekrut');
    }
}
