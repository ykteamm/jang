<?php

namespace App\Http\Livewire;

use App\Services\RegionProfilService;
use Livewire\Component;

class RegionProfil extends Component
{
    public $reg;
    public $kubok;
    public $king_sold;
    public $fact;
    public $grade;
    public $users;
    public $resime = 1;

    protected $listeners = ['regionlive' => 'getRegion'];

    public function getRegion($id)
    {
        $this->resime = 2;

        $service = new RegionProfilService;

        $this->reg = $service->region($id);
        $this->kubok = $service->allKubok($id);
        $this->king_sold = $service->allKingSold($id);
        $this->fact = $service->allFact($id);
        $items = $service->regionUsers($id);

        $this->users = $items->users;
        $this->grade = $items->grades;
    }

    public function render()
    {

        return view('livewire.region-profil');
    }
}
