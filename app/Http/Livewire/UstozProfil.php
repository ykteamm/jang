<?php

namespace App\Http\Livewire;

use App\Models\AllSold;
use App\Models\TeacherUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UstozProfil extends Component
{
    public $ustoz_id;
    public $resime = 1;

    protected $listeners = ['ustozprofillive' => 'ustoz'];

    public function ustoz($id)
    {
        $this->resime = 2;
        
        $this->ustoz_id = $id;
    }

    public function render()
    {
        return view('livewire.ustoz-profil');
    }
}
