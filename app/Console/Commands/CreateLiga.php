<?php

namespace App\Console\Commands;

use App\Models\AllSold;
use App\Models\Liga;
use App\Models\NewUserOneMonth;
use App\Models\Shift;
use App\Models\User;
use App\Models\UserBattle;
use App\Models\UserLiga;
use App\Services\NewUserOneMonthService;
use App\Services\PlanServices;
use App\Services\UserBattleService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateLiga extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:liga';

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
        $d = date('d');
        if($d == '01')
        {
            $date = date('Y-m-d',(strtotime ( '-2 day' , strtotime ( date('Y-m-d') ) ) ));

            $weekStartDate = Carbon::createFromFormat('Y-m-d', $date)
                ->firstOfMonth()
                ->format('Y-m-d');

            $weekEndDate = Carbon::createFromFormat('Y-m-d', $date)
                ->lastOfMonth()
                ->format('Y-m-d');

            $facts = DB::table('tg_productssold')
                ->selectRaw('SUM(number * price_product) as price,user_id')
                ->whereDate('created_at','>=',$weekStartDate)
                ->whereDate('created_at','<=',$weekEndDate)
                ->groupBy('user_id')
                ->orderBy('price','DESC')
                ->get();

            foreach ($facts as $key => $value) {

                $user_ligas = UserLiga::where('user_id',$value->user_id)->where('month',date('Y-m'))->first();

                if(!$user_ligas)
                {

                    $liga = Liga::where('plan','<=', $value->price)->orderBy('plan','DESC')->first();

                    $save = new UserLiga;
                    $save->user_id = $value->user_id;
                    $save->liga_id = $liga->id;
                    $save->month = date('Y-m');
                    $save->save();
                }
            }


            $users = User::whereIn('status',[1,2])->get();

            foreach ($users as $key => $value) {
                  $b = new PlanServices;
                  $bser = $b->createPlan($value->id);
            }

        }

    }
}
