<?php

namespace App\Services;

use App\Models\KingLiga;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KingSoldService
{
    public function kingSoldLigas($weekStartDate, $weekEndDate)
    {
        $ligas = [];
        $ligasInfo = KingLiga::orderBy('id', 'ASC')->get();

        foreach ($ligasInfo as $liga) {
            $ligas[$liga->name] = DB::select("SELECT
                u.id AS id,
                u.first_name AS f,
                u.last_name AS l,
                (
                (COALESCE(SUM(CASE WHEN DATE(k.created_at) BETWEEN ? AND ? THEN (CASE WHEN k.status = 1 THEN 1 ELSE 0.5 END) END),0) * 100000000) + 
                COALESCE((SELECT SUM(CASE WHEN DATE(p.created_at) BETWEEN ? AND ? THEN p.number * p.price_product END) FROM tg_productssold AS p WHERE p.user_id = u.id),0)
                ) AS total,
                COALESCE(SUM(CASE WHEN DATE(k.created_at) BETWEEN ? AND ? THEN (CASE WHEN k.status = 1 THEN 1 ELSE 0.5 END) END),0) AS count,
                (SELECT name FROM tg_region AS reg WHERE reg.id = u.region_id) AS r
                FROM tg_user AS u
                LEFT JOIN tg_order AS o ON o.user_id = u.id
                LEFT JOIN tg_king_sold AS k ON k.order_id = o.id
                LEFT JOIN user_king_liga AS ul ON ul.user_id = u.id
                WHERE k.admin_check = 1
                AND ul.king_liga_id = ?
                GROUP BY u.id
                ORDER BY total DESC", [$weekStartDate, $weekEndDate, $weekStartDate, $weekEndDate, $weekStartDate, $weekEndDate, $liga->id]);
        }
        return $ligas;
    }

    // public function kingSolds($weekStartDate, $weekEndDate)
    // {
    //     // $weekStartDate = '2023-03-10';
    //     // $weekEndDate = '2023-03-16';
    //     $startLM = Carbon::parse(strtotime("-1 month"))->startOfMonth()->format("Y-m-d");
    //     $endLM = Carbon::parse(strtotime("-1 month"))->endOfMonth()->format("Y-m-d");
    //     $ago30Day = date('Y-m-d', strtotime('-30 day'));
    //     $ligas = [];
    //     $ligasInfo = KingLiga::orderBy('id', 'ASC')->get();
    //     function exeptions($ligasInfo, $ligaTitle) {
    //         $exf = [];
    //         foreach ($ligasInfo as $liga) {
    //             if($ligaTitle != $liga->name) {
    //                 $exf = array_merge($exf, json_decode($liga->ex));
    //             }
    //         }
    //         return array_unique($exf);
    //     }
    //     foreach ($ligasInfo as $liga) {
    //         $ext = "";
    //         $exf = "";
    //         $exeptions = json_decode($liga->ex);
    //         $exF = exeptions($ligasInfo, $liga->name);
    //         $lenExt = count($exeptions);
    //         $lenExf = count($exF);

    //         $bindings = [$startLM, $endLM, $weekStartDate, $weekEndDate];
    //         if($lenExt == 0) {
    //             $ext = "?";
    //             $bindings[] = 0;
    //         } else {
    //             for ($i = 0; $i < $lenExt; $i++) {
    //                 if($i == $lenExt - 1) {
    //                     $ext .= "?";
    //                 } else {
    //                     $ext .= "?,";
    //                 }
    //                 $bindings[] = $exeptions[$i];
    //             }
    //         }
    //         $bindings = array_merge($bindings, [$startLM, $endLM, $liga->f, $liga->t, $liga->name, $ago30Day, $ago30Day]);
    //         if($lenExt == 0) {
    //             $bindings[] = 0;
    //         } else {
    //             for ($j = 0; $j < $lenExt; $j++) {
    //                 $bindings[] = $exeptions[$j];
    //             }
    //         }
    //         if($lenExf == 0) {
    //             $exf = "?";
    //             $bindings[] = 0;
    //         } else {
    //             for ($k = 0; $k < $lenExf; $k++) {
    //                 if($k == $lenExf - 1) {
    //                     $exf .= "?";
    //                 } else {
    //                     $exf .= "?,";
    //                 }
    //                 $bindings[] = $exF[$k];
    //             }
    //         }

    //         $ligas[$liga->name] = DB::select("SELECT
    //             u.id AS id,
    //             u.first_name AS f,
    //             u.last_name AS l,
    //             SUM(CASE WHEN k.status = 1 THEN 1 ELSE 0.5 END) AS count,
    //             COALESCE((SELECT SUM(CASE WHEN DATE(p.created_at) BETWEEN ? AND ? THEN p.number * p.price_product END) FROM tg_productssold AS p WHERE p.user_id = u.id),0) AS allprice,
    //             (SELECT name FROM tg_region AS reg WHERE reg.id = u.region_id) AS r
    //             FROM tg_user AS u
    //             LEFT JOIN tg_order AS o ON o.user_id = u.id
    //             LEFT JOIN tg_king_sold AS k ON k.order_id = o.id
    //             WHERE k.admin_check = 1
    //             AND DATE(k.created_at) >= ? AND DATE(k.created_at) <= ?
    //             AND CASE WHEN u.id NOT IN ($ext) THEN
    //             (
    //                 COALESCE((SELECT SUM(CASE WHEN DATE(p.created_at) BETWEEN ? AND ? THEN p.number * p.price_product END) FROM tg_productssold AS p WHERE p.user_id = u.id),0) BETWEEN ? AND ?
    //                 AND CASE WHEN ? = 'wood' THEN DATE(u.date_joined) > ? ELSE DATE(u.date_joined) < ? END
    //             )
    //             ELSE u.id IN ($ext) END
    //             AND u.id NOT IN ($exf)
    //             GROUP BY u.id
    //             ORDER BY count DESC", $bindings);
    //         // dd($ligas[$liga->name]);
    //     }



    //     return $ligas;
    // }
}
