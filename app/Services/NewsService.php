<?php

namespace App\Services;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NewsService
{
    public function king()
    {
        try {
            $startKingSold = "2023-02-03";
            $weekStartDate = date('Y-m-d', strtotime('-3 day', strtotime(Carbon::now()->startOfWeek()->format("Y-m-d"))));
            $weekEndDate = date('Y-m-d', strtotime('-3 day', strtotime(Carbon::now()->endOfWeek()->format("Y-m-d"))));
            // $weekStartDate = '2023-05-05';
            // $weekEndDate = '2023-05-11';
            $week = (int)((strtotime(date("Y-m-d")) - strtotime($startKingSold)) / (7 * 86400)) + 1;
            
            $desc = "<div>";
            $helper = new HelperServices;
            $ksolds = $helper->kingSolds($weekStartDate, $weekEndDate);

            foreach ($ksolds as $title => $liga) {
                $tbody = "";
                foreach ($liga as $key => $user) {
                    $tbody .= "<tr>
                                <td>$user->id</td>
                                <td>$user->f $user->f</td>
                                <td>$user->r</td>
                                <td>$user->count</th>
                            </tr>";
                }
                $tbody .= "<tr>
                                <td>33</td>
                                <td>Nargiza Kirgizova</td>
                                <td>Namangan</td>
                                <td>22</th>
                            </tr>";
                $table = "<div class='table-responsive border'>
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>FIO</th>
                                        <th>Viloyat</th>
                                        <th>Soni</th>
                                    </tr>
                                </thead>
                                <tbody>$tbody</tbody>
                            </table>
                        </div>";
                $desc .= "<div>
                            <h2 class='text-center my-3'>$title</h2>
                            <br/>
                            $table
                        </div>";
            }
            $desc .= "</div>";
            $desc = str_replace("\r\n", "", $desc);
            $desc = trim($desc);
            News::create([
                'title' => "Shox yurish natijalari $week",
                'img' => "https://jang.novatio.uz".'/mobile/news/teambattle.png',
                "desc" => $desc
            ]);
            return $desc;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public static function team()
    {
        try {
            $currentStartDate = DB::table('tg_team_battles')
                ->where('start_day', '<=', date("Y-m-d"))
                ->where('end_day', '>=', date("Y-m-d"))
                ->value('start_day') ?? date("Y-m-d");

            $oldEndDate = date('Y-m-d', strtotime('-1 day', strtotime($currentStartDate)));
            $oldStartDate = date('Y-m-d', strtotime('-7 day', strtotime($currentStartDate)));
            $lastWeekRound = DB::table('tg_team_battles')
                ->select('round', 'start_day', 'end_day')
                ->where('end_day', $oldEndDate)
                ->orWhere('start_day', $oldStartDate)
                ->limit(1)
                ->get()[0];
            $start = $lastWeekRound->start_day;
            $end = $lastWeekRound->end_day;
            $round = $lastWeekRound->round;
            $teamBtl = [];
            $teamBattles = DB::table('tg_team_battles')
                ->where('start_day', $start)
                ->get();
            $service = new TeamBattleServices(Auth::id());
            foreach ($teamBattles as $key => $battle) {
                $teamBtl[$key] = [];
                $teamBtl[$key]['round'] = $round;
                $teamBtl[$key]['team1'] = [
                    'name' => DB::table('tg_teams')->find($battle->team1_id)->name,
                    'members' => $service->getTeamMembers($start, $end, $battle->team1_id),
                    'sum' => $service->sum($start, $end, $battle->team1_id)[0]->allprice
                ];
                $teamBtl[$key]['team2'] = [
                    'name' => DB::table('tg_teams')->find($battle->team2_id)->name,
                    'members' => $service->getTeamMembers($start, $end, $battle->team2_id),
                    'sum' => $service->sum($start, $end, $battle->team2_id)[0]->allprice
                ];
            }
            $desc = "<div class='py-4'>";
            foreach ($teamBtl as $key => $item) {
                $team1name = $item['team1']['name'];
                $team1sum = $item['team1']['sum'];
                $team2name = $item['team2']['name'];
                $team2sum = $item['team2']['sum'];
                $round = $item['round'];
                $team1members = "";
                $team2members = "";
                foreach ($item['team1']['members'] as $user){
                    $team1members .= "<tr>
                        <td>$user->f</td>
                        <td>$user->allprice</td>
                    </tr>";
                }
                foreach ($item['team2']['members'] as $user){
                    $team2members .= "<tr>
                        <td>$user->f</td>
                        <td>$user->allprice</td>
                    </tr>";
                }
                $desc .= " <div class='col-12 px-0 py-3 my-5'>
                <div class='card mb-3'>
                    <div class='card-body p-0 bg-light'>
                        <div class='btn btn-sm btn-secondary p-1 w-100'>
                            <div class='row py-2'>
                                <div class='col-4 align-items-center pr-0'>
                                    <div style='font-size:12px;font-weight:600'>
                                        $team1name
                                    </div>
                                    <div class='mt-1 w-100' style='font-weight: 600'>
                                        $team1sum
                                    </div>
                                </div>
                                <div class='col-4 d-flex align-items-center' style='font-weight:600'>
                                    $round - round
                                </div>
                                <div class='col-4 align-items-center pl-0'>
                                    <div style='font-size:12px;font-weight:600;text-align:end'>
                                        $team2name
                                        </div>
                                    <div class='mt-1 w-100' style='text-align:end;font-weight: 600'>
                                        $team2sum
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row py-2'>
                            <div class='col-6 align-items-center' style='padding-right: 2px'>
                                <div class='table-responsive'>
                                    <table class='table border' style='font-size:12px !important'>
                                        <thead>
                                            <tr>
                                                <th>Ism</th>
                                                <th>Prodaja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            $team1members
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class='col-6 align-items-center' style='padding-left: 2px'>
                                <div class='table-responsive'>
                                    <table class='table border' style='font-size:12px !important'>
                                        <thead>
                                            <tr>
                                                <th>Ism</th>
                                                <th>Prodaja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            $team2members
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
            }
            $desc .= "</div>";
            $desc = str_replace("\r\n", "", $desc);
            $desc = trim($desc);
            News::create([
                'title' => "Jamoaviy jang natijalari $round - round",
                'img' => "https://jang.novatio.uz".'/mobile/news/kingsold.png',
                "desc" => $desc
            ]);
            return $desc;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
