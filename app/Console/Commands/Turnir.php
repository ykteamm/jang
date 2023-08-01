<?php

namespace App\Console\Commands;

use App\Models\TurnirMember;
use App\Models\TurnirPoint;
use App\Models\TurnirStanding;
use App\Models\TurnirTeam;
use App\Services\TurnirService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Turnir extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'turnir:battle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $service = new TurnirService;
        if ($service->tour->tour <= 3) {
            $this->calculate(false);
        }
        if ($service->tour->tour == 3 && $service->tour->date_end == date("Y-m-d")) {
            $this->toPlayOffStage();
        }
        if ($service->tour->tour > 3) {
            $this->calculate(true);
        }
    }


    public function toPlayOffStage()
    {
        $service = new TurnirService;
        $groupsEnds = $service->getGroupsTable();
        foreach ($groupsEnds as $groupName => $teams) {
            TurnirTeam::where('id', $teams[0]->id)->update([
                'status' => 1
            ]);
            TurnirTeam::where('id', $teams[1]->id)->update([
                'status' => 1
            ]);
        }
    }

    public function calculate($playOff = false)
    {
        $service = new TurnirService;
        // $service->date =  '2023-06-14';
        // $service->tour = $service->getTour('2023-06-14');
        // $endedBattles = $service->willEndBattles('2023-06-14');
        $endedBattles = $service->willEndBattles();
        foreach ($endedBattles as $battle) {
            $team1sum = $service->teamSumma($battle->team1_id);
            $team2sum = $service->teamSumma($battle->team2_id);
            $team1ksb = $service->teamKsb($battle->team1_id);
            $team2ksb = $service->teamKsb($battle->team2_id);
            $team1point = $service->getPoint($battle->team1_id);
            $team2point = $service->getPoint($battle->team2_id);
            if ($team1sum > $team2sum) {
                $team1point->point += 2;
                if ($playOff && $battle->status == 1) {
                    TurnirTeam::where('id', $battle->team1_id)->update([
                        'status' => 1
                    ]);
                    TurnirTeam::where('id', $battle->team2_id)->update([
                        'status' => 0
                    ]);
                    TurnirStanding::where('id', $battle->id)->update([
                        'win' => $battle->team1_id,
                        'lose' => $battle->team2_id,
                        'ends' => 1
                    ]);
                }
            } else if ($team1sum < $team2sum) {
                $team2point->point += 2;
                if ($playOff && $battle->status == 1) {
                    TurnirTeam::where('id', $battle->team2_id)->update([
                        'status' => 1
                    ]);
                    TurnirTeam::where('id', $battle->team1_id)->update([
                        'status' => 0
                    ]);
                    TurnirStanding::where('id', $battle->id)->update([
                        'win' => $battle->team2_id,
                        'lose' => $battle->team1_id,
                        'ends' => 1
                    ]);
                }
            } else {
                $team1point->point += 1;
                $team2point->point += 1;
            }
            if ($team1ksb > $team2ksb) {
                $team1point->point += 1;
            } else if ($team1ksb < $team2ksb) {
                $team2point->point += 1;
            }
            if (!($playOff && $battle->status == 1)) {
                if ($team1point > $team2point) {
                    TurnirStanding::where('id', $battle->id)->update([
                        'win' => $battle->team1_id,
                        'lose' => $battle->team2_id,
                        'ends' => 1
                    ]);
                } else if ($team1point < $team2point) {
                    TurnirStanding::where('id', $battle->id)->update([
                        'win' => $battle->team2_id,
                        'lose' => $battle->team1_id,
                        'ends' => 1
                    ]);
                }
            }
            if ($service->tour->tour >= 3) {
                $this->storeMembersPoints($battle->team1_id, $battle->team2_id);
            }
            $team1point->save();
            $team2point->save();
        }
    }

    public function storeMembersPoints($team1_id, $team2_id)
    {
        $service = new TurnirService;
        $tour = $service->getNextTour();
        $month = $service->month;
        $team1Uids = $service->getTeamUids($team1_id, $tour->tour - 1, $month);
        $team2Uids = $service->getTeamUids($team2_id, $tour->tour - 1, $month);
        // dd($request->all(), $status);
        TurnirMember::create([
            'team_id' => $team1_id,
            'user_id' => $team1Uids[0],
            'tour' => $tour->tour,
            'month' => $month
        ]);
        TurnirMember::create([
            'team_id' => $team1_id,
            'user_id' => $team1Uids[1],
            'tour' => $tour->tour,
            'month' => $month
        ]);
        TurnirMember::create([
            'team_id' => $team2_id,
            'user_id' => $team2Uids[0],
            'tour' => $tour->tour,
            'month' => $month
        ]);
        TurnirMember::create([
            'team_id' => $team2_id,
            'user_id' => $team2Uids[1],
            'tour' => $tour->tour,
            'month' => $month
        ]);
        TurnirPoint::create([
            'point' => 0,
            'team_id' =>  $team1_id,
            'tour' => $tour->tour,
            'month' => $month
        ]);
        TurnirPoint::create([
            'point' => 0,
            'team_id' =>  $team2_id,
            'tour' => $tour->tour,
            'month' => $month
        ]);
    }
}
