<?php

namespace App\Http\Livewire;

use App\Models\TopshiriqJavob;
use App\Services\LMSTopshiriq;
use App\Services\TurnirService;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Topshiriq as TopshiriqModel;

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
    public $oltin_sut_topshiriq_name;
    public $oltin_sut_topshiriq_javob;
    public $oltin_sut_date;


//  End Oltin sut

//  Suyak Komplex
    public $suyak_komplex;
    public $suyak_komplex_topshiriq_name;
    public $suyak_komplex_topshiriq_javob;
    public $suyak_komplex_date;
// End Suyak Komplex

    public function mount()
    {

        $this->now_time = now()->format('Y-m-d');
        $userID = \auth()->user()->id;
        $this->topshiriqlar = TopshiriqModel::where('status',1)->get();
        $topshiriq = new LMSTopshiriq();
//        LMS
        $this->topshiriq_name = TopshiriqModel::where(['key'=>'lms','status'=>1])->first();
        $this->topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$this->topshiriq_name->id,'topshiriq_key'=>$this->topshiriq_name->key,'tg_user_id'=>$userID])->first();
        $user_id = $userID;
        $first_date = $this->topshiriq_name->first_date;
        $end_date = $this->topshiriq_name->end_date;

        $time = new DateTime();
        $soat = new DateTime('24:00');
        $lms_end_date = new DateTime($end_date);
        $this->lms_date = $time->diff($lms_end_date)->format('%a:')."k ".$time->diff($soat)->format('%h:')."s ".$time->diff($soat)->format('%i:')."m ";

        $this->result = $topshiriq->LMS($user_id,$first_date,$end_date);
// END LMS


//        SMENA
        $this->smena_topshiriq = TopshiriqModel::where(['key'=>'smena','status'=>1])->first();
        $this->smena_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$this->smena_topshiriq->id,'topshiriq_key'=>$this->smena_topshiriq->key,'tg_user_id'=>$userID])->first();
        $smena_first_date = $this->smena_topshiriq->first_date;
        $smena_end_date = $this->smena_topshiriq->end_date;
        $this->smena = $topshiriq->SMENA($userID,$smena_first_date,$smena_end_date);

        $smen_end_date = new DateTime($smena_end_date);
        $this->smena_date = $time->diff($smen_end_date)->format('%a:')."k ".$time->diff($soat)->format('%h:')."s ".$time->diff($soat)->format('%i:')."m ";

//        END SEMENA

//        Savdo 300

        $this->savdo_topshiriq_name = TopshiriqModel::where(['key'=>'savdo_300','status'=>1])->first();
        $this->savdo_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$this->savdo_topshiriq_name->id,'topshiriq_key'=>$this->savdo_topshiriq_name->key,'tg_user_id'=>$userID])->first();
        $savdo_first_date = $this->savdo_topshiriq_name->first_date;
        $savdo_end_date = $this->savdo_topshiriq_name->end_date;

        $this->savdo = $topshiriq->savdo_300($userID,$savdo_first_date,$savdo_end_date);

        $sav_end_date = new DateTime($savdo_end_date);
        $this->savdo_date = $time->diff($sav_end_date)->format('%a:')."k ".$time->diff($soat)->format('%h:')."s ".$time->diff($soat)->format('%i:')."m ";


//        end Savdo 300

//        Oltin sut
        $this->oltin_sut_topshiriq_name = TopshiriqModel::where(['key'=>'oltin_sut','status'=>1])->first();
        $this->oltin_sut_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$this->oltin_sut_topshiriq_name->id,'topshiriq_key'=>$this->oltin_sut_topshiriq_name->key,'tg_user_id'=>$userID])->first();
        $oltin_sut_first_date = $this->oltin_sut_topshiriq_name->first_date;
        $oltin_sut_end_date = $this->oltin_sut_topshiriq_name->end_date;

        $this->oltin_sut = $topshiriq->oltin_sut($userID,$oltin_sut_first_date,$oltin_sut_end_date);

        $oltin_end_date = new DateTime($oltin_sut_end_date);
        $this->oltin_sut_date = $time->diff($oltin_end_date)->format('%a:')."k ".$time->diff($soat)->format('%h:')."s ".$time->diff($soat)->format('%i:')."m ";

//        End Oltin sut

//        Suyak Komplex
        $this->suyak_komplex_topshiriq_name = TopshiriqModel::where(['key'=>'suyak_komplex','status'=>1])->first();
        $this->suyak_komplex_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$this->suyak_komplex_topshiriq_name->id,'topshiriq_key'=>$this->suyak_komplex_topshiriq_name->key,'tg_user_id'=>$userID])->first();
        $suyak_komplex_first_date = $this->suyak_komplex_topshiriq_name->first_date;
        $suyak_komplex_end_date = $this->suyak_komplex_topshiriq_name->end_date;

        $this->suyak_komplex = $topshiriq->suyak_complex($userID,$suyak_komplex_first_date,$suyak_komplex_end_date);

        $suyak_end_date = new DateTime($suyak_komplex_end_date);
        $this->suyak_komplex_date = $time->diff($suyak_end_date)->format('%a:')."k ".$time->diff($soat)->format('%h:')."s ".$time->diff($soat)->format('%i:')."m ";

//        End Suyak Komplex
    }
    public function render()
    {
        return view('livewire.topshiriq');
    }
}
