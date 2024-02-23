<?php

namespace App\Console\Commands;

use App\Models\TopshiriqUserPlanWeek;
use App\Services\LMSTopshiriq;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreatePlanWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan:week';

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
        $users = DB::table('tg_user')
            ->orWhere('status',1)
            ->orWhere('status',0)
            ->select('id','first_name','last_name','status')
            ->get();
        $userIds = $users->pluck('id');
        $tgProductssoldData = DB::table('tg_productssold')
            ->whereIn('user_id', $userIds)
            ->select('user_id', DB::raw('SUM(number * price_product) as total_number'))
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('user_id')
            ->orderBy('user_id', 'asc')
            ->get();

        $monday = date("Y-m-d", strtotime('monday this week'));
        $sunday = date("Y-m-d", strtotime('sunday this week'));
        $topshiriq = new LMSTopshiriq();
//        return $tgProductssoldData;
        foreach ($tgProductssoldData as $user)
        {
            $user_id = $user->user_id;
            $have = TopshiriqUserPlanWeek::where(['user_id'=>$user_id,'status'=>1,'start_day'=>$monday,'end_day'=>$sunday])->first();
            $data = $topshiriq->HaftalikPlan($user_id);
//            echo ' pul ' . $data['pul'] . '   '. $user_id;
            if (!$have){
                $plan = new TopshiriqUserPlanWeek();
                $plan->user_id = $user_id;
                $plan->star = 30;
                $plan->plan_week = $data['pul'];
                $plan->status = 1;
                $plan->start_day = $monday;
                $plan->end_day = $sunday;
                $plan->save();
            }
        }
    }
}
