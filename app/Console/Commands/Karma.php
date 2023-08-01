<?php

namespace App\Console\Commands;

use App\Models\Shift;
use App\Models\TeamBattleKarma;
use App\Services\TeamBattleServices;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Karma extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:karmaball';

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
        $month = getMonthName(date("F"));
        $start = date("Y-m-d");
        $end = date("Y-m-d");
        $teamService = new TeamBattleServices(Auth::id());
        $teamBtl = $teamService->getTeamBattle($start, $end);
        $isTeamBattleBegin = $teamBtl->isTeamBattleBegin;
        $haveIGotTeam = $teamBtl->haveIGotTeam;
        if ($haveIGotTeam && $isTeamBattleBegin) {
            $amIinTeamOne = $teamService->amIinTeamOne;
            $team1 = $teamBtl->team1;
            $team2 = $teamBtl->team2;
            $myTeamBattle = $teamBtl->my_team_battle[0];
            if ($amIinTeamOne) {
                $sum1 = $teamService->sum($start, $end, $teamBtl->my_team_battle[0]->team1->id)[0]->allprice;
                $sum2 = $teamService->sum($start, $end, $teamBtl->my_team_battle[0]->team2->id)[0]->allprice;
            } else {
                $sum2 = $teamService->sum($start, $end, $teamBtl->my_team_battle[0]->team1->id)[0]->allprice;
                $sum1 = $teamService->sum($start, $end, $teamBtl->my_team_battle[0]->team2->id)[0]->allprice;
            }
            $months = $teamService->teamBattleMonths();
            $len = count($months);
            $month = getMonthName(date("F"));
            for ($i = $len - 1; $i >= 0; $i--) {
                $month = $months[$i];
                $monthlySum = 0;
                $startOfMonth = Carbon::parse($month->m)->startOfMonth()->format("Y-m-d");
                $endOfMonth = Carbon::parse($month->m)->endOfMonth()->format("Y-m-d");
                if ($amIinTeamOne) {
                    $monthlySum = $teamService->sum($startOfMonth, $endOfMonth, $teamBtl->my_team_battle[0]->team1->id)[0]->allprice;
                } else {
                    $monthlySum = $teamService->sum($startOfMonth, $endOfMonth, $teamBtl->my_team_battle[0]->team2->id)[0]->allprice;
                }
                $months[] = [
                    "month" => getMonthName(date("F", strtotime($months[$i]->m))),
                    "count" => $months[$i]->c,
                    'sum' => $monthlySum
                ];
            }

            $dt = date('2023-06-27');
            $ff = [];
            $tashqi = 0;
            $jamoaviy = 0;
            foreach ($team1 as $key => $value) {
                $distiplina = Shift::where('user_id',$value->id)->whereDate('open_date',$dt)->exists();
                if($distiplina)
                {
                    $new = TeamBattleKarma::create([
                        'team_id' => $myTeamBattle->team1_id,
                        'user_id' => $value->id,
                        'karma' => 1,
                        'comment' => 'Distiplina uchun',
                        'active' => 1,
                    ]);
                }else{
                    $new = TeamBattleKarma::create([
                        'team_id' => $myTeamBattle->team1_id,
                        'user_id' => $value->id,
                        'karma' => -1,
                        'comment' => 'Ishga chiqmaganligi uchun',
                        'active' => 1,
                    ]);
                }
                if(date('w') == 0 && $distiplina)
                {
                    $prodaja = DB::table('tg_productssold as p')
                    ->selectRaw('COALESCE(SUM(p.number * p.price_product),0) as prodaja')
                    ->where('p.user_id', $value->id)
                    ->whereDate('p.created_at', $dt)
                    ->value('prodaja');
                    
                    if($prodaja >= 500000)
                    {
                        $new = TeamBattleKarma::create([
                                    'team_id' => $myTeamBattle->team1_id,
                                    'user_id' => $value->id,
                                    'karma' => 2,
                                    'comment' => 'Yakshanba kuni savdoni 500 mingdan oshirganligi uchun',
                                    'active' => 1,
                                ]);
                    }
                }

                $prodaja = DB::table('tg_productssold as p')
                    ->selectRaw('COALESCE(SUM(p.number * p.price_product),0) as prodaja')
                    ->where('p.user_id', $value->id)
                    ->whereDate('p.created_at', $dt)
                    ->value('prodaja');
                
                $jamoaviy += $prodaja;

                

                $prodajatashqi = DB::table('tg_productssold as p')
                    ->selectRaw('COALESCE(SUM(p.number * p.price_product),0) as prodaja')
                    ->where('p.user_id', $value->id)
                    ->where('p.pharm_id', 42)
                    ->whereDate('p.created_at', $dt)
                    ->value('prodaja');
                
                $tashqi += $prodajatashqi;
                
            }

            if($jamoaviy >= 5000000)
                {
                    $new = TeamBattleKarma::create([
                        'team_id' => $myTeamBattle->team1_id,
                        'karma' => 10,
                        'comment' => 'Jamoa 1kunda 5 mlndan oshirganligi uchun',
                        'active' => 1,
                    ]);
                }
            
            if($tashqi >= 3000000)
            {
                $new = TeamBattleKarma::create([
                    'team_id' => $myTeamBattle->team1_id,
                    'karma' => 20,
                    'comment' => 'Jamoa 1kunda tashqi savdoda 3 mlndan oshirganligi uchun',
                    'active' => 1,
                ]);
            }


        }

    }
}
