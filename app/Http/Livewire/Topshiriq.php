<?php

namespace App\Http\Livewire;

use App\Models\ElexirExercise;
use App\Models\TopshiriqJavob;
use App\Models\TopshiriqUserPlanWeek;
use App\Services\LMSTopshiriq;
use App\Services\TurnirService;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Topshiriq as TopshiriqModel;
use function Symfony\Component\Translation\t;

class Topshiriq extends Component
{

//    all

    public $topshiriqlar;
    public $now_time;
//    LMS
    public $result;
    public $topshiriq_name;
    public $topshiriq_javob;
    public $lms_date;
//    END LMS

//  SMENA

    public $smena;
    public $smena_topshiriq;
    public $smena_topshiriq_javob;
    public $smena_date;


// END SEMENA

//    Savdo 300

    public $savdo;
    public $savdo_topshiriq_name;
    public $savdo_topshiriq_javob;
    public $savdo_date;

// end Savdo 300

//  Oltin sut
    public $oltin_sut;
    public $oltin_sut_crystall;
    public $oltin_sut_topshiriq_name;
    public $oltin_sut_topshiriq_javob;
    public $oltin_sut_date;


//  End Oltin sut

//  Suyak Komplex
    public $suyak_komplex;
    public $suyak_komplex_crystall;
    public $suyak_komplex_topshiriq_name;
    public $suyak_komplex_topshiriq_javob;
    public $suyak_komplex_date;
// End Suyak Komplex

//birga bir jang
    public $birga_bir;
    public $birga_bir_topshiriq_name;
    public $birga_bir_topshiriq_javob;
//end birga bir jang

// origins savdo
    public $origin_savdo;
    public $origin_date;
    public $monday;
    public $sunday;

//    end origins savdo

// oraliq test

    public $oraliq_test;
    public $oraliq_test_topshiriq_name;
    public $oraliq_test_topshiriq_javob;

// end oraliq test

// plan week
    public $plan_week;
    public $pul_week;

// end plan week

// Kombo Sotuv

    public $kombo_sotuv;
    public $kombo_topshiriq_name;
    public $kombo_topshiriq_javob;
    public $kombo_date;

// End Kombo Sotuv


    public function mount()
    {

        $this->now_time = now()->format('Y-m-d');
        $userID = \auth()->user()->id;
        $this->topshiriqlar = TopshiriqModel::where('status',1)->get();
        $topshiriq = new LMSTopshiriq();
//        LMS
        $this->topshiriq_name = TopshiriqModel::where(['key'=>'lms','status'=>1])->first();
        if ($this->topshiriq_name){
            $this->topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$this->topshiriq_name->id,'topshiriq_key'=>$this->topshiriq_name->key,'tg_user_id'=>$userID])->first();
            $user_id = $userID;
            $first_date = $this->topshiriq_name->first_date;
            $end_date = $this->topshiriq_name->end_date;

            $time = new DateTime();
            $soat = new DateTime('24:00');
            $lms_end_date = new DateTime($end_date);
            $this->lms_date = $time->diff($lms_end_date)->format('%a:')."k ".$time->diff($soat)->format('%h:')."s ".$time->diff($soat)->format('%i:')."m ";

            $this->result = $topshiriq->LMS($user_id,$first_date,$end_date);
        }
// END LMS


//        SMENA
        $this->smena_topshiriq = TopshiriqModel::where(['key'=>'smena','status'=>1])->first();
        if ($this->smena_topshiriq){
            $this->smena_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$this->smena_topshiriq->id,'topshiriq_key'=>$this->smena_topshiriq->key,'tg_user_id'=>$userID])->first();
            $smena_first_date = $this->smena_topshiriq->first_date;
            $smena_end_date = $this->smena_topshiriq->end_date;
            $this->smena = $topshiriq->SMENA($userID,$smena_first_date,$smena_end_date);
            $time = new DateTime();
            $soat = new DateTime('24:00');
            $smen_end_date = new DateTime($smena_end_date);
            $this->smena_date = $time->diff($smen_end_date)->format('%a:')."k ".$time->diff($soat)->format('%h:')."s ".$time->diff($soat)->format('%i:')."m ";

        }
//        END SEMENA

//        Savdo 300

        $this->savdo_topshiriq_name = TopshiriqModel::where(['key'=>'savdo_300','status'=>1])->first();
        if ($this->savdo_topshiriq_name){
            $this->savdo_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$this->savdo_topshiriq_name->id,'topshiriq_key'=>$this->savdo_topshiriq_name->key,'tg_user_id'=>$userID])->first();
            $savdo_first_date = $this->savdo_topshiriq_name->first_date;
            $savdo_end_date = $this->savdo_topshiriq_name->end_date;

            $this->savdo = $topshiriq->savdo_300($userID,$savdo_first_date,$savdo_end_date);
            $time = new DateTime();
            $soat = new DateTime('24:00');
            $sav_end_date = new DateTime($savdo_end_date);
            $this->savdo_date = $time->diff($sav_end_date)->format('%a:')."k ".$time->diff($soat)->format('%h:')."s ".$time->diff($soat)->format('%i:')."m ";

        }
//        end Savdo 300

