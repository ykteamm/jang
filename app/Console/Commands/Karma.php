<?php

namespace App\Console\Commands;

use App\Models\Shift;
use App\Models\Team;
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
        $teams = Team::with('team_members')->get();

            $dt = date('Y-m-d');
            $tashqi = 0;
            $jamoaviy = 0;
            foreach ($teams as  $team) {
                foreach ($team->team_members as $key => $value) {
                
                    $distiplina = Shift::where('user_id',$value->user_id)->whereDate('open_date',$dt)->exists();
                    if($distiplina)
                    {
                        $new = TeamBattleKarma::create([
                            'team_id' => $team->id,
                            'user_id' => $value->user_id,
                            'karma' => 1,
                            'comment' => 'Distiplina uchun',
                            'active' => 1,
                        ]);
                    }else{
                        $new = TeamBattleKarma::create([
                            'team_id' => $team->id,
                            'user_id' => $value->user_id,
                            'karma' => -1,
                            'comment' => 'Ishga chiqmaganligi uchun',
                            'active' => 1,
                        ]);
                    }
                    if(date('w') == 0 && $distiplina)
                    {
                        $prodaja = DB::table('tg_productssold as p')
                        ->selectRaw('COALESCE(SUM(p.number * p.price_product),0) as prodaja')
                        ->where('p.user_id', $value->user_id)
                        ->whereDate('p.created_at', $dt)
                        ->value('prodaja');
                        
                        if($prodaja >= 500000)
                        {
                            $new = TeamBattleKarma::create([
                                        'team_id' => $team->id,
                                        'user_id' => $value->user_id,
                                        'karma' => 2,
                                        'comment' => 'Yakshanba kuni savdoni 500 mingdan oshirganligi uchun',
                                        'active' => 1,
                                    ]);
                        }
                    }

                    $prodaja = DB::table('tg_productssold as p')
                        ->selectRaw('COALESCE(SUM(p.number * p.price_product),0) as prodaja')
                        ->where('p.user_id', $value->user_id)
                        ->whereDate('p.created_at', $dt)
                        ->value('prodaja');
                    
                    $jamoaviy += $prodaja;

                

                    $prodajatashqi = DB::table('tg_productssold as p')
                        ->selectRaw('COALESCE(SUM(p.number * p.price_product),0) as prodaja')
                        ->where('p.user_id', $value->user_id)
                        ->where('p.pharm_id', 42)
                        ->whereDate('p.created_at', $dt)
                        ->value('prodaja');
                    
                    $tashqi += $prodajatashqi;
                
                }
            }

            if($jamoaviy >= 5000000)
                {
                    $new = TeamBattleKarma::create([
                        'team_id' => $team->id,
                        'karma' => 10,
                        'comment' => 'Jamoa 1kunda 5 mlndan oshirganligi uchun',
                        'active' => 1,
                    ]);
                }
            
            if($tashqi >= 3000000)
            {
                $new = TeamBattleKarma::create([
                    'team_id' => $team->id,
                    'karma' => 20,
                    'comment' => 'Jamoa 1kunda tashqi savdoda 3 mlndan oshirganligi uchun',
                    'active' => 1,
                ]);
            }

    }
}
