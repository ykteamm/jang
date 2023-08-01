<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ElchiBattleSetting;
use App\Services\UserBattleService;
use Illuminate\Support\Facades\DB;
class Battle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'battle:elchi';

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
        // $Store = date('l');
        // return $Store;
        $bser = $b->battle(date('Y-m-d'));
        
        $sunday = date('w');
        if($sunday != 0)
        {
            $bser = $b->battleDay(date('Y-m-d'));
        }
    }
}