//        Oltin sut
        $this->oltin_sut_topshiriq_name = TopshiriqModel::where(['key'=>'oltin_sut','status'=>1])->first();
        if ($this->oltin_sut_topshiriq_name){
            $this->oltin_sut_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$this->oltin_sut_topshiriq_name->id,'topshiriq_key'=>$this->oltin_sut_topshiriq_name->key,'tg_user_id'=>$userID])->first();
            $oltin_sut_first_date = $this->oltin_sut_topshiriq_name->first_date;
            $oltin_sut_end_date = $this->oltin_sut_topshiriq_name->end_date;

            $this->oltin_sut_crystall = $this->oltin_sut_topshiriq_name->crystall;
            $this->oltin_sut = $topshiriq->oltin_sut($userID,$oltin_sut_first_date,$oltin_sut_end_date);
            $time = new DateTime();
            $soat = new DateTime('24:00');
            $oltin_end_date = new DateTime($oltin_sut_end_date);
            $this->oltin_sut_date = $time->diff($oltin_end_date)->format('%a:')."k ".$time->diff($soat)->format('%h:')."s ".$time->diff($soat)->format('%i:')."m ";

        }
//        End Oltin sut

//        Suyak Komplex
        $this->suyak_komplex_topshiriq_name = TopshiriqModel::where(['key'=>'suyak_komplex','status'=>1])->first();
        if ($this->suyak_komplex_topshiriq_name){
            $this->suyak_komplex_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$this->suyak_komplex_topshiriq_name->id,'topshiriq_key'=>$this->suyak_komplex_topshiriq_name->key,'tg_user_id'=>$userID])->first();

            $this->suyak_komplex_crystall = $this->suyak_komplex_topshiriq_name->crystall;

            $suyak_komplex_first_date = $this->suyak_komplex_topshiriq_name->first_date;
            $suyak_komplex_end_date = $this->suyak_komplex_topshiriq_name->end_date;

            $this->suyak_komplex = $topshiriq->suyak_complex($userID,$suyak_komplex_first_date,$suyak_komplex_end_date);
            $time = new DateTime();
            $soat = new DateTime('24:00');
            $suyak_end_date = new DateTime($suyak_komplex_end_date);
            $this->suyak_komplex_date = $time->diff($suyak_end_date)->format('%a:')."k ".$time->diff($soat)->format('%h:')."s ".$time->diff($soat)->format('%i:')."m ";
        }
//        End Suyak Komplex

//        Kombo Sotuv
        $this->kombo_topshiriq_name = TopshiriqModel::where(['key'=>'kombo_sotuv','status'=>1])->first();

        if ($this->kombo_topshiriq_name){
            $this->kombo_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$this->kombo_topshiriq_name->id,'topshiriq_key'=>$this->kombo_topshiriq_name->key,'tg_user_id'=>$userID])->first();
            $kombo_end = $this->kombo_topshiriq_name->end_date;
            $kombo_date = new DateTime($kombo_end);
            $time = new DateTime();
            $soat = new DateTime('24:00');
            $sotuv = $topshiriq->kombo_sotuv($userID);
            $this->kombo_sotuv = $sotuv['number'];
            $this->kombo_date = $time->diff($kombo_date)->format('%a:')."k ".$time->diff($soat)->format('%h:')."s ".$time->diff($soat)->format('%i:')."m ";

        }

//        End Kombo Sotuv


//        Birga  bir jang
        $this->birga_bir_topshiriq_name = TopshiriqModel::where(['key'=>'birga_bir','status'=>1])->first();
        if ($this->birga_bir_topshiriq_name){
            $this->birga_bir_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$this->birga_bir_topshiriq_name->id,'topshiriq_key'=>$this->birga_bir_topshiriq_name->key,'tg_user_id'=>$userID])->first();
            $this->birga_bir = $topshiriq->birga_bir_jang($userID);
        }

//        End birga bir jang

//            Oraliq Test
            $this->oraliq_test_topshiriq_name = TopshiriqModel::where(['key'=>'oraliq_test','status'=>1])->first();
            if ($this->oraliq_test_topshiriq_name){
                $this->oraliq_test_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$this->oraliq_test_topshiriq_name->id,'topshiriq_key'=>$this->oraliq_test_topshiriq_name->key,'tg_user_id'=>$userID])->first();
//                $this->oraliq_test = $topshiriq->OraliqTest($userID);
//                dd($this->oraliq_test);
            }

//            End oraliq Test


//        Origin Savdo
            $this->monday = date("Y-m-d", strtotime('monday this week'));
            $this->sunday = date("Y-m-d", strtotime('sunday this week'));
        $time = new DateTime();
        $soat = new DateTime('24:00');
            $origin_date = new DateTime($this->saturday);
            $this->origin_date = $time->diff($origin_date)->format('%a:')."k ".$time->diff($soat)->format('%h:')."s ".$time->diff($soat)->format('%i:')."m ";


        $this->origin_savdo = ElexirExercise::select('elexir_exercises.*','tg_medicine.name as medicine_name')
            ->where('elexir_exercises.user_id', $user_id)
            ->join('tg_medicine', 'tg_medicine.id', '=', 'elexir_exercises.medicine_id')
            ->whereDate('elexir_exercises.start_day', '>=', $this->monday)
            ->whereDate('elexir_exercises.end_day', '<=', $this->sunday)
            ->get();

//        end Origin savdo

//        Plan week

        $monday = date("Y-m-d", strtotime('monday this week'));
        $saturday = date("Y-m-d", strtotime('saturday this week'));

        $this->plan_week = TopshiriqUserPlanWeek::where(['user_id'=>$userID,'status'=>1,'start_day'=>$monday,'end_day'=>$saturday])->first();

        $data = $topshiriq->ViewHaftalikPlan($userID,$monday,$saturday);
        if ($data){
            $this->pul_week  = $data->total_savdo;
        }else{
            $this->pul_week = 0;
        }

//        End Plan week
    }
    public function render()
    {
        return view('livewire.topshiriq');
    }
}
