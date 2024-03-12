<?php

namespace App\Services;

use App\Models\Blacklist;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Lock
{
    public $joined;
    public $prodaja = 0;
    public $day = 0;
    public $hour = 0;
    public $mayBeLocked = false;
    public $weeks;
    public $isLocked = false;
}

class LockService
{
    private $startOneMonAgo;
    private $endOneMonAgo;
    private $startTwoMonAgo;
    private $endTwoMonAgo;
    private $dateDiff;

    public function __construct()
    {
        $this->dateDiff = strtotime(Carbon::parse()->endOfMonth()->format("Y-m-d")) - strtotime(now());
        $this->startOneMonAgo = Carbon::parse(strtotime("-1 month"))->startOfMonth()->format("Y-m-d");
        $this->endOneMonAgo = Carbon::parse(strtotime("-1 month"))->endOfMonth()->format("Y-m-d");
        $this->startTwoMonAgo = Carbon::parse(strtotime("-2 month"))->startOfMonth()->format("Y-m-d");
        $this->endTwoMonAgo = Carbon::parse(strtotime("-2 month"))->endOfMonth()->format("Y-m-d");
    }
    public function init($id)
    {
        $oneMonAgoProdaja = $this->oneMonthAgoProdaja($id);
        $twoMonAgoProdaja = $this->twoMonthAgoProdaja($id);
        $lock = new Lock;
        if ($oneMonAgoProdaja && $twoMonAgoProdaja) {
            $lock->joined = $oneMonAgoProdaja->joined;
            $lock->prodaja = $oneMonAgoProdaja->prodaja;
            $lock->day = (int)round($this->dateDiff / 86400);
            $lock->hour = (int)round(($this->dateDiff % 86400) / 3600);
            $lock->mayBeLocked = $lock->joined < date("Y-m-d", strtotime("-2 month")) && $lock->prodaja < 10_000_000;
            $willBeLocked = $lock->joined < date("Y-m-d", strtotime("-2 month")) && $lock->joined < date("Y-m-d", strtotime("-2 month")) && $lock->prodaja < 10_000_000 && $twoMonAgoProdaja->prodaja < 10_000_000;
            if ($willBeLocked) {
                $lockUser = Blacklist::where('user_id', Auth::id())->first();
                if ($lockUser) {
                    $startThisMonth = Carbon::now()->startOfMonth()->format("Y-m-d");
                    $startLockedUserMonth = Carbon::parse($lockUser->created_at)->startOfMonth()->format("Y-m-d");
                    if ($startThisMonth != $startLockedUserMonth) {
                        Blacklist::where('user_id', Auth::id())->where('id', $lockUser->id)->update([
                            'active' => 1
                        ]);
//                        DB::table('tg_user')->where('id',Auth::id())->update([
//                            'status'=>4
//                        ]);
                    }
                } else {
                    Blacklist::create([
                        'user_id' => Auth::id(),
                        'active' => 1
                    ]);
//                    DB::table('tg_user')->where('id',Auth::id())->update([
//                        'status'=>4
//                    ]);
                }
            }
            if ($lockUser = Blacklist::where('user_id', Auth::id())->first()) {
                if ($lockUser->active == 1) {
                    $lock->isLocked = true;
                } else {
                    $lock->isLocked = false;
                }
            }
            $lock->weeks = $this->weeklyProdaja($id);
        }
        return $lock;
    }

    private function weeklyProdaja($id)
    {
        $weeks = $this->weekDays();
        foreach ($weeks as $week => $value) {
            try {
                $weeks[$week]['sum'] = DB::table("tg_productssold AS p")
                    ->selectRaw("SUM(p.number * p.price_product) AS prodaja")
                    ->whereBetween('p.created_at', [$value['start'], $value['end']])
                    ->where('p.user_id', $id)
                    ->first()->prodaja ?? 0;
            } catch (\Throwable $th) {
                $weeks[$week]['sum'] = 0;
            }
        }
        return $weeks;
    }

    private function weekDays()
    {
        $startM = Carbon::now()->startOfMonth()->format("Y-m-d");
        $endM = Carbon::now()->endOfMonth()->format("Y-m-d");
        $endWeek = Carbon::parse($startM)->endOfWeek()->format("Y-m-d");

        $weeks = [];
        for ($i = 1; $i < 5; $i++) {
            $week = "$i-hafta";
            $weeks[$week] = [];
            switch ($i) {
                case 1:
                    $weeks[$week]['start'] = $startM;
                    if ((strtotime($endWeek) - strtotime($startM)) > 4 * 86400) {
                        $weeks[$week]['end'] = $endWeek;
                    } else {
                        $weeks[$week]['end'] = date("Y-m-d", strtotime("+7 day", strtotime($endWeek)));
                    }
                    break;
                case 2:
                    $weeks[$week]['start'] = date("Y-m-d", strtotime("+1 day", strtotime($weeks['1-hafta']['end'])));
                    $weeks[$week]['end'] = date("Y-m-d", strtotime("+7 day", strtotime($weeks['1-hafta']['end'])));
                    break;
                case 3:
                    $weeks[$week]['start'] = date("Y-m-d", strtotime("+1 day", strtotime($weeks['2-hafta']['end'])));
                    $weeks[$week]['end'] = date("Y-m-d", strtotime("+7 day", strtotime($weeks['2-hafta']['end'])));
                    break;
                case 4:
                    $weeks[$week]['start'] = date("Y-m-d", strtotime("+1 day", strtotime($weeks['3-hafta']['end'])));
                    $weeks[$week]['end'] = $endM;
                    break;
            }
        }
        return $weeks;
    }

    private function oneMonthAgoProdaja($id)
    {
        try {
            return DB::select("SELECT
            COALESCE(SUM(CASE WHEN DATE(p.created_at) BETWEEN ? AND ? THEN p.number * p.price_product END), 0) AS prodaja,
            u.date_joined AS joined
            FROM tg_productssold AS p
            LEFT JOIN tg_user AS u ON u.id = p.user_id
            WHERE u.id = ?
            GROUP BY u.date_joined
            ", [$this->startOneMonAgo, $this->endOneMonAgo, $id])[0];
        } catch (\Throwable $th) {
            return null;
        }
    }
    private function twoMonthAgoProdaja($id)
    {
        try {
            return DB::select("SELECT
            COALESCE(SUM(CASE WHEN DATE(p.created_at) BETWEEN ? AND ? THEN p.number * p.price_product END), 0) AS prodaja,
            u.date_joined AS joined
            FROM tg_productssold AS p
            LEFT JOIN tg_user AS u ON u.id = p.user_id
            WHERE u.id = ?
            GROUP BY u.date_joined
            ", [$this->startTwoMonAgo, $this->endTwoMonAgo, $id])[0];
        } catch (\Throwable $th) {
            return null;
        }
    }
}
