<?php

namespace App\Http\Livewire;

use App\Services\TeamBattleServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TeamBattle extends Component
{
    public $team1 = [];
    public $team2 = [];
    public $myTeamBattle;
    public $time = 'Kun';
    public $start;
    public $end;
    public $sum1 = 0;
    public $sum2 = 0;
    public $amIinTeamOne = false;
    public $haveIGotTeam = false;
    public $isTeamBattleBegin = false;
    public $months = [];
    public $month;
    public $user_id;
    public $resime = 1;
    public $sliders;

    protected $listeners = ['change' => 'changeByTime','for_teambattle' => 'teambattle'];

    public function teambattle()
    {
        $this->resime = 2;
        $this->sliders = DB::table('team_battle_sliders')->get();

        $this->month = getMonthName(date("F"));
        $this->start = date("Y-m-d");
        $this->end = date("Y-m-d");
        $teamService = new TeamBattleServices($this->user_id ?? Auth::id());
        $teamBtl = $teamService->getTeamBattle($this->start, $this->end);
        $this->isTeamBattleBegin = $teamBtl->isTeamBattleBegin;
        $this->haveIGotTeam = $teamBtl->haveIGotTeam;
        if ($this->haveIGotTeam && $this->isTeamBattleBegin) {
            $this->amIinTeamOne = $teamService->amIinTeamOne;
            $this->team1 = $teamBtl->team1;
            $this->team2 = $teamBtl->team2;
            $this->myTeamBattle = $teamBtl->my_team_battle[0];
            if ($this->amIinTeamOne) {
                $this->sum1 = $teamService->sum($this->start, $this->end, $teamBtl->my_team_battle[0]->team1->id)[0]->allprice;
                $this->sum2 = $teamService->sum($this->start, $this->end, $teamBtl->my_team_battle[0]->team2->id)[0]->allprice;
            } else {
                $this->sum2 = $teamService->sum($this->start, $this->end, $teamBtl->my_team_battle[0]->team1->id)[0]->allprice;
                $this->sum1 = $teamService->sum($this->start, $this->end, $teamBtl->my_team_battle[0]->team2->id)[0]->allprice;
            }
            $months = $teamService->teamBattleMonths();
            $len = count($months);
            $this->month = getMonthName(date("F"));
            for ($i = $len - 1; $i >= 0; $i--) {
                $month = $months[$i];
                $monthlySum = 0;
                $startOfMonth = Carbon::parse($month->m)->startOfMonth()->format("Y-m-d");
                $endOfMonth = Carbon::parse($month->m)->endOfMonth()->format("Y-m-d");
                if ($this->amIinTeamOne) {
                    $monthlySum = $teamService->sum($startOfMonth, $endOfMonth, $teamBtl->my_team_battle[0]->team1->id)[0]->allprice;
                } else {
                    $monthlySum = $teamService->sum($startOfMonth, $endOfMonth, $teamBtl->my_team_battle[0]->team2->id)[0]->allprice;
                }
                $this->months[] = [
                    "month" => getMonthName(date("F", strtotime($months[$i]->m))),
                    "count" => $months[$i]->c,
                    'sum' => $monthlySum
                ];
            }
        }
    }

    public function changeByTime()
    {
        $teamService = new TeamBattleServices($this->user_id ?? Auth::id());
        if ($this->time == 'Kun') {
            $teamId = $teamService->getTeamId();
            if (count($teamId) > 0) {
                $teamBattle = $teamService->myTeamBattle($teamId[0]->team_id);
                if (count($teamBattle) > 0) {
                    $this->start = $teamBattle[0]->start_day;
                    $this->end = $teamBattle[0]->end_day;
                }
            } else {
                $this->start = date("Y-m-d");
                $this->end = date("Y-m-d");
            }
            $this->time = 'Round';
        } else if ($this->time == 'Round') {
            $this->start = Carbon::now()->startOfMonth()->format("Y-m-d");
            $this->end = Carbon::now()->endOfMonth()->format("Y-m-d");
            $this->time = 'Oy';
        } else {
            $this->time = 'Kun';
            // $this->start = "2023-02-10";
            // $this->end = "2023-02-10";
            $this->start = date("Y-m-d");
            $this->end = date("Y-m-d");
        }
        $teamBtl = $teamService->getTeamBattle($this->start, $this->end);
        $this->isTeamBattleBegin = $teamBtl->isTeamBattleBegin;
        $this->haveIGotTeam = $teamBtl->haveIGotTeam;
        if ($this->haveIGotTeam && $this->isTeamBattleBegin) {
            $this->amIinTeamOne = $teamService->amIinTeamOne;
            $this->team1 = $teamBtl->team1;
            $this->team2 = $teamBtl->team2;
            $this->myTeamBattle = $teamBtl->my_team_battle[0];
            if ($this->amIinTeamOne) {
                $this->sum1 = $teamService->sum($this->start, $this->end, $teamBtl->my_team_battle[0]->team1->id)[0]->allprice;
                $this->sum2 = $teamService->sum($this->start, $this->end, $teamBtl->my_team_battle[0]->team2->id)[0]->allprice;
            } else {
                $this->sum2 = $teamService->sum($this->start, $this->end, $teamBtl->my_team_battle[0]->team1->id)[0]->allprice;
                $this->sum1 = $teamService->sum($this->start, $this->end, $teamBtl->my_team_battle[0]->team2->id)[0]->allprice;
            }
        }
    }

    public function render()
    {
        return view('livewire.team-battle');
    }
}
