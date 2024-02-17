<?php

namespace App\Console\Commands;

use App\Models\ElexirExercise;
use App\Services\KingSoldBattleService;
use App\Services\LMSTopshiriq;
use Carbon\Carbon;
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

        $monday = date("Y-m-d", strtotime('monday this week'));
        $saturday = date("Y-m-d", strtotime('saturday this week'));

        $topshiriq = new LMSTopshiriq();
        $users = DB::table('tg_user')
            ->orWhere('status',1)
            ->orWhere('status',0)
            ->select('id','first_name','last_name','status')
            ->get();
        $userIds = $users->pluck('id');
        $tgProductssoldData = DB::table('tg_productssold')
            ->whereIn('user_id', $userIds)
            ->select('id','user_id','medicine_id','number')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->orderBy('id','asc')
            ->get();

        foreach ($tgProductssoldData as $user){
            $user_id = $user->user_id;
            $data = $topshiriq->origins_dori_daraja($user_id);
            $number = 1;
            foreach ($data['data'] as $origin){
                $have = ElexirExercise::where(['user_id'=>$user_id,'medicine_id'=>$origin->medicine_id])->first();
                if (!$have){
                    $elixir = new ElexirExercise();
                    $elixir->user_id = $user_id;
                    $elixir->medicine_id =$origin->medicine_id;
                    $elixir->elexir = 30;
                    $elixir->plan = $data['week_'.$number++] ;
                    $elixir->success = 0;
                    $elixir->start_day =  $monday;
                    $elixir->end_day = $saturday;
                    $elixir->created_at = now();
                    $elixir->updated_at = now();
                    $elixir->save();
                }
            }
        }

    }
}
