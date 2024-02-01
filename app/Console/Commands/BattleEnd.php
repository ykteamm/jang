<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ElchiBattleSetting;
use App\Models\NewUserOneMonth;
use App\Models\UserBattle;
use App\Services\BattleService;
use App\Services\NewUserOneMonthService;
use App\Services\UserBattleService;
use Illuminate\Support\Facades\DB;
class BattleEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'battleEnd:elchi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elchilarni jangini avtomat qilish';

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
        $b = new UserBattleService;

        $date = date('Y-m-d');

        $bser = $b->endBattle($date);
        $bser = $b->battle($date);
        
        $new_user_id = NewUserOneMonth::where('active',1)->pluck('user_id')->toArray();

        // if (count($new_user_id) > 0)
        // {
        //     foreach ($new_user_id as $key => $value) {
        //             $my_battle_all = UserBattle::with('u1ids','u2ids')
        //         ->where(function($query) use ($value){
        //                     $query->where('u1id',$value)
        //                     ->orWhere('u2id',$value);
        //                 })->get();

        //         if(count($my_battle_all) == 1)
        //         {
        //             $b = new NewUserOneMonthService;
        //             $bser = $b->firstFakeBattleDay($date);
        //             $bser = $b->endBattle($date);
        //         }
        //         if(count($my_battle_all) == 2)
        //         {
        //             $b = new NewUserOneMonthService;
        //             $bser = $b->secondFakeBattleDay($date);
        //             $bser = $b->endBattle($date);
        //         }
        //     }
            
        // }
        // $bser = $b->endBattle('2023-02-03');
        // $bser = $b->endBattle('2023-02-07');

    }
}
