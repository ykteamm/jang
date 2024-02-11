<?php

namespace App\Console\Commands;

use App\Services\KingSoldBattleService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class KSBattle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ksb:battle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'King Sold Battle';

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
//    public function handle()
//    {
//        $date = date('Y-m-d');
//        if($date == getThursday())
//        {
//            $service = new KingSoldBattleService;
//            $service->endsBattle($date);
//        }
//    }

    public  function handle()
    {
        $topshiriq_data = DB::table('topshiriq')->where('status',1)->select('id','name','key','end_date')->get();


    }
}
