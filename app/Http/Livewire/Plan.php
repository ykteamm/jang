<?php

namespace App\Http\Livewire;

use App\Services\HelperServices;
use App\Services\PlanFactService;
use App\Services\PlanServices;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Plan extends Component
{
    private PlanFactService $planfact;
    public $money_array;
    public $date = "day";
    public $dates = [];
    public $medicines = [];
    public $fact = 0;
    public $plan = 0;
    public $translate = 0;
    public $medicineShow = true;

    public $resime = 1;

    protected $listeners = ['planDate' => 'changePlanDate','for_plan' => 'plan'];

    public function __construct()
    {
        $this->planfact = new PlanFactService;
        $this->dates = $this->planfact->getDates();
        $this->translate = $this->planfact->transform() * 47;
    }

    public function plan()
    {
        $this->resime = 2;
        $this->changePlanMedicine();
    }

    public function changePlanDate($date)
    {
        // dd($date);
        $this->date = $date;
        $this->changePlanMedicine();
    }

    public function changePlanMedicine()
    {
        $this->medicines = $this->planfact->getMedicine($this->date);
        $this->plan = $this->planfact->getPlanFact($this->date)->plan;
        $this->fact = $this->planfact->getPlanFact($this->date)->fact;
    }

    public function render()
    {
        return view('livewire.plan');
    }
}
