<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Liga extends Component
{
    public $resime = 1;
    protected $listeners = ['for_liga' => 'liga'];

    public function liga()
    {
        $this->resime = 2;
    }
    public function render()
    {
        return view('livewire.liga');
    }
}
