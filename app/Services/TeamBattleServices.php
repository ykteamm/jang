<?php

namespace App\Services;

use App\Items\TeamBattleItems;
use App\Models\Team;
use App\Models\TeamBattle;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamBattleServices
{
    public $uid;
    public $amIinTeamOne = false;

    public function __construct($user_id)
    {

        $this->uid = $user_id;
    }

    public function myTeamBattle($teamId)
    {
        return TeamBattle::with('team1', 'team2')
            ->where(function ($query) use ($teamId) {
                $query->where('team1_id', $teamId)
                    ->orWhere('team2_id', $teamId);
            })
            ->whereDate('start_day', '<=', date("Y-m-d"))
            ->whereDate('end_day', '>=', date("Y-m-d"))
            ->get();
    }

    public function teamBattleMonths()
    {
        return DB::select("SELECT
            b.month AS m,
            COUNT(m) AS c
            FROM tg_user AS u
            LEFT JOIN tg_members AS m ON m.user_id = u.id
            LEFT JOIN tg_teams AS t ON t.id = m.team_id
            LEFT JOIN tg_team_battles AS b ON CASE WHEN ? THEN  b.team1_id = t.id ELSE b.team2_id = t.id END
            WHERE u.id = ?
            GROUP BY m
            ORDER BY m DESC
            LIMIT 3
        ", [$this->amIinTeamOne, $this->uid]);
    }

    public function getTeamId()
    {
        return TeamMember::where('user_id', $this->uid)->get();
    }

    public function getTeamMembers($start, $end, $teamId)
    {
        return DB::select(
            "SELECT
            COALESCE(SUM(CASE WHEN DATE(p.created_at) BETWEEN ? AND ? THEN p.number * p.price_product END), 0) AS allprice,
            u.id AS id,
            u.image_url AS i,
            u.first_name AS f,
            u.last_name AS l
            FROM tg_user AS u
            LEFT JOIN tg_productssold AS p ON p.user_id = u.id
            LEFT JOIN tg_members AS m ON m.user_id = u.id
            LEFT JOIN tg_teams AS t ON t.id = m.team_id
            WHERE u.id != ?
            AND t.id = ?
            GROUP BY u.id, l, f
            ORDER BY allprice DESC",
            [$start, $end, 72, $teamId]
        );
    }

    public function sum($start, $end, $teamId)
    {
        return DB::select(
            "SELECT
            COALESCE(SUM(CASE WHEN DATE(p.created_at) BETWEEN ? AND ? THEN p.number * p.price_product END), 0) AS allprice
            FROM tg_productssold AS p
            LEFT JOIN tg_members AS m ON m.user_id = p.user_id
            LEFT JOIN tg_teams AS t ON t.id = m.team_id
            WHERE p.user_id != ?
            AND t.id = ?",
            [$start, $end, 72, $teamId]
        );
    }

    public function getTeamBattle($start, $end)
    {
        $haveIGotTeam = false;
        $isTeamBattleBegin = false;
        $my_team_id = $this->getTeamId();

        if (count($my_team_id) > 0) {
            $haveIGotTeam = true;
            $team_id = $my_team_id[0]->team_id;
            $my_team_battle = $this->myTeamBattle($team_id);
            if (count($my_team_battle) > 0) {
                $isTeamBattleBegin = true;
                $this->amIinTeamOne = $team_id == $my_team_battle[0]->team1_id;
                if ($this->amIinTeamOne) {
                    $team1 = $this->getTeamMembers($start, $end, $my_team_battle[0]->team1_id);
                    $team2 = $this->getTeamMembers($start, $end, $my_team_battle[0]->team2_id);
                } else {
                    $team2 = $this->getTeamMembers($start, $end, $my_team_battle[0]->team1_id);
                    $team1 = $this->getTeamMembers($start, $end, $my_team_battle[0]->team2_id);
                }
            } else {
                $isTeamBattleBegin = false;
                $team1 = [];
                $team2 = [];
                $my_team_battle = [];
            }
        } else {
            $haveIGotTeam = false;
            $team1 = [];
            $team2 = [];
            $my_team_battle = [];
        }
        $n = new TeamBattleItems;
        $n->haveIGotTeam = $haveIGotTeam;
        $n->isTeamBattleBegin = $isTeamBattleBegin;
        $n->team1 = $team1;
        $n->team2 = $team2;
        $n->my_team_battle = $my_team_battle;
        $n->my_team_id = $my_team_id;
        return $n;
    }
    public function getMyTeamBattle()
    {
        // $date = date('2023-02-10');
        $date = date('Y-m-d');
        $my_team_id = TeamMember::where('user_id', $this->uid)->get();
        $get_battle_arr = [];

        if (count($my_team_id) > 0) {
            $team_id = $my_team_id[0]->team_id;

            $my_team_battle_all = TeamBattle::with('team1', 'team2')
                ->where(function ($query) use ($team_id) {
                    $query->where('team1_id', $team_id)
                        ->orWhere('team2_id', $team_id);
                })->whereDate('start_day', '<', $date)
                ->whereDate('start_day', '>', '2023-03-31')
                ->orderBy('id', "DESC")
                ->get();
            foreach ($my_team_battle_all as $key => $value) {
                $month = date("F", strtotime($value->start_day));
                $tmbattle = $this->gameTeamBattle($value);
                if (!isset($get_battle_arr[$month])) {
                    $get_battle_arr[$month] = [];
                    $get_battle_arr[$month]['battles'] = [];
                    $get_battle_arr[$month]['info'] = [];
                    $get_battle_arr[$month]['info']['team1'] = ['name' => $tmbattle['team1_name'], 'sum' => 0];
                    $get_battle_arr[$month]['info']['team2'] = ['name' => $tmbattle['team2_name'], 'sum' => 0];
                }
                $get_battle_arr[$month]['info']['team1']['sum'] += $tmbattle['team1_sum'];
                $get_battle_arr[$month]['info']['team2']['sum'] += $tmbattle['team2_sum'];
                $get_battle_arr[$month]['battles'][] = $tmbattle;
            }
        }
        // dd($get_battle_arr);
        return $get_battle_arr;
    }
    public function gameTeamBattle($battle)
    {
        $start_day = $battle->start_day;
        $end_day = $battle->end_day;
        $team1_id = $battle->team1_id;
        $team2_id = $battle->team2_id;

        $team1_sum = $this->getBattleSum($start_day, $end_day, $team1_id);
        $team2_sum = $this->getBattleSum($start_day, $end_day, $team2_id);

        $team1_name = Team::find($team1_id);
        $team2_name = Team::find($team2_id);
        $team1_users = $this->getTeamMembers($start_day, $end_day, $team1_id);
        $team2_users = $this->getTeamMembers($start_day, $end_day, $team2_id);

        $arr = array(
            'round' => $battle->round,
            'team1_name' => $team1_name->name,
            'team2_name' => $team2_name->name,
            'team1_sum' => $team1_sum,
            'team2_sum' => $team2_sum,
            'team1_users' => $team1_users,
            'team2_users' => $team2_users
        );

        return $arr;
    }
    public function getBattleSum($start_day, $end_day, $team_id)
    {
        $sum = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->whereDate('tg_productssold.created_at', '>=', $start_day)
            ->whereDate('tg_productssold.created_at', '<=', $end_day)
            ->where('tg_teams.id', $team_id)
            ->join('tg_user', 'tg_user.id', 'tg_productssold.user_id')
            ->where('tg_user.id', '!=', 72)

            ->join('tg_members', 'tg_members.user_id', 'tg_user.id')
            ->join('tg_teams', 'tg_teams.id', 'tg_members.team_id')
            ->get()[0]->allprice;
        if ($sum == NULL) {
            $sum = 0;
        }

        return $sum;
    }
}
