<?php

namespace App\Http\Livewire;

use App\Services\HelperServices;
use Livewire\Component;

class KingSoldCheck extends Component
{

    public $checks;
    protected $listeners = ['kingCheck' => 'viewKingCheck'];


    public function viewKingCheck($id,$b,$e)
    {
        $timeServices = new HelperServices;

        $begin = date('Y-m-d',$b);
        $end = date('Y-m-d',$e);
        $this->checks = $timeServices->viewCheck($id,$begin,$end);
    }

    public function render()
    {
        return view('livewire.king-sold-check');
    }
}
