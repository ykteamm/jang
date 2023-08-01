<?php

namespace App\Http\Livewire;

use App\Models\OuterMarket;
use Livewire\Component;

class MoneyModal extends Component
{

    public $weekDays;
    public $resime = 1;

    protected $listeners = ['for_money_modal' => 'modal'];


    public function modal()
    {
        $this->weekDays = [
            0 => "Yakshanba",
            1 => "Dushanba",
            2 => "Seshanba",
            3 => "Chorshanba",
            4 => "Payshanba",
            5 => "Juma",
            6 => "Shanba"
        ];

        $this->resime = 2;

    }

    public function render()
    {
        return view('livewire.money-modal');
    }
}
