<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanFactService
{
    private $dayPlanFact;
    private $weekPlanFact;
    private $monthPlanFact;
    private $dayMedicine;
    private $weekMedicine;
    private $monthMedicine;

    public function __construct()
    {
        $this->dayPlanFact = $this->getDayPlanFact();
        $this->weekPlanFact = $this->getWeekPlanFact();
        $this->monthPlanFact = $this->getMonthPlanFact();
        $this->dayMedicine = $this->getDailyMedicine();
        $this->weekMedicine = $this->getWeeklyMedicine();
        $this->monthMedicine = $this->getMonthMedicine();
    }

    public function transform()
    {
        $transform = 0;
        $today = date("d");
        $cal = DB::table('tg_calendar')->orderBy('id', 'DESC')->first();
        $days = json_decode($cal->day_json);
        foreach ($days as $day => $bool) {
            if($today == $day + 1) {
                break;
            }
            if($bool == "true") {
                $transform += 1;
            }
        }
        return $transform;
    }

    public function getPlan($date)
    {
        switch ($date) {
            case "day":
                return $this->dayPlanFact;
                break;
            case "week":
                return $this->weekPlanFact;
                break;
            case "month":
                return $this->monthPlanFact;
                break;
        }
    }


    public function getDates()
    {
        $dates = [];
        $today = date("d");
        $cal = DB::table('tg_calendar')->orderBy('id', 'DESC')->first();
        $days = json_decode($cal->day_json);
        foreach ($days as $day => $bool) {
            if($today == $day + 1) {
                $dates[] = 'day';
                $dates[] = 'week';
                $dates[] = 'month';
            } else if ($today < $day + 1) {
                if($bool == "true") {
                    $dates[] = $day + 1;
                }
            }
        }
        return $dates;
    }

    public function getPlanFact($date)
    {
        switch ($date) {
            case "day":
                return $this->dayPlanFact;
                break;
            case "week":
                return $this->weekPlanFact;
                break;
            case "month":
                return $this->monthPlanFact;
                break;
            default:
                return $this->getDayPlanFact($date);
                break;
        }
    }

    public function getMedicine($date)
    {
        switch ($date) {
            case "day":
                return $this->dayMedicine;
                break;
            case "week":
                return $this->weekMedicine;
                break;
            case "month":
                return $this->monthMedicine;
                break;
            default:
                return $this->getDailyMedicine($date);
                break;
        }
    }

    private function getMonthPlanFact()
    {
        $month = date("m.Y");
        $startMonth = Carbon::parse()->startOfMonth()->format("Y-m-d");
        $endMonth = Carbon::parse()->endOfMonth()->format("Y-m-d");
        try {
            return DB::select(
                "SELECT
                COALESCE(
                    (
                        SELECT SUM(pr.number * pr.price_product) FROM tg_productssold AS pr  
                        WHERE pr.user_id = ? 
                        AND DATE(pr.created_at) BETWEEN ? AND ?
                    ) 
                        ,0) AS fact,
                plan::integer
                FROM user_plans AS up 
                WHERE up.user_id = ? AND to_char(up.created_at, 'MM.YYYY') = ?
                ORDER BY up.created_at
                LIMIT 1",
                [Auth::id(), $startMonth, $endMonth, Auth::id(), $month]
            )[0];
        } catch (\Throwable $th) {
            return new class
            {
                public $plan = 0;
                public $fact = 0;
            };
        }
    }
    private function getWeekPlanFact()
    {
        $now = date("Y-m-d");
        $month = date("m.Y");
        try {
            $pw = DB::select("SELECT * FROM tg_planweeks AS pw WHERE ? BETWEEN DATE(pw.startday) AND DATE(pw.endday) LIMIT 1", [$now])[0];
            return
                DB::select(
                    "SELECT 
                COALESCE(
                    (
                        SELECT SUM(pr.number * pr.price_product) FROM tg_productssold AS pr  
                        WHERE pr.user_id = ? 
                        AND DATE(pr.created_at) BETWEEN ? AND ?
                    ) 
                        ,0) AS fact,
                COALESCE(
                    CEILING(
                    (up.plan + 0.0) 
                    /
                    (
                        SELECT work_day FROM tg_calendar AS cl WHERE cl.year_month = ?
                    ) 
                    * 
                    (
                        SELECT workday FROM tg_planweeks AS pw 
                        WHERE ? BETWEEN DATE(pw.startday) AND DATE(pw.endday) LIMIT 1
                    )
                    )
                        ,0)::integer AS plan
                FROM user_plans AS up 
                WHERE up.user_id = ? AND to_char(up.created_at, 'MM.YYYY') = ?
                ORDER BY up.created_at
                LIMIT 1",
                    [Auth::id(), $pw->startday, $pw->endday, $month, $now, Auth::id(), $month]
                )[0];
        } catch (\Throwable $th) {
            return new class
            {
                public $plan = 0;
                public $fact = 0;
            };
        }
    }
    private function getDayPlanFact($day = null)
    {
        $month = date("m.Y");
        $dy = $day ? date("Y-m") . "-$day" : date("Y-m-d");
        try {
            return
                DB::select(
                    "SELECT 
                COALESCE((SELECT SUM(pr.number * pr.price_product) FROM tg_productssold AS pr WHERE pr.user_id = ? AND DATE(pr.created_at) = ?), 0) AS fact,
                COALESCE(CEILING((up.plan + 0.0) / (SELECT work_day FROM tg_calendar AS cl WHERE cl.year_month = ?)), 0)::integer AS plan
                FROM user_plans AS up 
                WHERE up.user_id = ? AND to_char(up.created_at, 'MM.YYYY') = ?
                ORDER BY up.created_at
                LIMIT 1",
                    [Auth::id(), $dy, $month, Auth::id(), $month]
                )[0];
        } catch (\Throwable $th) {
            return new class
            {
                public $plan = 0;
                public $fact = 0;
            };
        }
    }

    private function getMonthMedicine()
    {
        // DATE(SUBSTRING(cl.year_month from 4 for 7) || '-' || SUBSTRING(cl.year_month FROM 1 for 2) || '-' ||  '01') = DATE(date_trunc('month', now()))  
        $monthStart = Carbon::parse()->startOfMonth()->format('Y-m-d');
        $monthEnd = Carbon::parse()->endOfMonth()->format('Y-m-d');
        $month = date('Y-m');
        try {
            return DB::select("SELECT
                md.id,
                md.name,
                pl.number AS plan,
                COALESCE((SELECT SUM(pr.number) FROM tg_productssold AS pr WHERE pr.user_id = ? AND pr.medicine_id = md.id AND DATE(pr.created_at) BETWEEN ? AND ?), 0) AS fact
                FROM tg_medicine AS md
                LEFT JOIN tg_plans AS pl ON pl.medicine_id = md.id
                WHERE to_char(pl.created_at, 'YYYY-MM') = ? AND pl.user_id = ?
                GROUP BY md.id, pl.number
                ORDER BY md.id
            ", [Auth::id(), $monthStart, $monthEnd, $month, Auth::id()]);
        } catch (\Throwable $th) {
            return [];
        }
    }

    private function getWeeklyMedicine()
    {
        $now = date("Y-m-d");
        try {
            return DB::select("SELECT
                md.id,
                md.name,
                pw.plan AS plan,
                COALESCE((SELECT SUM(pr.number) FROM tg_productssold AS pr WHERE pr.user_id = ? AND pr.medicine_id = md.id AND DATE(pr.created_at) BETWEEN DATE(pw.startday) AND DATE(pw.endday)), 0) AS fact
                FROM tg_medicine AS md
                LEFT JOIN tg_planweeks AS pw ON pw.medicine_id = md.id
                WHERE DATE(pw.startday) <= ? AND DATE(pw.endday) >= ? AND pw.user_id = ?
                GROUP BY md.id, pw.plan, pw.startday, pw.endday
                ORDER BY md.id
            ", [Auth::id(), $now, $now, Auth::id()]);
        } catch (\Throwable $th) {
            return [];
        }
    }

    private function getDailyMedicine($day = null)
    {
        $dy = $day ? date("Y-m") . "-$day" : date("Y-m-d");
        $month = date("m.Y");
        try {
            return DB::select("SELECT
                md.id,
                md.name,
                COALESCE(CEILING((pl.number + 0.0) / (SELECT work_day FROM tg_calendar AS cl WHERE cl.year_month = ?)), 0)::integer AS plan,
                COALESCE((SELECT SUM(pr.number) FROM tg_productssold AS pr WHERE pr.user_id = ? AND pr.medicine_id = md.id AND DATE(pr.created_at) = ?), 0) AS fact
                FROM tg_medicine AS md
                LEFT JOIN tg_plans AS pl ON pl.medicine_id = md.id
                WHERE to_char(pl.created_at, 'MM.YYYY') = ? AND pl.user_id = ?
                GROUP BY md.id, pl.number
                ORDER BY md.id
            ", [$month, Auth::id(), $dy, $month, Auth::id()]);
        } catch (\Throwable $th) {
            return [];
        }
    }
}
