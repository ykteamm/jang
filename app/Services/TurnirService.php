<?php

namespace App\Services;

use App\Models\TurnirGroup;
use App\Models\TurnirMember;
use App\Models\TurnirPoint;
use App\Models\TurnirStanding;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TurnirService
{
    public $tour;
    public $turnirbattle;
    public $amifirstteam;
    public $date;
    public $month;

    public function __construct()
    {
        $this->tour = $this->getTour();
        $this->date =  date("Y-m-d");
        $this->month = Carbon::now()->startOfMonth()->format("Y-m-d");
    }

    public function getNodes($node)
    {
        $pl = DB::table('turnir_playoffs')
            ->where('node', $node)
            ->first();
        if (isset($pl->battle_id)) {
            $battle_id = $pl->battle_id;

            $battle = $this->getCurrentBattles(1, $battle_id);
            // dd($battle_id, $battle);
            return $battle;
        }
        // dd($pl);
    }

    public function getNode6()
    {
        $battle = $this->getCurrentBattles(1, 41);
        return $battle;
    }
    public function getNode7()
    {
        $battle = $this->getCurrentBattles(1, 50);
        return $battle;
    }
    public function getCurrentBattles($status, $battle_id = null)
    {

        $s = $this->tour->date_begin;
        $e = $this->tour->date_end;
        $m = $this->month;
        $t = $this->tour->tour;

        if ($battle_id) {
            $battle = TurnirStanding::find($battle_id);
            $s = $battle->date_begin;
            $e = $battle->date_end;
            $t = $battle->tour;
        }

        $dd = TurnirStanding::select('id', 'team1_id', 'team2_id', DB::raw("(
            SELECT
            COALESCE(SUM(CASE WHEN DATE(pr.created_at) BETWEEN '$s' AND '$e' THEN pr.number * pr.price_product ELSE 0 END), 0)
            FROM turnir_members AS tm
            LEFT JOIN tg_productssold AS pr ON pr.user_id = tm.user_id
            WHERE tm.tour = '$t' AND tm.month = '$m'
            AND (tm.team_id = turnir_standings.team1_id OR tm.team_id = turnir_standings.team2_id)
        ) as allsum"))
            ->with([
                'team1' => function ($q) use ($s, $e, $m, $t) {
                    $q->select('id');
                    $q->with(['prodaja' => function ($b) use ($s, $e, $m, $t) {
                        $b->where('tour', $t)
                            ->whereDate('month', $m)
                            ->leftJoin('tg_productssold', 'tg_productssold.user_id', 'turnir_members.user_id')
                            ->select(DB::raw(
                                "SUM(CASE WHEN DATE(tg_productssold.created_at) BETWEEN '$s' AND '$e'
                    THEN tg_productssold.number * tg_productssold.price_product ELSE 0 END) as allprice"
                            ), 'turnir_members.team_id')
                            ->groupBy('turnir_members.team_id');
                    }]);
                    $q->with(['ksb' => function ($b) use ($s, $e, $m, $t) {
                        $b->where('tour', $t)
                            ->whereDate('month', $m)
                            ->leftJoin('tg_order', 'tg_order.user_id', 'turnir_members.user_id')
                            ->leftJoin('tg_king_sold', 'tg_king_sold.order_id', 'tg_order.id')
                            ->select(DB::raw(
                                "SUM(CASE WHEN DATE(tg_king_sold.created_at) BETWEEN '$s' AND '$e' AND tg_king_sold.admin_check = 1 THEN
                    CASE WHEN tg_king_sold.status = 1 THEN 1 ELSE 0.5 END ELSE 0 END) AS count"
                            ), 'turnir_members.team_id')
                            ->groupBy('turnir_members.team_id');
                    }]);
                    $q->with(['users' => function ($b) use ($t, $m) {
                        $b->where('tour', $t)
                            ->whereDate('month', $m)
                            ->selectRaw('tg_user.id, tg_user.first_name as f, tg_user.last_name as l, tg_user.image_url as img, turnir_members.team_id')
                            ->leftJoin('tg_user', 'tg_user.id', 'turnir_members.user_id');
                    }]);
                },
                'team2' => function ($q) use ($s, $e, $m, $t) {
                    $q->select('id');
                    $q->with(['prodaja' => function ($b) use ($s, $e, $m, $t) {
                        $b->where('tour', $t)
                            ->whereDate('month', $m)
                            ->leftJoin('tg_productssold', 'tg_productssold.user_id', 'turnir_members.user_id')
                            ->select(DB::raw(
                                "SUM(CASE WHEN DATE(tg_productssold.created_at) BETWEEN '$s' AND '$e'
                    THEN tg_productssold.number * tg_productssold.price_product ELSE 0 END) as allprice"
                            ), 'turnir_members.team_id')
                            ->groupBy('turnir_members.team_id');
                    }]);
                    $q->with(['ksb' => function ($b) use ($s, $e, $m, $t) {
                        $b->where('tour', $t)
                            ->whereDate('month', $m)
                            ->leftJoin('tg_order', 'tg_order.user_id', 'turnir_members.user_id')
                            ->leftJoin('tg_king_sold', 'tg_king_sold.order_id', 'tg_order.id')
                            ->select(DB::raw(
                                "SUM(CASE WHEN DATE(tg_king_sold.created_at) BETWEEN '$s' AND '$e' AND tg_king_sold.admin_check = 1 THEN
                    CASE WHEN tg_king_sold.status = 1 THEN 1 ELSE 0.5 END ELSE 0 END) AS count"
                            ), 'turnir_members.team_id')
                            ->groupBy('turnir_members.team_id');
                    }]);
                    $q->with(['users' => function ($b) use ($t, $m) {
                        $b->where('tour', $t)
                            ->whereDate('month', $m)
                            ->selectRaw('tg_user.id, tg_user.first_name as f, tg_user.last_name as l, tg_user.image_url as img, turnir_members.team_id')
                            ->leftJoin('tg_user', 'tg_user.id', 'turnir_members.user_id');
                    }]);
                }
            ])
            ->where(function ($q) use ($t, $status, $m, $battle_id) {
                $q->where('tour', $t)
                    ->where('status', $status)
                    ->whereDate('month', $m);
                if ($battle_id) {
                    $q->where('id', $battle_id);
                }
            })
            ->orderBy('allsum', 'DESC')
            ->get();


            return $dd;


    }

    public function haveTurnirBattle($userId)
    {
        return $this->myTurnirBattle($userId) == NULL ? false : true;
    }

    public function willEndBattles($date = NULL)
    {
        return TurnirStanding::whereDate('date_end', $date ?? date("Y-m-d"))->get();
    }

    public function getNextTour($date = NULL)
    {
        return DB::table('turnir_tours')
            ->whereDate('date_begin', '>=', $date ?? date("Y-m-d"))
            ->orderBy('date_begin', "ASC")
            ->first();
    }

    public function teamUsersIds($teamId)
    {
        return DB::table('turnir_teams')
            ->leftJoin('turnir_members', 'turnir_members.team_id', 'turnir_teams.id')
            ->where('turnir_teams.id', $teamId)
            ->where('turnir_members.tour', $this->tour->tour)
            ->where('turnir_members.month', $this->month)
            ->pluck('turnir_members.user_id');
    }

    public function getTeamUids($teamId, $tour, $month)
    {
        return DB::table('turnir_teams')
            ->leftJoin('turnir_members', 'turnir_members.team_id', 'turnir_teams.id')
            ->where('turnir_teams.id', $teamId)
            ->where('turnir_members.tour', $tour)
            ->where('turnir_members.month', $month)
            ->pluck('turnir_members.user_id');
    }

    public function getDaysWhithoutSunday()
    {
        $days = [];
        $start = strtotime($this->tour->date_begin);
        $end = strtotime($this->tour->date_end);
        for ($i = $start; $i <= $end; $i += 86400) {
            // $day = Carbon::parse($i)->getDaysFromStartOfWeek();
            $days[] = date("Y-m-d", $i);
            // if($day != 6) {
            // }
        }
        return $days;
    }

    public function teamSumma($teamId)
    {
        $days = $this->getDaysWhithoutSunday();
        $users = $this->teamUsersIds($teamId);
        return DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->whereIn(DB::raw('DATE(tg_productssold.created_at)'), $days)
            ->whereIn('tg_productssold.user_id', $users)
            ->first()->allprice ?? 0;
    }

    public function teamKsb($teamId)
    {
        $days = $this->getDaysWhithoutSunday();
        $users = $this->teamUsersIds($teamId);
        return DB::table('tg_king_sold')
            ->selectRaw('SUM(CASE WHEN tg_king_sold.status = 1 THEN 1 ELSE 0.5 END) AS count')
            ->leftJoin('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
            ->where('tg_king_sold.admin_check', 1)
            ->whereIn(DB::raw('DATE(tg_king_sold.created_at)'), $days)
            ->whereIn('tg_order.user_id', $users)
            ->first()->count ?? 0;
    }

    public function getGroupsTable()
    {
        $groups = [];
        $tunirGroups = TurnirGroup::orderBy('name', 'ASC')->get();
        $m = $this->month;
        $t = $this->tour->tour > 3 ? 3 : $this->tour->tour;
        $s = $this->getFirstTourStartDate();
        $e = $this->tour->tour > 3 ? $this->getThirdTourEndDate() : $this->tour->date_end;
        
        foreach ($tunirGroups as $gr) {
            $groups[$gr->name] = DB::select("SELECT
            tt.id,
            (SELECT SUM(tp.point) FROM turnir_points AS tp WHERE tp.team_id = tg.team_id AND DATE(tp.month) = ? GROUP BY (tp.team_id)) AS ball,
            (
                ((SELECT SUM(tp.point) FROM turnir_points AS tp WHERE tp.team_id = tg.team_id AND DATE(tp.month) = ? GROUP BY (tp.team_id))
                * 1000000000) +
                (SELECT
                    COALESCE(SUM(CASE WHEN DATE(pr.created_at) BETWEEN '$s' AND '$e' THEN pr.number * pr.price_product ELSE 0 END), 0) AS allb
                    FROM tg_productssold AS pr
                    WHERE pr.user_id IN (SELECT tm.user_id FROM turnir_members AS tm WHERE tm.team_id = tt.id GROUP BY tm.user_id))
            ) AS allball,

            (SELECT u.id FROM tg_user AS u LEFT JOIN turnir_members AS tm ON tm.user_id = u.id
            WHERE tg.team_id = tm.team_id AND tm.tour = '$t' AND DATE(tm.month) = '$m' ORDER BY tm.id ASC LIMIT 1) AS i1,

            (SELECT first_name FROM tg_user AS u LEFT JOIN turnir_members AS tm ON tm.user_id = u.id
            WHERE tg.team_id = tm.team_id AND tm.tour = ? AND DATE(tm.month) = ? ORDER BY tm.id ASC LIMIT 1) AS f1,

            (SELECT last_name FROM tg_user AS u LEFT JOIN turnir_members AS tm ON tm.user_id = u.id
            WHERE tg.team_id = tm.team_id AND tm.tour = ? AND DATE(tm.month) = ? ORDER BY tm.id ASC LIMIT 1) AS l1,

            (SELECT u.id FROM tg_user AS u LEFT JOIN turnir_members AS tm ON tm.user_id = u.id
            WHERE tg.team_id = tm.team_id AND tm.tour = '$t' AND DATE(tm.month) = '$m' ORDER BY tm.id DESC LIMIT 1) AS i2,

            (SELECT first_name FROM tg_user AS u LEFT JOIN turnir_members AS tm ON tm.user_id = u.id
            WHERE tg.team_id = tm.team_id AND tm.tour = ? AND DATE(tm.month) = ? ORDER BY tm.id DESC LIMIT 1) AS f2,

            (SELECT last_name FROM tg_user AS u LEFT JOIN turnir_members AS tm ON tm.user_id = u.id
            WHERE tg.team_id = tm.team_id AND tm.tour = ? AND DATE(tm.month) = ? ORDER BY tm.id DESC LIMIT 1) AS l2

            FROM turnir_team_groups AS tg
            LEFT JOIN turnir_teams AS tt ON tt.id = tg.team_id
            WHERE tg.group_id = ?
            ORDER BY allball DESC
            ", [$m, $m, $t, $m, $t, $m, $t, $m, $t, $m, $gr->id]);
        }
        return $groups;
    }

    public function getGamesTable($status)
    {

        $m = $this->month;
        $t = $this->tour->tour;
        $s = $this->getFirstTourStartDate();
        $e = $this->tour->date_end;
        if($status == 0 && $t > 3)
        {
            $l = 3;
        }else{
            $l = 0;
        }
        // dd($e);
        return DB::select("SELECT
            tt.id,
            (SELECT SUM(tp.point) FROM turnir_points AS tp WHERE tp.team_id = tt.id AND tp.tour > $l AND DATE(tp.month) = ? GROUP BY (tp.team_id)) AS ball,
            (
                ((SELECT SUM(tp.point) FROM turnir_points AS tp WHERE tp.team_id = tt.id AND DATE(tp.month) = ? GROUP BY (tp.team_id))
                * 1000000000) +
                (SELECT
                    COALESCE(SUM(CASE WHEN DATE(pr.created_at) BETWEEN '$s' AND '$e' THEN pr.number * pr.price_product ELSE 0 END), 0) AS allb
                    FROM tg_productssold AS pr
                    WHERE pr.user_id IN (SELECT tm.user_id FROM turnir_members AS tm WHERE tm.team_id = tt.id GROUP BY tm.user_id))
            ) AS allball,

            (SELECT u.id FROM tg_user AS u LEFT JOIN turnir_members AS tm ON tm.user_id = u.id
            WHERE tt.id = tm.team_id AND tm.tour = '$t' AND DATE(tm.month) = '$m' ORDER BY tm.id ASC LIMIT 1) AS i1,

            (SELECT first_name FROM tg_user AS u LEFT JOIN turnir_members AS tm ON tm.user_id = u.id
            WHERE tt.id = tm.team_id AND tm.tour = ? AND DATE(tm.month) = ? ORDER BY tm.id ASC LIMIT 1) AS f1,

            (SELECT last_name FROM tg_user AS u LEFT JOIN turnir_members AS tm ON tm.user_id = u.id
            WHERE tt.id = tm.team_id AND tm.tour = ? AND DATE(tm.month) = ? ORDER BY tm.id ASC LIMIT 1) AS l1,

            (SELECT u.id FROM tg_user AS u LEFT JOIN turnir_members AS tm ON tm.user_id = u.id
            WHERE tt.id = tm.team_id AND tm.tour = '$t' AND DATE(tm.month) = '$m' ORDER BY tm.id DESC LIMIT 1) AS i2,

            (SELECT first_name FROM tg_user AS u LEFT JOIN turnir_members AS tm ON tm.user_id = u.id
            WHERE tt.id = tm.team_id AND tm.tour = ? AND DATE(tm.month) = ? ORDER BY tm.id DESC LIMIT 1) AS f2,

            (SELECT last_name FROM tg_user AS u LEFT JOIN turnir_members AS tm ON tm.user_id = u.id
            WHERE tt.id = tm.team_id AND tm.tour = ? AND DATE(tm.month) = ? ORDER BY tm.id DESC LIMIT 1) AS l2

            FROM turnir_teams AS tt
            WHERE tt.status = ?
            GROUP BY tt.id
            ORDER BY ball DESC
            ", [$m, $m, $t, $m, $t, $m, $t, $m, $t, $m, $status]);
    }

    public function endGroup()
    {
        return '2023-08-15';
        // return DB::table('turnir_tours')
        //     ->where('tour', 3)
        //     ->whereDate('month', $this->month)
        //     ->orderBy('date_end', "DESC")
        //     ->first()->date_end;
    }
    public function endTurnir()
    {
        return DB::table('turnir_tours')
            ->where('tour', 6)
            ->whereDate('month', $this->month)
            ->orderBy('date_end', "DESC")
            ->first()->date_end;
    }

    public function getTour($date = NULL)
    {
        $dd = DB::table('turnir_tours')
            ->whereDate('date_begin', '<=', $date ?? date("Y-m-d"))
            ->whereDate('date_end', '>=', $date ?? date("Y-m-d"))
            ->first();

        // $dd = DB::table('turnir_tours')
        //     ->whereDate('date_begin', '<=', '2023-08-18')
        //     ->whereDate('date_end', '>=', '2023-08-20')
        //     ->first();
        return $dd;
    }
    
    public function getFirstTourStartDate()
    {
        return DB::table('turnir_tours')
            ->whereDate('month', $this->month)
            ->where('tour', 1)
            ->first()->date_begin;
    }

    public function getThirdTourEndDate()
    {
        return DB::table('turnir_tours')
            ->whereDate('month', $this->month)
            ->where('tour', 3)
            ->first()->date_end;
    }

    public function haveTeam()
    {
        $teamId = TurnirMember::where('user_id', Auth::id())->value('team_id');
        if ($teamId) {
            return true;
        } else {
            return false;
        }
    }

    public function getTotalPoint()
    {
        $teamId = TurnirMember::where('user_id', Auth::id())
        ->where('month', '=', $this->month)
        ->value('team_id');
        return TurnirPoint::where('team_id', $teamId)
            ->selectRaw('SUM(point) AS points')
            ->where('month', '=', $this->month)
            ->groupBy('team_id')
            ->value('points') ?? 0;

        // return TurnirPoint::where('team_id', $teamId)
        //     ->whereDate('month', $this->month)
        //     ->sum('point') ?? 0;
    }

    public function getPoint($teamId)
    {
        return TurnirPoint::where('team_id', $teamId)
            ->where('tour', $this->tour->tour)
            ->whereDate('month', $this->month)
            ->first();
    }

    public function getUserProfile($userId)
    {
        $this->amifirstteam = $this->amIFirstTeam($userId);
        $this->turnirbattle = $this->myTurnirBattle($userId);
    }
    public function myTurnirBattle($userId)
    {
        $teamId = TurnirMember::where('user_id', $userId)->whereDate('month',date('Y-m').'-01')->value('team_id');
        return TurnirStanding::where(function ($q) use ($teamId) {
            $q->where('team1_id', $teamId)
                ->orWhere('team2_id', $teamId);
        })->where('date_begin', '<=', $this->date)
            ->where('date_end', '>=', $this->date)
            ->first();
    }
    public function team1ksb()
    {
        if ($this->amifirstteam) {
            return $this->teamKsb($this->turnirbattle->team1_id);
        } else {
            return $this->teamKsb($this->turnirbattle->team2_id);
        }
    }

    public function team2ksb()
    {
        if ($this->amifirstteam) {
            return $this->teamKsb($this->turnirbattle->team2_id);
        } else {
            return $this->teamKsb($this->turnirbattle->team1_id);
        }
    }
    public function team1names()
    {
        if ($this->amifirstteam) {

            return $this->userNames($this->turnirbattle->team1_id);
        } else {
            return $this->userNames($this->turnirbattle->team2_id);
        }
    }

    public function team2names()
    {
        if ($this->amifirstteam) {
            return $this->userNames($this->turnirbattle->team2_id);
        } else {
            return $this->userNames($this->turnirbattle->team1_id);
        }
    }
    public function team1images()
    {
        if ($this->amifirstteam) {
            return $this->userImages($this->turnirbattle->team1_id);
        } else {
            return $this->userImages($this->turnirbattle->team2_id);
        }
    }

    public function team2images()
    {
        if ($this->amifirstteam) {
            return $this->userImages($this->turnirbattle->team2_id);
        } else {
            return $this->userImages($this->turnirbattle->team1_id);
        }
    }
    public function team1summa()
    {
        if ($this->amifirstteam) {
            return $this->teamSumma($this->turnirbattle->team1_id);
        } else {
            return $this->teamSumma($this->turnirbattle->team2_id);
        }
    }

    public function team2summa()
    {
        if ($this->amifirstteam) {
            return $this->teamSumma($this->turnirbattle->team2_id);
        } else {
            return $this->teamSumma($this->turnirbattle->team1_id);
        }
    }
    public function amIFirstTeam($userId)
    {
        $teamId = TurnirMember::where('user_id', $userId)->whereDate('month',date('Y-m').'-01')->value('team_id');
        $team1 = $this->turStanding('team1_id', $teamId);
        $team2 = $this->turStanding('team2_id', $teamId);
        if ($team1 && !$team2) {
            return true;
        } else if (!$team1 && $team2) {
            return false;
        }
    }
    public function userImages($teamId)
    {
        return DB::table("tg_user")
            ->select('tg_user.image_url')
            ->leftJoin('turnir_members', 'turnir_members.user_id', 'tg_user.id')
            ->where('turnir_members.team_id', $teamId)
            ->whereDate('turnir_members.month', $this->month)
            ->groupBy('tg_user.id')
            ->get('image_url');
    }


    public function userNames($teamId)
    {

        $dd = DB::table("tg_user")
            ->select('tg_user.id', 'tg_user.first_name', 'tg_user.last_name')
            ->leftJoin('turnir_members', 'turnir_members.user_id', 'tg_user.id')
            ->where('turnir_members.team_id', $teamId)
            ->whereDate('turnir_members.month', $this->month)
            ->groupBy('tg_user.id')
            ->get();
            
        // dd($dd);


        return $dd;
    }
    public function turStanding($team, $teamId)
    {
        return TurnirStanding::where($team, $teamId)
            ->where('date_begin', '<=', $this->date)
            ->where('date_end', '>=', $this->date)
            ->first();
    }
}
