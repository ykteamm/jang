<?php

namespace App\Http\Livewire;

use App\Services\MoneyService;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;
use Livewire\Component;

class Money extends Component
{
    public $dat = [];
    public $arr = [];
    public $date = 'Bugun';

    protected $listeners = ['teams' => 'teamsF'];
    
    public function mount()
    {
        $timeServices = new MoneyService;
        $time = $timeServices->week();
        $this->dat = $timeServices->day($this->date);
        $this->arr[] = $time[0];
        $this->arr[] = $time[1];
    }

    public function teamsF($d)
    {
        $timeServices = new MoneyService;
        $this->dat = $timeServices->day(date('Y-m-d',$d));
    }
    public function render()
    {

        
        return view('livewire.money');
    }
}
