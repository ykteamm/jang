<?php

namespace App\Console\Commands;

use App\Models\TopshiriqLevelUsers;
use App\Models\TopshiriqStar;
use App\Models\TopshiriqUserPlanWeek;
use App\Services\LMSTopshiriq;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckPlanWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:plan';

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
        $monday = date("Y-m-d", strtotime('monday this week'));
        $sunday = date("Y-m-d", strtotime('sunday this week'));
        $users = DB::table('topshiriq_user_plan_week')->where(['start_day'=>$monday,'end_day'=>$sunday,'status'=>1])->get();
        $topshiriq = new LMSTopshiriq();
        foreach ($users as $user){
            $level_user = TopshiriqLevelUsers::where('tg_user_id',$user->user_id)->first();
            $user_id = $user->user_id;
            $plan = $user->plan_week;
            $start_day = $user->start_day;
            $end_day = $user->end_day;
            $data = $topshiriq->CheckHaftalikPlan($user_id,$start_day,$end_day,$plan);
            if ($data){
                $update = TopshiriqUserPlanWeek::where(['user_id'=>$user_id,'status'=>1,'start_day'=>$monday,'end_day'=>$sunday])->update([
                   'success'=>1,
                   'status'=>0,
                ]);
                $star = new TopshiriqStar();
                $star->tg_user_id = $user_id;
                $star->star = $user->star;
                $star->level = $level_user ? $level_user->level_user : 1;
                $star->save();
            }else{
                $update = TopshiriqUserPlanWeek::where(['user_id'=>$user_id,'status'=>1,'start_day'=>$monday,'end_day'=>$sunday])->update([
                    'success'=>0,
                    'status'=>0
                ]);
            }
        }
    }
}
