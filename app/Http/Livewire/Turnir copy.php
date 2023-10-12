<?php

namespace App\Http\Livewire;

use App\Models\TurnirGroup;
use App\Services\TurnirService;
use Livewire\Component;

class Turnir extends Component
{
    public $groupsTable;
    public $timer;
    public $tour;
    public $tourTitle;
    public $groupBattles;
    public $gamesTable;
    public $playOfTable;
    public $playOffGames;
    public $playOffBattles;
    public $node1;
    public $node2;
    public $node3;
    public $node4;
    public $node5;
    public $node6;
    public $node7;
    public $playOffStart = false;

    public $resime = 1;

    protected $listeners = ['tab' => 'changeTab','for_turnir' => 'turnir'];


    public function turnir()
    {

        $this->resime = 2;

        $service = new TurnirService;
        $this->tour = $service->tour->tour;
        $this->tourTitle = $service->tour->title;
        $endDay = 0;
        if ($service->tour->tour > 9) {

            $this->playOffStart = true;
            $this->playOffGames = $service->getCurrentBattles(0);
            $this->playOffBattles = $service->getCurrentBattles(1);
            $this->gamesTable = $service->getGamesTable(0);
            $this->playOfTable = $service->getGamesTable(1);
            // dd($this->playOfTable);
            $endDay = strtotime($service->tour->date_end) - strtotime(now());
            $this->node1 = $service->getNodes(1);
            $this->node2 = $service->getNodes(2);
            $this->node3 = $service->getNodes(3);
            $this->node4 = $service->getNodes(4);
            $this->node5 = $service->getNodes(6);
            $this->node6 = $service->getNodes(5);
            $this->node7 = $service->getNodes(7);
        } else {
            $this->groupBattles = $service->getCurrentBattles(0);
            $endDay = strtotime($service->endGroup()) - strtotime(now()) + 86400;
        }
        // dd($this->playOffBattles);
        $this->groupsTable = $service->getGroupsTable();
        // dd($this->groupsTable);  
        $this->timer['day'] = (int)round($endDay / 86400);
        $this->timer['hour'] = (int)round(($endDay % 86400) / 3600);
        $this->timer['minut'] = (int)round(($endDay % 86400) / 3600);
    }

    public function render()
    {
        return view('livewire.turnir');
    }
}
