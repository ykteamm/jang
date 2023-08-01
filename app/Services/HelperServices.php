<?php

namespace App\Services;

use App\Items\MoneyItems;
use App\Items\MyBattleItems;
use App\Items\TimeItems;
use App\Models\AllSold;
use App\Models\BonusKingSoldForUser;
use App\Models\KingLiga;
use App\Models\KingSold;
use App\Models\KingSoldBattle;
use App\Models\Pharmacy;
use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HelperServices
{

    public function kingSoldDay($time)
    {
        $weekStartDate = Carbon::now()->startOfWeek()->format('Y-m-d');
        $weekEndDate = Carbon::now()->endOfWeek()->format('Y-m-d');
        // $weekEndDate = date('Y-m-d',(strtotime ( '-2 day' , strtotime ( Carbon::now()->endOfWeek()->format('Y-m-d')) ) ));
        $ksdays = getKSDay();
        $ksnumber = getKSN() + 9;
        if ($time == 'Shu hafta') {
            // $date_begin = Carbon::now()->startOfWeek()->format('Y-m-d');
            // $date_end = date('Y-m-d',(strtotime ( '-2 day' , strtotime ( $weekEndDate ) ) ));
            $date_begin = $ksdays['this_start'];
            $date_end = $ksdays['this_end'];
            $dateText = 'Shu hafta';
            $ksnumber = getKSN() + 9;
        }
        if ($time == 'Oldingi hafta') {
            // $date_begin = date('Y-m-d',(strtotime ( '-7 day' , strtotime ( $weekStartDate ) ) ));
            // $date_end = date('Y-m-d',(strtotime ( '-9 day' , strtotime ( $weekEndDate ) ) ));
            $date_begin = $ksdays['last_start'];
            $date_end = $ksdays['last_end'];
            $dateText = 'Oldingi hafta';
            $ksnumber = $ksnumber - 1;
        }
        if ($time == 'Oldingidan oldingi') {
            // $date_begin = date('Y-m-d',(strtotime ( '-14 day' , strtotime ( $weekStartDate   ) ) ));
            // $date_end = date('Y-m-d',(strtotime ( '-16 day' , strtotime ( $weekEndDate ) ) ));
            $date_begin = '2023-01-30';
            $date_end = '2023-02-04';
            $dateText = 'Oldingidan oldingi';
            $ksnumber = $ksnumber - 2;
        }
        $item = new TimeItems();
        $item->ksnumber = $ksnumber;
        $item->date_begin = $date_begin;
        $item->date_end = $date_end;
        $item->dateText = $dateText;
        return $item;
    }
    public function day($time, $end)
    {
        $date_now = date('Y-m-d');

        if ($time == 'Bugun') {
            $date_begin = $date_now;
            $date_end = $date_now;
            $dateText = 'Bugun';
        } elseif ($time == 'Kecha') {
            $date_begin = date('Y-m-d', (strtotime('-1 day', strtotime($date_now))));
            $date_end = date('Y-m-d', (strtotime('-1 day', strtotime($date_now))));
            $dateText = 'Kecha';
        } elseif ($time == 'O\'tgan kun') {
            $date_begin = date('Y-m-d', (strtotime('-2 day', strtotime($date_now))));
            $date_end = date('Y-m-d', (strtotime('-2 day', strtotime($date_now))));
            $dateText = 'O\'tgan kun';
        } elseif ($time == 'Oxirgi 7 kun') {
            $date_begin = date('Y-m-d', (strtotime('-7 day', strtotime($date_now))));
            $date_end = date('Y-m-d', (strtotime('-1 day', strtotime($date_now))));
            $dateText = 'Oxirgi 7 kun';
        } elseif ($time == 'Oxirgi 30 kun') {
            $date_begin = date('Y-m-d', (strtotime('-30 day', strtotime($date_now))));
            $date_end = date('Y-m-d', (strtotime('-1 day', strtotime($date_now))));
            $dateText = 'Oxirgi 30 kun';
        } elseif ($time == 'Shu hafta') {
            $date_begin =  Carbon::now()->startOfWeek()->format('Y-m-d');
            $date_end = $date_now;
            $dateText = 'Shu hafta';
        } elseif ($time == 'Shu oy') {
            $date_begin =  Carbon::now()->startOfMonth()->format('Y-m-d');
            $date_end = $date_now;
            $dateText = 'Shu oy';
        } elseif ($time == 'Shu yil') {
            $date_begin =  Carbon::now()->startOfYear()->format('Y-m-d');
            $date_end = $date_now;
            $dateText = 'Shu yil';
        } elseif ($time == 'Oldingi yil') {
            $date_begin = new Carbon('first day of last year');
            $date_begin = $date_begin->startOfYear()->format('Y-m-d');
            $date_end = new Carbon('last day of last year');
            $date_end = $date_end->endOfYear()->format('Y-m-d');
            $dateText = 'Oldingi yil';
        } elseif ($time == 'Hammasi') {
            $date_begin = Carbon::now()->format('1790-01-01');
            $date_end = $date_now;
            $dateText = 'Hammasi';
        } elseif ($time != null && $end == null) {
            $date_begin = Carbon::parse($time)->startOfDay()->format('Y-m-d');
            $date_end = Carbon::parse($time)->endOfDay()->format('Y-m-d');
            $dateText = 'Bugun';
        } elseif ($time == null && $end != null) {
            $date_begin = Carbon::parse($end)->startOfDay()->format('Y-m-d');
            $date_end = Carbon::parse($end)->endOfDay()->format('Y-m-d');
            $dateText = 'Date';
        } elseif ($time != null && $end != null) {
            $date_begin = Carbon::parse($time)->startOfDay()->format('Y-m-d');
            $date_end = Carbon::parse($end)->endOfDay()->format('Y-m-d');
            $dateText = 'Interval';
        } else {
            $date_begin = $date_now;
            $date_end = $date_now;
            $dateText = 'Bugun';
        }
        $item = new TimeItems();
        $item->date_begin = $date_begin;
        $item->date_end = $date_end;
        $item->dateText = $dateText;
        return $item;
    }
    
    public function kingSolds($weekStartDate, $weekEndDate)
    {
        // $weekStartDate = '2023-03-10';
        // $weekEndDate = '2023-03-16';
        $joined = strtotime(Auth::user()->date_joined);
        $now = strtotime(now());
        $interval = round(($now-$joined) / 86400);
        $ligas = [];
        $ligasInfo = KingLiga::orderBy('id', 'ASC')->get();
        if($interval < 30) {
            $userliga = DB::table('user_king_liga')->where('user_id', Auth::id())->first();
            if(!$userliga) {
                $liga = KingLiga::orderBy('id', 'DESC')->first();
                DB::table('user_king_liga')->insert([
                    'user_id' => Auth::id(),
                    'king_liga_id' => $liga->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $userliga = DB::table('user_king_liga')->where('user_id', Auth::id())->first();
            }
            $ligasInfo = KingLiga::where('id','>=', $userliga->king_liga_id)->orderBy('id', 'ASC')->get();
        }

        foreach ($ligasInfo as $liga) {
            $ligas[$liga->name] = DB::select("SELECT
                u.id AS id,
                u.first_name AS f,
                u.last_name AS l,
                SUM(CASE WHEN k.status = 1 THEN 1 ELSE 0.5 END) AS count,
                (SELECT name FROM tg_region AS reg WHERE reg.id = u.region_id) AS r
                FROM tg_user AS u
                LEFT JOIN tg_order AS o ON o.user_id = u.id
                LEFT JOIN tg_king_sold AS k ON k.order_id = o.id
                LEFT JOIN user_king_liga AS ul ON ul.user_id = u.id
                WHERE k.admin_check = 1
                AND DATE(k.created_at) BETWEEN ? AND ?
                AND ul.king_liga_id = ?
                GROUP BY u.id
                ORDER BY count DESC", [$weekStartDate, $weekEndDate, $liga->id]);
        }
        return $ligas;
    }
    
    public function viewCheck($user_id, $date_begin, $date_end)
    {
        // $ligas[$title] = DB::table('tg_user AS u')
        //     ->select(DB::raw('u.id AS id'),
        //     DB::raw('u.first_name AS f'),
        //     DB::raw('u.last_name AS l'),
        //     DB::raw('SUM(CASE WHEN k.status = 1 THEN 1 ELSE 0.5 END) AS count'),
        //     DB::raw('COALESCE((SELECT SUM(CASE WHEN DATE(p.created_at) BETWEEN ? AND ? THEN p.number * p.price_product END) FROM tg_productssold AS p WHERE p.user_id = u.id),0) AS allprice'),
        //     DB::raw('(SELECT name FROM tg_region AS reg WHERE reg.id = u.region_id) AS r')
        // )->leftJoin('tg_order AS o', 'o.user_id', 'u.id')
        // ->leftJoin('tg_king_sold AS k', 'k.order_id', 'o.id')
        // ->where('k.created_at', '>=', "ssss")
        // ->where('k.created_at', '<=', "ssss")
        // ->where('k.admin_check', '=', 1)
        // ->when('', );
        $new_solds = KingSold::with(['order' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }, 'order.sold', 'order.sold.medicine', 'order.user'])
            ->whereDate('created_at', '>=', $date_begin)
            ->whereDate('created_at', '<=', $date_end)
            ->where('image', '!=', 'add')
            ->where('admin_check', 1)
            ->orderBy('id', 'DESC')->get();
        $solds = [];
        foreach ($new_solds as $key => $value) {
            if ($value->order != NULL) {
                $solds[] = $value;
            }
        }
        return $solds;
    }
    public function kingSold($weekStartDate, $weekEndDate)
    {
        // $weekStartDate = '2023-03-10';
        // $weekEndDate = '2023-03-16';
        $liga_user_id = DB::table('liga_king_users')->get();
        $king_array = [];
        foreach ($liga_user_id as $key => $value) {
            $king_sold = DB::table('tg_king_sold')
                ->selectRaw('count(tg_king_sold.id) as count')
                ->where('tg_king_sold.admin_check', 1)
                ->where('tg_king_sold.status', 1)
                ->whereDate('tg_king_sold.created_at', '>=', $weekStartDate)
                ->whereDate('tg_king_sold.created_at', '<=', $weekEndDate)
                ->where('tg_user.id', $value->user_id)
                ->join('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
                ->join('tg_user', 'tg_user.id', 'tg_order.user_id')
                ->get();
            if ($king_sold[0]->count == null) {
                $count = 0;
            } else {
                $count = $king_sold[0]->count;
            }

            $king_sold05 = DB::table('tg_king_sold')
                ->selectRaw('count(tg_king_sold.id) as count')
                ->where('tg_king_sold.admin_check', 1)
                ->where('tg_king_sold.status', 2)
                ->whereDate('tg_king_sold.created_at', '>=', $weekStartDate)
                ->whereDate('tg_king_sold.created_at', '<=', $weekEndDate)
                ->where('tg_user.id', $value->user_id)
                ->join('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
                ->join('tg_user', 'tg_user.id', 'tg_order.user_id')
                ->get();
            if ($king_sold05[0]->count == null) {
                $count05 = 0;
            } else {
                $count05 = $king_sold05[0]->count;
            }
            $all_count = $count + $count05 / 2;
            if ($all_count != 0) {
                $user = User::find($value->user_id);
                $region = Region::find($user->region_id);
                $king_array[] = array('id' => $user->id, 'lid' => $value->liga_id, 'f' => $user->first_name, 'l' => $user->last_name, 'count' => $all_count, 'r' => $region->name);
            }
        }
        array_multisort(array_column($king_array, 'count'), SORT_DESC, $king_array);

        return $king_array;
    }
    public function kingSold05($weekStartDate, $weekEndDate)
    {
        $king_sold = DB::table('tg_king_sold')
            ->selectRaw('count(tg_king_sold.id) as count,tg_order.user_id,tg_user.first_name as f,tg_user.last_name as l,tg_region.name as r,liga_king_users.liga_id as lid')
            ->where('tg_king_sold.admin_check', 1)
            ->where('tg_king_sold.status', 1)
            ->whereDate('tg_king_sold.created_at', '>=', $weekStartDate)
            ->whereDate('tg_king_sold.created_at', '<=', $weekEndDate)
            ->join('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
            ->join('tg_user', 'tg_user.id', 'tg_order.user_id')
            ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
            ->leftjoin('liga_king_users', 'liga_king_users.user_id', 'tg_user.id')
            ->orderBy('count', 'DESC')
            ->groupBy('tg_order.user_id', 'f', 'l', 'r', 'lid')
            ->get();
        return $king_sold;
    }
    public function regionKingSold($weekStartDate, $weekEndDate)
    {
        $side_array = [1, 2];
        $sides = [];
        foreach ($side_array as $key => $value) {
            $king_sold = DB::table('tg_king_sold')
                ->selectRaw('count(tg_king_sold.id) as count')
                ->where('tg_king_sold.admin_check', 1)
                ->where('tg_king_sold.status', 1)
                ->where('tg_region.side', $value)
                ->whereDate('tg_king_sold.created_at', '>=', $weekStartDate)
                ->whereDate('tg_king_sold.created_at', '<=', $weekEndDate)
                ->join('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
                ->join('tg_user', 'tg_user.id', 'tg_order.user_id')
                ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
                ->get();
            if ($king_sold[0]->count == null) {
                $count = 0;
            } else {
                $count = $king_sold[0]->count;
            }
            $king_sold05 = DB::table('tg_king_sold')
                ->selectRaw('count(tg_king_sold.id) as count')
                ->where('tg_king_sold.admin_check', 1)
                ->where('tg_king_sold.status', 2)
                ->where('tg_region.side', $value)
                ->whereDate('tg_king_sold.created_at', '>=', $weekStartDate)
                ->whereDate('tg_king_sold.created_at', '<=', $weekEndDate)
                ->join('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
                ->join('tg_user', 'tg_user.id', 'tg_order.user_id')
                ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
                ->get();
            if ($king_sold05[0]->count == null) {
                $count05 = 0;
            } else {
                $count05 = $king_sold05[0]->count;
            }
            $allcount = $count + $count05 / 2;
            $sides[] = array('count' => $allcount, 'side' => $value);
        }
        array_multisort(array_column($sides, 'count'), SORT_DESC, $sides);
        return $sides;
    }
    public function regionAllKingSold($weekStartDate, $weekEndDate)
    {
        $regions = DB::table('tg_region')->get();
        $king_array = [];
        foreach ($regions as $key => $value) {
            if (!in_array($value->id, [11, 14])) {

                $king_sold = DB::table('tg_king_sold')
                    ->selectRaw('count(tg_king_sold.id) as count')
                    ->where('tg_king_sold.admin_check', 1)
                    ->where('tg_king_sold.status', 1)
                    ->whereDate('tg_king_sold.created_at', '>=', $weekStartDate)
                    ->whereDate('tg_king_sold.created_at', '<=', $weekEndDate)
                    ->where('tg_region.id', $value->id)
                    ->join('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
                    ->join('tg_user', 'tg_user.id', 'tg_order.user_id')
                    ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
                    ->get();
                if ($king_sold[0]->count == null) {
                    $count = 0;
                } else {
                    $count = $king_sold[0]->count;
                }

                $king_sold05 = DB::table('tg_king_sold')
                    ->selectRaw('count(tg_king_sold.id) as count')
                    ->where('tg_king_sold.admin_check', 1)
                    ->where('tg_king_sold.status', 2)
                    ->whereDate('tg_king_sold.created_at', '>=', $weekStartDate)
                    ->whereDate('tg_king_sold.created_at', '<=', $weekEndDate)
                    ->where('tg_region.id', $value->id)
                    ->join('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
                    ->join('tg_user', 'tg_user.id', 'tg_order.user_id')
                    ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
                    ->get();
                if ($king_sold05[0]->count == null) {
                    $count05 = 0;
                } else {
                    $count05 = $king_sold05[0]->count;
                }
                $all_count = $count + $count05 / 2;
                if ($all_count != 0) {
                    $king_array[] = array('id' => $value->id, 'count' => $all_count, 'name' => $value->name);
                }
            }
        }

        $king_sold = DB::table('tg_king_sold')
            ->selectRaw('count(tg_king_sold.id) as count')
            ->where('tg_king_sold.admin_check', 1)
            ->where('tg_king_sold.status', 1)
            ->whereDate('tg_king_sold.created_at', '>=', $weekStartDate)
            ->whereDate('tg_king_sold.created_at', '<=', $weekEndDate)
            ->whereIn('tg_region.id', [11, 14])
            ->join('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
            ->join('tg_user', 'tg_user.id', 'tg_order.user_id')
            ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
            ->get();
        if ($king_sold[0]->count == null) {
            $count = 0;
        } else {
            $count = $king_sold[0]->count;
        }

        $king_sold05 = DB::table('tg_king_sold')
            ->selectRaw('count(tg_king_sold.id) as count')
            ->where('tg_king_sold.admin_check', 1)
            ->where('tg_king_sold.status', 2)
            ->whereDate('tg_king_sold.created_at', '>=', $weekStartDate)
            ->whereDate('tg_king_sold.created_at', '<=', $weekEndDate)
            ->whereIn('tg_region.id', [11, 14])
            ->join('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
            ->join('tg_user', 'tg_user.id', 'tg_order.user_id')
            ->join('tg_region', 'tg_region.id', 'tg_user.region_id')
            ->get();
        if ($king_sold05[0]->count == null) {
            $count05 = 0;
        } else {
            $count05 = $king_sold05[0]->count;
        }
        $all_count = $count + $count05 / 2;
        if ($all_count != 0) {
            $king_array[] = array('id' => 14, 'count' => $all_count, 'name' => 'Toshkent shahri');
        }
        array_multisort(array_column($king_array, 'count'), SORT_DESC, $king_array);

        return $king_array;
    }
    public function getKSBonus($weekStartDate, $weekEndDate)
    {
        $arr = BonusKingSoldForUser::whereDate('end_date', '=', $weekEndDate)
            ->pluck('bonus', 'user_id');
        return $arr;
    }
    public function myKSBattle($weekStartDate, $weekEndDate)
    {
        $my_id = Auth::user()->id;

        $myks_battle = KingSoldBattle::with('offer_uids', 'accept_uids')
            ->where(function ($query) use ($my_id) {
                $query->where('offer_uid', $my_id)
                    ->orWhere('accept_uid', $my_id);
            })
            ->whereDate('end_date', '>=', $weekStartDate)
            ->whereDate('end_date', '<=', $weekEndDate)
            ->get();
        return $myks_battle;
    }
    public function myKSBattleHistory()
    {
        $my_id = Auth::user()->id;

        $myks_battle = KingSoldBattle::with('offer_uids', 'accept_uids')
            ->where(function ($query) use ($my_id) {
                $query->where('offer_uid', $my_id)
                    ->orWhere('accept_uid', $my_id);
            })
            ->whereDate('end_date', '<', date('Y-m-d'))
            ->where('start', 1)
            ->get();
        return $myks_battle;
    }
    public function allKSBattleHistory($end_date)
    {
        $myks_battle = KingSoldBattle::with('offer_uids', 'accept_uids')
            ->whereDate('end_date', $end_date)
            ->where('start', 1)
            ->get();
        return $myks_battle;
    }
    public function allKSBattle($start_date, $end_date)
    {

        $my_id = Auth::user()->id;

        $all_ksb_battle = KingSoldBattle::with('offer_uids', 'accept_uids')
            ->where(function ($query) use ($my_id) {
                $query->where('offer_uid', '!=', $my_id)
                    ->where('accept_uid', '!=', $my_id);
            })
            ->whereDate('end_date', '>=', $start_date)
            ->whereDate('end_date', '<=', $end_date)
            ->orderBy('id', 'ASC')->get();
        return $all_ksb_battle;
    }
    public function hisobot($date_begin, $date_end)
    {
        $smena_id = DB::table('tg_smena')->where('user_id', Auth::id())
            ->whereDate('created_at', '>=', $date_begin)
            ->whereDate('created_at', '<=', $date_end)
            ->distinct()->pluck('pharm_id')->toArray();

        $shift_id = DB::table('tg_shift')->where('user_id', Auth::id())
            ->whereDate('created_at', '>=', $date_begin)
            ->whereDate('created_at', '<=', $date_end)
            ->distinct()->pluck('pharma_id')->toArray();
        $id_array = array_unique(array_merge($smena_id, $shift_id));

        $data = array();
        foreach ($id_array as $id) {
            $pharmacy_name = Pharmacy::where('id', $id)->value('name');
            $solds = DB::table('tg_productssold')
                ->whereDate('created_at', '>=', $date_begin)
                ->whereDate('created_at', '<=', $date_end)
                ->where('user_id', Auth::id())
                ->where('pharm_id', $id)
                ->get();
            $sum = 0;
            foreach ($solds as $key => $value) {
                $sum += $value->number * $value->price_product;
            }

            $smenas = DB::table('tg_smena')
                ->whereDate('created_at', '>=', $date_begin)
                ->whereDate('created_at', '<=', $date_end)
                ->where('user_id', Auth::id())
                // ->where('smena',2)
                ->where('pharm_id', $id)
                ->get();
            $shifts = DB::table('tg_shift')
                ->whereDate('created_at', '>=', $date_begin)
                ->whereDate('created_at', '<=', $date_end)
                ->where('user_id', Auth::id())
                ->where('active', 2)
                ->where('pharma_id', $id)
                ->get();
            $time = 0;
            foreach ($smenas as $key => $value) {
                if ($value->created_to == NULL) {
                    $time += 7;
                } else {
                    $time += (strtotime($value->created_to) - strtotime($value->created_from)) / 3600;
                }
            }
            foreach ($shifts as $key => $value) {
                $time += (strtotime($value->close_date) - strtotime($value->open_date)) / 3600;
            }
            $data[] = array('name' => $pharmacy_name, 'price' => $sum, 'time' => $time);
        }
        return $data;
    }
    public function medicine($date_begin, $date_end)
    {
        $medicine = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,SUM(tg_productssold.number) as number,tg_medicine.name as name')
            ->whereDate('tg_productssold.created_at', '>=', $date_begin)
            ->whereDate('tg_productssold.created_at', '<=', $date_end)
            ->where('tg_productssold.user_id', userme()->id)
            ->join('tg_medicine', 'tg_medicine.id', 'tg_productssold.medicine_id')
            ->orderBy('allprice', 'DESC')
            ->groupBy('name', 'number')->get();
        return $medicine;
    }
    public function allprice($date_begin, $date_end)
    {
        $allprice = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->whereDate('tg_productssold.created_at', '>=', $date_begin)
            ->whereDate('tg_productssold.created_at', '<=', $date_end)
            ->where('tg_productssold.user_id', userme()->id)
            ->get();
        return $allprice;
    }
    public function getBattle()
    {
        dd(123);
    }
    public function myBattle($my_battle, $sold_date)
    {
        if (count($my_battle) > 0) {
            if ($my_battle[0]->u1id == Auth::id()) {
                $summa1 = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                    ->whereDate('tg_productssold.created_at', '=', $sold_date)
                    ->where('tg_productssold.user_id', '=', $my_battle[0]->u1id)
                    ->groupBy('uid')->get();
                $summa2 = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                    ->whereDate('tg_productssold.created_at', '=', $sold_date)
                    ->where('tg_productssold.user_id', '=', $my_battle[0]->u2id)
                    ->groupBy('uid')->get();
                $summa_bugun1 = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                    ->whereDate('tg_productssold.created_at', '>=', $my_battle[0]->start_day)
                    ->whereDate('tg_productssold.created_at', '<=', Carbon::now())
                    ->where('tg_productssold.user_id', '=', $my_battle[0]->u1id)
                    ->groupBy('uid')->get();

                $summa_bugun2 = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                    ->whereDate('tg_productssold.created_at', '>=', $my_battle[0]->start_day)
                    ->whereDate('tg_productssold.created_at', '<=', Carbon::now())
                    ->where('tg_productssold.user_id', '=', $my_battle[0]->u2id)
                    ->groupBy('uid')->get();
            } else {
                $summa1 = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                    ->whereDate('tg_productssold.created_at', '=', $sold_date)
                    ->where('tg_productssold.user_id', '=', $my_battle[0]->u2id)
                    ->groupBy('uid')->get();
                $summa2 = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                    ->whereDate('tg_productssold.created_at', '=', $sold_date)
                    ->where('tg_productssold.user_id', '=', $my_battle[0]->u1id)
                    ->groupBy('uid')->get();
                $summa_bugun1 = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                    ->whereDate('tg_productssold.created_at', '>=', $my_battle[0]->start_day)
                    ->whereDate('tg_productssold.created_at', '<=', Carbon::now())
                    ->where('tg_productssold.user_id', '=', $my_battle[0]->u2id)
                    ->groupBy('uid')->get();

                $summa_bugun2 = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_productssold.user_id as uid')
                    ->whereDate('tg_productssold.created_at', '>=', $my_battle[0]->start_day)
                    ->whereDate('tg_productssold.created_at', '<=', Carbon::now())
                    ->where('tg_productssold.user_id', '=', $my_battle[0]->u1id)
                    ->groupBy('uid')->get();
            }
            $battle_start_day = $my_battle[0]->start_day;
        } else {
            $summa1 = 0;
            $summa2 = 0;
            $summa_bugun1 = 0;
            $summa_bugun2 = 0;
            $battle_start_day = Carbon::now();
        }
        $n = new MyBattleItems;
        $n->summa1 = $summa1;
        $n->summa2 = $summa2;
        $n->summa_bugun1 = $summa_bugun1;
        $n->summa_bugun2 = $summa_bugun2;
        $n->battle_start_day = $battle_start_day;
        return $n;
    }
    public function money()
    {
        $monthStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $monthEndDate = Carbon::now()->endOfMonth()->format('Y-m-d');

        $weekStartDate = Carbon::now()->startOfWeek()->format('Y-m-d');
        $weekEndDate = Carbon::now()->endOfWeek()->format('Y-m-d');
        $calendar = json_decode(DB::table('tg_calendar')->where('year_month', date('m.Y'))->first()->day_json);
        $all_true = DB::table('tg_calendar')->where('year_month', date('m.Y'))->value('work_day');
        $redline = myPlan(Auth::id());
        $protsent = 20;
        $protsent_medicine = 10;
        $last_day = 0;

        // dd($pul);

        $sunday_day = count($calendar) - $all_true;
        foreach ($calendar as $key => $value) {
            if (strlen($key + 1) == 1) {
                $d = '0' . ($key + 1);
            } else {
                $d = $key + 1;
            }
            if ($key + 1 == 1) {
                $day_solds = NULL;
            } else {
                $day_solds = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                    ->whereDate('tg_productssold.created_at', '>=', date('Y-m') . '-01')
                    ->whereDate('tg_productssold.created_at', '<', date('Y-m') . '-' . $d)
                    ->where('tg_productssold.user_id', Auth::id())
                    ->get()[0]->allprice;
            }
            $solds = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                ->whereDate('tg_productssold.created_at', date('Y-m') . '-' . $d)
                ->where('tg_productssold.user_id', Auth::id())
                ->get()[0]->allprice;
            if ($day_solds == NULL) {
                $day_solds = 0;
            }
            if ($solds == NULL) {
                $solds = 0;
            }
            $b = new UserBattleService;
            $bser = $b->deleteSundayForCalendar(date('Y-m') . '-01', date('Y-m') . '-' . $d);
            if ($all_true - $bser + 1 == 0) {
                $s = 1;
            } else {
                $s = $all_true - $bser + 1;
            }
            $day_money = round(($redline - $day_solds)) / ($s);

            if ($value == 'true') {
                $last_day = $last_day + 1;
            }

            if ($value == 'false') {
                $day_money = 0;
            } else {
                if (strtotime(date('Y-m') . '-' . $d) >= strtotime(date('Y-m-d'))) {
                    $bser = $b->deleteSundayForCalendar(date('Y-m') . '-01', date('Y-m-d'));
                    // dd($day_solds);
                    $ayir = $all_true - $bser;
                    if ($ayir == 0) {
                        $day_money = round(($redline - $day_solds));
                    } else {
                        $day_money = round(($redline - $day_solds)) / ($all_true - $bser);
                    }
                } else {
                    $day_money = round(($redline - $day_solds)) / ($s);
                }
            }



            $money_array[] = array('date' => date('Y-m') . '-' . $d, 'sold' => $solds, 'day_money' => round($day_money));
        }
        $transactions = AllSold::whereBetween('created_at', [$monthStartDate, $monthEndDate])
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->where('user_id', Auth::id())
            ->get();
        if (count($transactions) > 0) {
            $plan = round($transactions[0]->allprice / 5);
        } else {
            $plan = 0;
        }
        $month_solds = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->whereDate('tg_productssold.created_at', '>=', $monthStartDate)
            ->whereDate('tg_productssold.created_at', '<=', $monthEndDate)
            ->where('tg_productssold.user_id', Auth::id())
            ->get()[0]->allprice;

        $week_solds = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
            ->whereDate('tg_productssold.created_at', '>=', $weekStartDate)
            ->whereDate('tg_productssold.created_at', '<=', $weekEndDate)
            ->where('tg_productssold.user_id', Auth::id())
            ->get()[0]->allprice;
        if ($month_solds == NULL) {
            $month_solds = 0;
        }
        if ($redline > $month_solds) {

            // $week_solds = 100000;
            $week_money = $this->getIntervalDayMoney($money_array, $weekStartDate, $weekEndDate);
            // dd($week_money);
            // dd($week_solds);
            $my_date = date('Y-m-d');
            // if($week_solds >= $week_money)
            // {
            //     // $qoldiq = $redline - $month_solds;
            //     $day_money = round($redline/$all_true);


            //     $days = $this->dayCounter($my_date,$monthEndDate) - $this->deleteSunday($my_date,$monthEndDate);

            //     $money_array = $this->dayPlan($my_date,$weekEndDate,$days,$day_money*$days );

            //     $user_money = $month_solds/100*$protsent_medicine;
            // }else{
            $day_money = round($redline / $all_true);
            $days = 6;
            $money_array = $this->dayPlan($weekStartDate, $weekEndDate, $days, $day_money * 6);
            $user_money = maosh($month_solds);
            // }
            $day_money = round($redline / $all_true);
            $day_solds = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                ->whereDate('tg_productssold.created_at', '=', date('Y-m-d'))
                ->where('tg_productssold.user_id', Auth::id())
                ->get()[0]->allprice;
            if ($day_solds == NULL) {
                $day_solds = 0;
            }
            $day_plan = $day_money;
            $day_make = $day_solds;
        } else {
            $user_money = maosh($month_solds);
            $money_array = [];
            $day_plan = 0;
            $day_make = 0;
        }
        $day_money = round($redline / $all_true);

        $week_array = $this->dayPlan($weekStartDate, $weekEndDate, 7, $day_money * 7);

        // dd($week_array);
        // dd($money_array);

        // dd($soldis);
        $array_sold = array();
        $Variable1 = strtotime($monthStartDate);
        $Variable2 = strtotime(date('Y-m-d'));
        $soldis_sum = 0;
        $dategg = [];
        for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += (86400)) {
            $soldis = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                ->whereDate('tg_productssold.created_at', '=', date('Y-m-d', $currentDate))
                ->where('tg_productssold.user_id', Auth::id())
                ->get()[0]->allprice;

            //  $dategg[] = array('date' => date('Y-m-d',$currentDate), 'sold' => $soldis);


            if ($soldis == NULL) {
                $soldis = 0;
            }
            if (isset($no)) {
                if ($no == 0) {
                    $soldis_sum += $soldis;
                } else {
                    $soldis_sum += 0;
                }
            } else {
                if (isset($yes)) {
                    if ($yes == 1) {
                        $soldis_sum += 0;
                    } else {
                        $soldis_sum += $soldis;
                    }
                } else {
                    $soldis_sum += $soldis;
                }
            }
            if ($soldis_sum > $redline) {
                $dategg = [];

                $diff = $soldis_sum - $redline;

                if ($diff > 0) {
                    $sold_medicine = DB::table('tg_productssold')
                        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,SUM(tg_productssold.number) as number,tg_productssold.price_product,tg_medicine.name as name')
                        ->whereDate('tg_productssold.created_at', '=', date('Y-m-d', $currentDate))
                        ->where('tg_productssold.user_id', Auth::id())
                        ->join('tg_medicine', 'tg_medicine.id', 'tg_productssold.medicine_id')
                        ->orderBy('allprice', 'DESC')
                        ->groupBy('name', 'number', 'price_product')->get();

                    if (count($sold_medicine) > 0) {
                        $i = 0;
                        foreach ($sold_medicine as $key => $value) {
                            if ($value->price_product < $diff && $diff > 0) {
                                // $d = $
                                $f = floor($diff / $value->price_product);
                                // $g = $f+0.5;
                                if ($f > $value->number) {
                                    $diff = $diff - $value->price_product * $value->number;
                                    $value->allprice = 0;
                                    $value->number = 0;
                                    $soldis_sum = $soldis_sum -  $value->price_product * $f;
                                } else {
                                    $diff = $diff - $value->price_product * $f;
                                    $value->allprice = $value->allprice - $value->price_product * $f;
                                    $value->number = $value->number - $f;
                                    $soldis_sum = $soldis_sum -  $value->price_product * $f;
                                }
                            } else {
                                $i++;
                            }
                        }
                        $dategg[] = array('date' => $i);

                        if (count($sold_medicine) == $i) {
                            $no = 0;
                        } else {
                            $yes = 1;
                        }
                        // dd(count($sold_medicine));
                        // dd($i);
                        $array_sold[] = $sold_medicine;
                    }
                } else {
                    // $sold_medicine = DB::table('tg_productssold')
                    // ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,SUM(tg_productssold.number) as number,tg_productssold.price_product,tg_medicine.name as name')
                    // ->whereDate('tg_productssold.created_at','=',date('Y-m-d',$currentDate))
                    // ->where('tg_productssold.user_id',Auth::id())
                    // ->join('tg_medicine','tg_medicine.id','tg_productssold.medicine_id')
                    // ->orderBy('allprice','DESC')
                    // ->groupBy('name','number','price_product')->get();
                    // $array_sold[] = $sold_medicine;
                }
            }
        }
        // $sold_medicine = DB::table('tg_productssold')
        //             ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,SUM(tg_productssold.number) as number,tg_productssold.price_product,tg_medicine.name as name')
        //             ->whereDate('tg_productssold.created_at','=',date('2023-02-10'))
        //             ->where('tg_productssold.user_id',Auth::id())
        //             ->join('tg_medicine','tg_medicine.id','tg_productssold.medicine_id')
        //             ->orderBy('allprice','DESC')
        //             ->groupBy('name','number','price_product')->get();
        // dd($dategg);
        $fff = 0;
        foreach ($array_sold as $key => $value) {
            foreach ($value as $keyd => $valued) {
                $fff += $valued->allprice;
            }
        }
        // dd($fff);
        $n = new MoneyItems;
        $n->week_array = $week_array;
        $n->money_array = $money_array;
        $n->user_money = $user_money;
        $n->array_sold = $array_sold;
        $n->day_plan = $day_plan;
        $n->day_make = $day_make;
        return $n;
    }
    public function deleteSunday($start_index_day, $end_index_day)
    {
        $arrayDate = array();
        $Variable1 = strtotime($start_index_day);
        $Variable2 = strtotime($end_index_day);
        $sum = 0;
        for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += (86400)) {
            $Store = date('w', $currentDate);
            if ($Store == 0) {
                $sum += 1;
            }
        }
        return $sum;
    }
    public function dayCounter($start_index_day, $end_index_day)
    {
        $arrayDate = array();
        $Variable1 = strtotime($start_index_day);
        $Variable2 = strtotime($end_index_day);
        $sum = 0;
        for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += (86400)) {
            $sum += 1;
        }
        return $sum;
    }
    public function dayPlan($start_index_day, $end_index_day, $days, $summ)
    {
        // dd($days);
        $arrayDate = array();
        $Variable1 = strtotime($start_index_day);
        $Variable2 = strtotime($end_index_day);
        $array = [];
        for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += (86400)) {
            $date = date('Y-m-d', $currentDate);
            $solds = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                ->whereDate('tg_productssold.created_at', $date)
                ->where('tg_productssold.user_id', Auth::id())
                ->get()[0]->allprice;
            if ($solds == NULL) {
                $solds = 0;
            }
            $day_money = round($summ / $days);
            if (date('w', $currentDate) == 0) {
                $day_money = 0;
            }
            $array[] = array('date' => $date, 'sold' => $solds, 'day_money' => $day_money);
        }
        return $array;
    }
    public function getIntervalDayMoney($money_array, $weekStartDate, $weekEndDate)
    {
        $week_money = 0;
        foreach ($money_array as $m) {
            if ($weekStartDate <= $m['date'] && $weekEndDate >= $m['date']) {
                $week_money += $m['day_money'];
            }
        }
        return $week_money;
    }
}
