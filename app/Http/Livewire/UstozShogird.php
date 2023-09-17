<?php

namespace App\Http\Livewire;

use App\Models\AllSold;
use App\Models\TeacherUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UstozShogird extends Component
{

    public $ustozs = [];

    public $resimeu = 1;

    public $listeners = [
        'for_ustoz_stajer' => 'ustoz'
    ];

    public function ustoz()
    {
        $this->resimeu = 2;

    }

    public function render()
    {
        return view('livewire.ustoz-shogird');
    }
}
