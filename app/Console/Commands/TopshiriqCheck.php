<?php

namespace App\Console\Commands;

use App\Models\Topshiriq;
use App\Models\TopshiriqJavob;
use App\Models\TopshiriqLevelUsers;
use App\Models\TopshiriqStar;
use App\Models\UserCrystall;
use App\Services\LMSTopshiriq;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TopshiriqCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'topshiriq:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Topshiriq tekshirish';

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

        $check_topshiriq = new LMSTopshiriq();
        $monday = date("Y-m-d", strtotime('monday this week'));
        $saturday = date("Y-m-d", strtotime('saturday this week'));

        $topshiriq = Topshiriq::where('status', 1)
            ->whereDate('first_date', '>=', $monday)
            ->whereDate('end_date', '>=', $saturday)
            ->orderBy('id', 'asc')
            ->get();

        $users = DB::table('tg_user')
            ->orWhere('status',1)
            ->orWhere('status',0)
            ->select('id','first_name','last_name','status')
            ->get();
        $userIds = $users->pluck('id');
        $UserData = DB::table('tg_productssold')
            ->whereIn('user_id', $userIds)
            ->select('user_id',DB::raw('SUM(id) as total_id'))
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('user_id')
            ->orderBy('user_id','asc')
            ->get();

//        return $UserData;

        foreach ($topshiriq as $top){
            foreach ($UserData as $data){
                $level_user_origin = TopshiriqLevelUsers::where('tg_user_id',$data->user_id)->first();
//                return $top->key;
                if (!$level_user_origin){
                    $level = new TopshiriqLevelUsers();
                    $level->tg_user_id = $data->user_id;
                    $level->level_user = 1;
                    $level->save();
                }
                elseif ($top->key == 'lms'){
                    $topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$top->id,'topshiriq_key'=>$top->key,'tg_user_id'=>$data->user_id])->first();
                    $lms = $check_topshiriq->LMS($data->user_id,$monday,$saturday);
                    if ($lms >= $top->number){
                        if (!$topshiriq_javob){
                            $javob = new TopshiriqJavob();
                            $javob->topshiriq_id = $top->id;
                            $javob->tg_user_id = $data->user_id;
                            $javob->topshiriq_key = $top->key;
                            $javob->topshiriq_done = $lms;
                            $javob->topshiriq_number = $top->number;
                            $javob->topshiriq_star = $top->star;
                            $javob->status = 1;
                            $javob->save();
//                    star
                            $star = new TopshiriqStar();
                            $star->tg_user_id = $data->user_id;
                            $star->star = $top->star;
                            $star->level = $level_user_origin->level_user;
                            $star->save();
//                   end star
                        }
                    }else{
                        if (!$topshiriq_javob){
                            $javob = new TopshiriqJavob();
                            $javob->topshiriq_id = $top->id;
                            $javob->tg_user_id = $data->user_id;
                            $javob->topshiriq_key = $top->key;
                            $javob->topshiriq_done = $lms;
                            $javob->topshiriq_number = $top->number;
                            $javob->topshiriq_star = 0;
                            $javob->status = 0;
                            $javob->save();
//                  star
                            $star = new TopshiriqStar();
                            $star->tg_user_id = $data->user_id;
                            $star->star = 0;
                            $star->level = $level_user_origin->level_user;
                            $star->save();
//                   end star
                        }
                    }
                }
                elseif ($top->key == 'smena'){
                    $topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$top->id,'topshiriq_key'=>$top->key,'tg_user_id'=>$data->user_id])->first();
                    $smena = $check_topshiriq->SMENA($data->user_id,$monday,$saturday);
                    if ($smena >= $top->number){
                        if (!$topshiriq_javob){
                            $javob = new TopshiriqJavob();
                            $javob->topshiriq_id = $top->id;
                            $javob->tg_user_id = $data->user_id;
                            $javob->topshiriq_key = $top->key;
                            $javob->topshiriq_done = $smena;
                            $javob->topshiriq_number = $top->number;
                            $javob->topshiriq_star = $top->star;
                            $javob->status = 1;
                            $javob->save();
//                    star
                            $star = new TopshiriqStar();
                            $star->tg_user_id = $data->user_id;
                            $star->star = $top->star;
                            $star->level = $level_user_origin->level_user;
                            $star->save();
//                   end star
                        }
                    }else{
                        if (!$topshiriq_javob){
                            $javob = new TopshiriqJavob();
                            $javob->topshiriq_id = $top->id;
                            $javob->tg_user_id = $data->user_id;
                            $javob->topshiriq_key = $top->key;
                            $javob->topshiriq_done = $smena;
                            $javob->topshiriq_number = $top->number;
                            $javob->topshiriq_star = 0;
                            $javob->status = 0;
                            $javob->save();
//                  star
                            $star = new TopshiriqStar();
                            $star->tg_user_id = $data->user_id;
                            $star->star = 0;
                            $star->level = $level_user_origin->level_user;
                            $star->save();
//                   end star
                        }
                    }
                }
                elseif ($top->key == 'savdo_300'){
                    $topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$top->id,'topshiriq_key'=>$top->key,'tg_user_id'=>$data->user_id])->first();
                    $savdo = $check_topshiriq->savdo_300($data->user_id,$monday,$saturday);
                    if ($savdo >= $top->number){
                        if (!$topshiriq_javob){
                            $javob = new TopshiriqJavob();
                            $javob->topshiriq_id = $top->id;
                            $javob->tg_user_id = $data->user_id;
                            $javob->topshiriq_key = $top->key;
                            $javob->topshiriq_done = $savdo;
                            $javob->topshiriq_number = $top->number;
                            $javob->topshiriq_star = $top->star;
                            $javob->status = 1;
                            $javob->save();
//                    star
                            $star = new TopshiriqStar();
                            $star->tg_user_id = $data->user_id;
                            $star->star = $top->star;
                            $star->level = $level_user_origin->level_user;
                            $star->save();
//                   end star
                        }
                    }else{
                        if (!$topshiriq_javob){
                            $javob = new TopshiriqJavob();
                            $javob->topshiriq_id = $top->id;
                            $javob->tg_user_id = $data->user_id;
                            $javob->topshiriq_key = $top->key;
                            $javob->topshiriq_done = $savdo;
                            $javob->topshiriq_number = $top->number;
                            $javob->topshiriq_star = 0;
                            $javob->status = 0;
                            $javob->save();
//                  star
                            $star = new TopshiriqStar();
                            $star->tg_user_id = $data->user_id;
                            $star->star = 0;
                            $star->level = $level_user_origin->level_user;
                            $star->save();
//                   end star
                        }
                    }
                }
                elseif ($top->key == 'oltin_sut'){
                    $topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$top->id,'topshiriq_key'=>$top->key,'tg_user_id'=>$data->user_id])->first();
                    $oltin_sut = $check_topshiriq->oltin_sut($data->user_id,$monday,$saturday);
                    if ($oltin_sut >= $top->number){
                        if (!$topshiriq_javob){
                            $javob = new TopshiriqJavob();
                            $javob->topshiriq_id = $top->id;
                            $javob->tg_user_id = $data->user_id;
                            $javob->topshiriq_key = $top->key;
                            $javob->topshiriq_done = $oltin_sut;
                            $javob->topshiriq_number = $top->number;
                            $javob->topshiriq_star = $top->star;
                            $javob->status = 1;
                            $javob->save();
//                    star
                            $star = new TopshiriqStar();
                            $star->tg_user_id = $data->user_id;
                            $star->star = $top->star;
                            $star->level = $level_user_origin->level_user;
                            $star->save();
//                   end star
                            $user_crystall = DB::table('user_crystalls')->where('user_id',$data->user_id)->first();
                            if (!$user_crystall){
                                $crystall = new UserCrystall();
                                $crystall->user_id = $data->user_id;
                                $crystall->crystall = $top->crystall;
                                $crystall->save();
                            }else{
                                DB::table('user_crystalls')->where('user_id',$data->user_id)->update([
                                    'crystall'=>$user_crystall->crystall + $top->crystall
                                ]);
                            }


                        }
                    }else{
                        if (!$topshiriq_javob){
                            $javob = new TopshiriqJavob();
                            $javob->topshiriq_id = $top->id;
                            $javob->tg_user_id = $data->user_id;
                            $javob->topshiriq_key = $top->key;
                            $javob->topshiriq_done = $oltin_sut;
                            $javob->topshiriq_number = $top->number;
                            $javob->topshiriq_star = 0;
                            $javob->status = 0;
                            $javob->save();
//                  star
                            $star = new TopshiriqStar();
                            $star->tg_user_id = $data->user_id;
                            $star->star = 0;
                            $star->level = $level_user_origin->level_user;
                            $star->save();
//                   end star
                            $user_crystall = DB::table('user_crystalls')->where('user_id',$data->user_id)->first();
                            if (!$user_crystall){
                                $crystall = new UserCrystall();
                                $crystall->user_id = $data->user_id;
                                $crystall->crystall = 0;
                                $crystall->save();
                            }else{
                                DB::table('user_crystalls')->where('user_id',$data->user_id)->update([
                                    'crystall'=>$user_crystall->crystall + 0
                                ]);
                            }
                        }
                    }
                }
                elseif ($top->key == 'suyak_komplex'){
                    $topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$top->id,'topshiriq_key'=>$top->key,'tg_user_id'=>$data->user_id])->first();
                    $suyak_komplex = $check_topshiriq->suyak_complex($data->user_id,$monday,$saturday);
                    if ($suyak_komplex >= $top->number){
                        if (!$topshiriq_javob){
                            $javob = new TopshiriqJavob();
                            $javob->topshiriq_id = $top->id;
                            $javob->tg_user_id = $data->user_id;
                            $javob->topshiriq_key = $top->key;
                            $javob->topshiriq_done = $suyak_komplex;
                            $javob->topshiriq_number = $top->number;
                            $javob->topshiriq_star = $top->star;
                            $javob->status = 1;
                            $javob->save();
//                    star
                            $star = new TopshiriqStar();
                            $star->tg_user_id = $data->user_id;
                            $star->star = $top->star;
                            $star->level = $level_user_origin->level_user;
                            $star->save();
//                   end star
                            $user_crystall = DB::table('user_crystalls')->where('user_id',$data->user_id)->first();
                            if (!$user_crystall){
                                $crystall = new UserCrystall();
                                $crystall->user_id = $data->user_id;
                                $crystall->crystall = $top->crystall;
                                $crystall->save();
                            }else{
                                DB::table('user_crystalls')->where('user_id',$data->user_id)->update([
                                    'crystall'=>$user_crystall->crystall + $top->crystall
                                ]);
                            }
                        }
                    }else{
                        if (!$topshiriq_javob){
                            $javob = new TopshiriqJavob();
                            $javob->topshiriq_id = $top->id;
                            $javob->tg_user_id = $data->user_id;
                            $javob->topshiriq_key = $top->key;
                            $javob->topshiriq_done = $suyak_komplex;
                            $javob->topshiriq_number = $top->number;
                            $javob->topshiriq_star = 0;
                            $javob->status = 0;
                            $javob->save();
//                  star
                            $star = new TopshiriqStar();
                            $star->tg_user_id = $data->user_id;
                            $star->star = 0;
                            $star->level = $level_user_origin->level_user;
                            $star->save();
//                   end star
                            $user_crystall = DB::table('user_crystalls')->where('user_id',$data->user_id)->first();
                            if (!$user_crystall){
                                $crystall = new UserCrystall();
                                $crystall->user_id = $data->user_id;
                                $crystall->crystall = 0;
                                $crystall->save();
                            }else{
                                DB::table('user_crystalls')->where('user_id',$data->user_id)->update([
                                    'crystall'=>$user_crystall->crystall + 0
                                ]);
                            }
                        }
                    }
                }
