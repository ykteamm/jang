<?php

namespace App\Console\Commands;

use App\Models\ElexirExercise;
use App\Models\TopshiriqLevelUsers;
use App\Models\TopshiriqStar;
use App\Services\LMSTopshiriq;
use Illuminate\Console\Command;

class OriginCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'origin:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Origin check';

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
        $user_id = auth()->user()->id;
        $topshiriq = new LMSTopshiriq();

        $monday = date("Y-m-d", strtotime('monday this week'));
        $saturday = date("Y-m-d", strtotime('saturday this week'));
        $origin_savdo = ElexirExercise::select('elexir_exercises.*','tg_medicine.name as medicine_name')
            ->where('elexir_exercises.user_id', $user_id)
            ->join('tg_medicine', 'tg_medicine.id', '=', 'elexir_exercises.medicine_id')
            ->whereDate('elexir_exercises.start_day', '>=', $monday)
            ->whereDate('elexir_exercises.end_day', '<=', $saturday)
            ->get();
        $level_user_origin = TopshiriqLevelUsers::where('tg_user_id',$user_id)->first();
        foreach($origin_savdo as $origin){
            if ($origin->success == 0){
                $check = $topshiriq->origin_check($user_id,$origin->medicine_id,$origin->start_day,$origin->end_day);
                if ($check >= $origin->plan){
                    ElexirExercise::where(['user_id'=>$user_id,'medicine_id'=>$origin->medicine_id])->update([
                        'success'=>1,
                    ]);
                    $star_origin = new TopshiriqStar();
                    $star_origin->tg_user_id = $user_id;
                    $star_origin->star = $origin->elexir;
                    $star_origin->level = $level_user_origin->level_user;
                    $star_origin->save();
                }
            }
        }
    }
}
