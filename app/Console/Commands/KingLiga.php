<?php

namespace App\Console\Commands;

use App\Services\HelperServices;
use App\Services\KingSoldService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class KingLiga extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kingsold:liga';

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
        $weekStartDate = date('Y-m-d', strtotime('-3 day', strtotime(Carbon::now()->startOfWeek()->format("Y-m-d"))));
        $weekEndDate = date('Y-m-d', strtotime('-3 day', strtotime(Carbon::now()->endOfWeek()->format("Y-m-d"))));
        try {
            $helper = new KingSoldService;
            $ligas = $helper->kingSoldLigas($weekStartDate, $weekEndDate);
            foreach ($ligas as $liga => $users) {
                if ($liga == 'gold') {
                    // for ($i = 0; $i < $len; $i++) {
                    //     if ($i == $len - 1 && $len >= 3) {
                    //         DB::table('user_king_liga')->where('user_id', $users[$i]->id)->update([
                    //             'king_liga_id' => $users[$i]->king_liga_id + 1,
                    //         ]);
                    //     }
                    // }
                } else if ($liga == 'silver') {
                    if(isset($users[0])) {
                        if($users[0]->count > 30) {
                            DB::table('user_king_liga')->where('user_id', $users[0]->id)->update([
                                'inc' => true
                            ]);
                        }
                    }
                    // for ($i = 0; $i < $len; $i++) {
                        // if ($i == 0 && $len >= 1) {
                        // }
                        // if (($i == $len - 1 || $i == $len - 2 || $i == $len - 3) && $len >= 5) {
                        //     DB::table('user_king_liga')->where('user_id', $users[$i]->id)->update([
                        //         'king_liga_id' => $users[$i]->king_liga_id + 1,
                        //     ]);
                        // }
                    // }
                } else if ($liga == 'bronze') {
                    if(isset($users[0])) {
                        if($users[0]->count > 20) {
                            DB::table('user_king_liga')->where('user_id', $users[0]->id)->update([
                                'inc' => true
                            ]);
                        }
                    }
                    // for ($i = 0; $i < $len; $i++) {
                    //     if ($i == 0 && $len >= 1) {   
                    //     }
                    //     if (($i == $len - 1 || $i == $len - 2 || $i == $len - 3) && $len >= 5) {
                    //         DB::table('user_king_liga')->where('user_id', $users[$i]->id)->update([
                    //             'king_liga_id' => $users[$i]->king_liga_id + 1,
                    //         ]);
                    //     }
                    // }
                } else if ($liga == 'wood') {
                    if(isset($users[0])) {
                        if($users[0]->count > 12) {
                            DB::table('user_king_liga')->where('user_id', $users[0]->id)->update([
                                'inc' => true
                            ]);
                        }
                    }
                    // for ($i = 0; $i < $len; $i++) {
                    //     if ($i == 1 && $len >= 5) {
                    //     }
                    // }
                }
            }
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
}
