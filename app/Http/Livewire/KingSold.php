<?php

namespace App\Http\Livewire;

use App\Services\HelperServices;
use Carbon\Carbon;
use Livewire\Component;

class KingSold extends Component
{
    public $date = 'Shu hafta';
    public $king_sold;
    public $ksnumber;
    // public $king_sold05;
    public $region_king_sold;
    public $region_all_king_sold;
    public $date_begin;
    public $date_end;
    public $myks_battle;
    public $myks_battle_history;
    public $allksb_battle_history;
    public $all_ks_battle;
    public $get_ksb_bonus;
    public $exist_duel = 0;
    public $timer;
    protected $listeners = ['kingSd' => 'kingSolds','ksbHistory' => 'ksBattleHistory'];
 
    public function mount()
    {
        $this->setTimer();
        $timeServices = new HelperServices;
        $this->ksnumber = getKSN() + 9;
        $time = $timeServices->kingSoldDay($this->date);
        $date_begin = $time->date_begin;
        $date_end = $time->date_end;
        $this->date = $time->dateText;
        $this->king_sold = $timeServices->kingSolds($date_begin,$date_end);
        // $this->king_sold05 = $timeServices->kingSold05($date_begin,$date_end);
        $this->region_king_sold = $timeServices->regionKingSold($date_begin,$date_end);
        $this->allksb_battle_history = $timeServices->allKSBattleHistory($date_end);

        $this->all_ks_battle = $timeServices->allKSBattle($date_begin,$date_end);
        $this->myks_battle = $timeServices->myKSBattle($date_begin,$date_end);


        $this->date_begin = $date_begin;
        $this->date_end = $date_end;
    }

    private function setTimer()
    {
        $endDay = strtotime(Carbon::parse()->endOfMonth()->format("Y-m-d")) - strtotime(now());
        $this->timer['day'] = (int)round($endDay / 86400);
        $this->timer['hour'] = (int)round(($endDay % 86400) / 3600);
        $this->timer['minut'] = (int)round(($endDay % 86400 ) / 3600);
    }
    
    public function kingSolds($d)
    {
        $timeServices = new HelperServices;
        $time = $timeServices->kingSoldDay($d);
        $this->ksnumber = $time->ksnumber;
        $date_begin = $time->date_begin;
        $date_end = $time->date_end;
        $this->date = $time->dateText;
        $this->king_sold = $timeServices->kingSolds($date_begin,$date_end);
        // $this->king_sold05 = $timeServices->kingSold05($date_begin,$date_end);
        $this->region_king_sold = $timeServices->regionKingSold($date_begin,$date_end);
        $this->date_begin = $date_begin;
        $this->date_end = $date_end;
        $this->exist_duel = 0;

    }
    public function ksBattleHistory($d)
    {
        $timeServices = new HelperServices;
        $time = $timeServices->kingSoldDay($d);
        $date_begin = $time->date_begin;
        $date_end = $time->date_end;
        $this->allksb_battle_history = $timeServices->allKSBattleHistory($date_end);
        $this->all_ks_battle = $timeServices->allKSBattle($date_begin,$date_end);
        $this->myks_battle = $timeServices->myKSBattle($date_begin,$date_end);

        $this->exist_duel = 1;
    }
    public function render()
    {
        $timeServices = new HelperServices;
        $time = $timeServices->kingSoldDay('Shu hafta');
        $date_begin = $time->date_begin;
        $date_end = $time->date_end;
        $this->region_all_king_sold = $timeServices->regionAllKingSold($date_begin,$date_end);
        // $this->myks_battle = $timeServices->myKSBattle();
        // $this->myks_battle_history = $timeServices->myKSBattleHistory();
        // $this->all_ks_battle = $timeServices->allKSBattle();

        // $time2 = $timeServices->kingSoldDay($this->date);
        // $date_begin2 = $time2->date_begin;
        // $date_end2 = $time2->date_end;

        // $this->get_ksb_bonus = $timeServices->getKSBonus($date_begin2,$date_end2);
        // $this->date_begin = $date_begin;
        // $this->date_end = $date_end;
        return view('livewire.king-sold');
    }
}