//                elseif ($top->key == 'birga_bir'){
//                    $topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$top->id,'topshiriq_key'=>$top->key,'tg_user_id'=>$data->user_id])->first();
//                    $birga_bir = $check_topshiriq->birga_bir_jang($data->user_id);
//                    if ($birga_bir >= $top->number){
//                        if (!$topshiriq_javob){
//                            $javob = new TopshiriqJavob();
//                            $javob->topshiriq_id = $top->id;
//                            $javob->tg_user_id = $data->user_id;
//                            $javob->topshiriq_key = $top->key;
//                            $javob->topshiriq_done = $birga_bir;
//                            $javob->topshiriq_number = $top->number;
//                            $javob->topshiriq_star = $top->star;
//                            $javob->status = 1;
//                            $javob->save();
////                    star
//                            $star = new TopshiriqStar();
//                            $star->tg_user_id = $data->user_id;
//                            $star->star = $top->star;
//                            $star->level = $level_user_origin->level_user;
//                            $star->save();
////                   end star
//                        }
//                    }else{
//                        if (!$topshiriq_javob){
//                            $javob = new TopshiriqJavob();
//                            $javob->topshiriq_id = $top->id;
//                            $javob->tg_user_id = $data->user_id;
//                            $javob->topshiriq_key = $top->key;
//                            $javob->topshiriq_done = $birga_bir;
//                            $javob->topshiriq_number = $top->number;
//                            $javob->topshiriq_star = 0;
//                            $javob->status = 0;
//                            $javob->save();
////                  star
//                            $star = new TopshiriqStar();
//                            $star->tg_user_id = $data->user_id;
//                            $star->star = 0;
//                            $star->level = $level_user_origin->level_user;
//                            $star->save();
////                   end star
//                        }
//                    }
//                }
            }
        }

    }
}
