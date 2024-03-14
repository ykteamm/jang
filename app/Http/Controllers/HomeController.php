<?php

namespace App\Http\Controllers;

use App\Models\AllSold;
use App\Models\ElexirExercise;
use App\Models\MegaTurnirTeamBattle;
use App\Models\MegaTurnirUserBattle;
use App\Models\Topshiriq;
use App\Models\TopshiriqJavob;
use App\Models\TopshiriqLevel;
use App\Models\TopshiriqLevelUsers;
use App\Models\TopshiriqStar;
use App\Models\TopshiriqUserPlanWeek;
use App\Models\UserBattleDay;
use App\Models\UserCrystall;
use App\Services\LMSTopshiriq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Battle;
use App\Models\BattleDay;
use App\Models\BattleElchi;
use App\Models\ElchiBattleSetting;
use App\Models\BattleHistory;
use App\Models\BonusKingSoldForRegion;
use App\Models\BonusKingSoldForSide;
use App\Models\BonusKingSoldForUser;
use App\Models\Client;
use App\Models\ElchiBall;
use App\Models\ElchiExercise;
use App\Models\NewUserOneMonth;
use App\Services\NewUserOneMonthService;
use App\Models\ElchiUserExercise;
use App\Models\Info;
use App\Models\KingSold;
use App\Models\KingSoldBattle;
use App\Models\Medicine;
use App\Models\News;
use App\Models\Order;
use App\Models\OuterMarket;
use App\Models\Pharmacy;
use App\Models\PharmacyUser;
use App\Models\Premya;
use App\Models\PremyaTask;
use App\Models\Product;
use App\Models\PromoProduct;
use App\Models\Region;
use App\Models\Shift;
use App\Models\Team;
use App\Models\TeamBattle;
use App\Models\TeamMember;
use App\Models\UserBattle;
use App\Models\TeacherUser;
use App\Models\TeamBattleKarma;
use App\Models\Video;
use App\Services\ExerciseServices;
use App\Services\ShiftService;
use App\Services\UserBattleService;
use App\Services\HelperServices;
use App\Services\LockService;
use App\Services\MakeImageService;
use App\Services\MoneyService;
use App\Services\NewsService;
use App\Services\PlanFactService;
use App\Services\PlanServices;
use App\Services\ProductService;
use App\Services\SmsBattleService;
use App\Services\TeamBattleServices;
use App\Services\TurnirService;
use App\Services\WorkDayServices;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use MrBrownNL\RandomNicknameGenerator\RandomNicknameGenerator;
use MrBrownNL\RandomNicknameGenerator\Facades\NicknameGenerator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private MakeImageService $image;
    private LockService $lockElchiService;
    public function __construct(MakeImageService $image, LockService $l)
    {
        $this->lockElchiService = $l;
        $this->image = $image;
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function CreateApteka(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'pharma_id'=>'required',
        ]);

        $pharm_create = new PharmacyUser();
        $pharm_create->user_id = $request->user_id;
        $pharm_create->pharma_id = $request->pharma_id;
        $pharm_create->save();

        return redirect()->back();
    }
    public function AptekaEdit(Request $request, $id)
    {
        $user_id = $request->user_id;
        $edit_pharm = $request->apteka;

        $update = DB::table('tg_pharmacy_users')->where(['user_id'=>$user_id,'pharma_id'=>$id])
        ->update([
            'pharma_id'=>$edit_pharm
        ]);

        return redirect()->back();
    }

    public function AptekaDelete(Request $request, $id)
    {
        $user_id = $request->user_id;
        $delete_pharm = $id;

        $update = DB::table('tg_pharmacy_users')->where(['user_id'=>$user_id,'pharma_id'=>$delete_pharm])
            ->delete();

        return redirect()->back();
    }

    public function index()
    {

        if(userme()->rm == 1)
        {
            return view('rm');
        }
        if(userme()->rm == 2)
        {
            return view('kurator');
        }

        $my_id = userme()->id;

        if (userme()->status == 4) {
            return redirect()->route('block');
        }

        // $userbat = UserBattle::whereIn('day',[0,1,2])->pluck('id');

        // foreach ($userbat as $key => $value) {
        //     UserBattle::where('id',$value)->delete();
        //     UserBattleDay::where('battle_id',$value)->delete();
        // }
//
        // $b = new UserBattleService;
        // $Store = date('l');
        // return $Store;
        // $date = date('2023-12-19');
        // $bser = $b->battle($date);
        // $bser = $b->endBattle($date);
        // $bser = $b->battleDay($date);



        $host = substr(request()->getHttpHost(),0,3);
        if($host == 127)
        {
            $battle_date = date('Y-m-d');
            $sold_date = date('Y-m-d');

        }else{
            $battle_date = date('Y-m-d');
            $sold_date = date('Y-m-d');

        }

        $my_battle = UserBattle::with('u1ids','u2ids')
            ->whereDate('start_day','<=',$battle_date)
            ->whereDate('end_day','>=',$battle_date)
            ->where(function($query) use ($my_id){
                $query->where('u1id',$my_id)
                    ->orWhere('u2id',$my_id);
            })->get();

        $battle_yes = 'yes';


        if(count($my_battle) == 0)
        {
            $battle_yes = 'no';
        }
        if(count($my_battle) == 2)
        {
            $my_battle = UserBattle::with('u1ids','u2ids')->where('bot',0)
                ->whereDate('start_day','<=',$battle_date)
                ->whereDate('end_day','>=',$battle_date)
                ->where(function($query) use ($my_id){
                    $query->where('u1id',$my_id)
                        ->orWhere('u2id',$my_id);
                })->get();
            $battle_yes = 'yes';
        }

        $n = new HelperServices;
        $my_jang = $n->myBattle($my_battle,$sold_date);
        $summa1 = $my_jang->summa1;
        $summa2 = $my_jang->summa2;
        $summa_bugun1 = $my_jang->summa_bugun1;
        $summa_bugun2 = $my_jang->summa_bugun2;
        $battle_start_day = $my_jang->battle_start_day;

        $battle_history = UserBattle::where('ends',1)
            ->where(function($query) use ($my_id){
                $query->where('u1id',$my_id)
                    ->orWhere('u2id',$my_id);
            })->orderBy('id','DESC')->limit(5)->get();

        foreach ($battle_history as $key => $value) {
            if($value->u2id == $my_id && $value->bot ==1)
            {
                unset($battle_history[$key]);
            }
        }

//        $battle_history = UserBattle::where('ends',1)
//            ->where(function($query) use ($my_id){
//                $query->where('u1id',$my_id)
//                    ->orWhere('u2id',$my_id);
//            })->orderBy('id','DESC')->get();
//        foreach ($battle_history as $key => $value) {
//            if($value->u2id == $my_id && $value->bot ==1)
//            {
//                unset($battle_history[$key]);
//            }
//        }
        // $teskari=[];
        // foreach ($teskari2 as $key => $value) {
        //     $teskari[] = $teskari2[count($teskari2)-$key-1];
        // }
        // $battle_history = $teskari;

        $winImage = null;
        $battle_history = array_merge([], $battle_history->all());
//        return $battle_history[count($battle_history)-1];
//        return count($battle_history);
        if(count($battle_history) > 0) {
            $winImage = $this->image->make($battle_history[count($battle_history)-1]);
        }

//        $teskari2=[];
//        foreach ($battle_history as $key => $value) {
//            $teskari2[] = $value;
//        }
//        $teskari=[];
//        foreach ($teskari2 as $key => $value) {
//            $teskari[] = $teskari2[count($teskari2)-$key-1];
//        }
//        $battle_history = $teskari;
        // return $battle_history;

        $all_battle = UserBattle::with('u1ids','u2ids','battle_elchi','battle_elchi.u1ids','battle_elchi.u2ids')
            ->where(function($query) use ($my_id){
                $query->where('u1id',$my_id)
                    ->orWhere('u2id',$my_id);
            })->orderBy('id','DESC')->get();
        foreach ($all_battle as $key => $value) {
            if($value->u2id == $my_id && $value->bot ==1)
            {
                unset($all_battle[$key]);
            }
        }

        // dd(($battle_history));

        $shifts = Shift::with('pharmacy')->where('user_id',Auth::user()->id)
            ->whereDate('open_date',Carbon::now())
            ->orderBy('id','DESC')->limit(1)
            ->where('active',1)->get();

        $makeCloseShift = Shift::with('pharmacy')->where('user_id', Auth::user()->id)
            ->whereDate('open_date', Carbon::now())
            ->orderBy('id','DESC')
            ->where('active', 0)->first();

        $close_shifts = Shift::where('user_id',Auth::user()->id)
            ->whereDate('open_date',Carbon::now())
            ->where('active',2)->pluck('pharma_id')->toArray();

        $pharmacy = PharmacyUser::with('pharmacy')->where('user_id',Auth::user()->id)->whereNotIn('pharma_id',$close_shifts)->get();


        $products = Shift::with('pharmacy.shablon_pharmacy.shablon.price.medicine')->where('user_id',Auth::user()->id)
            ->whereDate('open_date',Carbon::now())
            ->where('active',1)
            ->get();

        $last_solt_day = date('Y-m-d',(strtotime ( '-3 day' , strtotime ( date('Y-m-d') ) ) ));

        $all_sold = Order::with('sold','king_sold','sold.medicine')->where('user_id',Auth::id())
            ->whereDate('created_at','>=',$last_solt_day)
            ->orderBy('id','DESC')
            ->get();






        $outerMarket = OuterMarket::all();
        // $battle_yes = 'no';
//        $lock = 1;
        // $summa1 = 1;
        // $summa2 = 1;
        // $battle_history = 1;
        // $summa_bugun2 = 1;
        // $summa_bugun1 = 1;
        // $my_battle = 1;
        // $all_battle = 1;
        // $battle_start_day = 1;
        $haveTurnirBattle = 'no';

//        Level

        $userID = Auth::id();

        $daraja = TopshiriqLevel::where('daraja',1)->first();
        $daraja_2 = TopshiriqLevel::where('daraja',2)->first();
        $daraja_3 = TopshiriqLevel::where('daraja',3)->first();
        $daraja_4 = TopshiriqLevel::where('daraja',4)->first();
        $daraja_5 = TopshiriqLevel::where('daraja',5)->first();
        $daraja_6 = TopshiriqLevel::where('daraja',6)->first();


        $level_user = TopshiriqLevelUsers::where('tg_user_id',$userID)->first();
        if (!$level_user){
            $user_level = new TopshiriqLevelUsers();
            $user_level->tg_user_id = $userID;
            $user_level->level_user = $daraja->daraja;
            $user_level->save();
        }
        $level_user = TopshiriqLevelUsers::where('tg_user_id',$userID)->first();

        $user_star = TopshiriqStar::where(['tg_user_id'=>$userID,'level'=>$level_user->level_user])->get();
        $star_all = 0;
        $level_all = 0;

        foreach ($user_star as $star) {
            $star_all += $star->star;
            $level_all = $star->level; // Levelni o'zgartirish uchun
        }


        $user_level_profile[] = [
            'level'=>$daraja->daraja,
            'collect_star'=>$daraja->number_star,
            'star'=>$star_all,
        ];
        if ($level_user && $daraja->daraja == $level_all && $star_all >= $daraja->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_2->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_2->daraja,
                'collect_star'=>$daraja_2->number_star,
                'star'=>$star_all,
            ];
        }
        elseif ($level_user && $daraja_2->daraja == $level_all &&  $star_all >= $daraja_2->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_3->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_3->daraja,
                'collect_star'=>$daraja_3->number_star,
                'star'=>$star_all,
            ];
        }
        elseif ($level_user && $daraja_3->daraja == $level_all && $star_all >= $daraja_3->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_4->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_4->daraja,
                'collect_star'=>$daraja_4->number_star,
                'star'=>$star_all,
            ];
        }
        elseif ($level_user && $daraja_4->daraja == $level_all && $star_all >= $daraja_4->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_5->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_5->daraja,
                'collect_star'=>$daraja_5->number_star,
                'star'=>$star_all,
            ];
        }
        elseif ($level_user && $daraja_5->daraja == $level_all && $star_all >= $daraja_5->number_star)
        {
            $daraja_update = TopshiriqLevelUsers::where('tg_user_id',$userID)->update([
                'level_user'=>$daraja_6->daraja
            ]);
            $user_level_profile = [
                'level'=>$daraja_6->daraja,
                'collect_star'=>$daraja_6->number_star,
                'star'=>$star_all,
            ];
        } else{
            $daraja_find = TopshiriqLevelUsers::where('tg_user_id',$userID)->first();
            $star_find = TopshiriqLevel::where('daraja',$daraja_find->level_user)->first();
            $user_level_profile = [
                'level'=>$daraja_find->level_user,
                'collect_star'=>$star_find->number_star,
                'star'=>$star_all,
            ];
        }

//         End Level



// LMS dars ko'rish
        $userID = \auth()->user()->id;
        $topshiriq = new LMSTopshiriq();
        $user_crystall = DB::table('user_crystalls')->where('user_id',$userID)->first();

        $topshiriq_name = Topshiriq::where(['key'=>'lms','status'=>1])->first();
        if ($topshiriq_name){
            $topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$topshiriq_name->id,'topshiriq_key'=>$topshiriq_name->key,'tg_user_id'=>$userID])->first();
//        $top_star_ball = TopshiriqStar::where('tg_user_id',$userID)->first();
            $user_id = $userID;
            $first_date = $topshiriq_name->first_date;
            $end_date = $topshiriq_name->end_date;
            $number = $topshiriq_name->number;

            $time = new DateTime();
            $soat = new DateTime('23:59');

            $sana = new DateTime($end_date);
            $intervalSana = $time->diff($sana);
            $intervalSoat = $time->diff($soat);
            $lms_days = $intervalSana->days == 0 && $intervalSoat->h == 0 && $intervalSoat->i == 0 && $intervalSoat->s == 0;

            $result = $topshiriq->LMS($user_id,$first_date,$end_date);
            if ($lms_days){
                if ($result >= $number){
                    if (!$topshiriq_javob){
                        $javob = new TopshiriqJavob();
                        $javob->topshiriq_id = $topshiriq_name->id;
                        $javob->tg_user_id = $userID;
                        $javob->topshiriq_key = $topshiriq_name->key;
                        $javob->topshiriq_done = $result;
                        $javob->topshiriq_number = $number;
                        $javob->topshiriq_star = $topshiriq_name->star;
                        $javob->status = 1;
                        $javob->save();
//                    star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = $topshiriq_name->star;
                        $star->level = $level_user->level_user;
                        $star->save();
//                   end star
                    }
                }else{
                    if (!$topshiriq_javob){
                        $javob = new TopshiriqJavob();
                        $javob->topshiriq_id = $topshiriq_name->id;
                        $javob->tg_user_id = $userID;
                        $javob->topshiriq_key = $topshiriq_name->key;
                        $javob->topshiriq_done = $result;
                        $javob->topshiriq_number = $number;
                        $javob->topshiriq_star = 0;
                        $javob->status = 0;
                        $javob->save();
//                  star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = 0;
                        $star->level = $level_user->level_user;
                        $star->save();
//                   end star
                    }
                }
            }else{
                if ($result >= $number){
                    if (!$topshiriq_javob){
                        $javob = new TopshiriqJavob();
                        $javob->topshiriq_id = $topshiriq_name->id;
                        $javob->tg_user_id = $userID;
                        $javob->topshiriq_key = $topshiriq_name->key;
                        $javob->topshiriq_done = $result;
                        $javob->topshiriq_number = $number;
                        $javob->topshiriq_star = $topshiriq_name->star;
                        $javob->status = 1;
                        $javob->save();
//                  star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = $topshiriq_name->star;
                        $star->level = $level_user->level_user;
                        $star->save();
//                   end star
                    }
                }
            }
        }


//        end LMS dars ko'rish

//         SMENA ochish
        $userID = \auth()->user()->id;
        $smena_topshiriq_name = Topshiriq::where(['key'=>'smena','status'=>1])->first();
        if ($smena_topshiriq_name){
            $smena_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$smena_topshiriq_name->id,'topshiriq_key'=>$smena_topshiriq_name->key,'tg_user_id'=>$userID])->first();
            $smena_first_date=  $smena_topshiriq_name->first_date;
            $smena_end_date = $smena_topshiriq_name->end_date;
            $smena_number = $smena_topshiriq_name->number;

            $smena = $topshiriq->SMENA($userID,$smena_first_date,$smena_end_date);
            $time = new DateTime();
            $soat = new DateTime('23:59');
            $sana = new DateTime($smena_end_date);
            $intervalSana = $time->diff($sana);
            $intervalSoat = $time->diff($soat);
            $smena_days = $intervalSana->days == 0 && $intervalSoat->h == 0 && $intervalSoat->i == 0 && $intervalSoat->s == 0;


            if ($smena_days){
                if ($smena >= $smena_number){
                    if (!$smena_topshiriq_javob){
                        $smena_javob = new TopshiriqJavob();
                        $smena_javob->topshiriq_id = $smena_topshiriq_name->id;
                        $smena_javob->tg_user_id = $userID;
                        $smena_javob->topshiriq_key = $smena_topshiriq_name->key;
                        $smena_javob->topshiriq_done = $smena;
                        $smena_javob->topshiriq_number = $smena_number;
                        $smena_javob->topshiriq_star = $smena_topshiriq_name->star;
                        $smena_javob->status = 1;
                        $smena_javob->save();
//                     star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = $smena_topshiriq_name->star;
                        $star->level = $level_user->level_user;
                        $star->save();
//                     end star
                    }
                }else{
                    if (!$smena_topshiriq_javob){
                        $smena_javob = new TopshiriqJavob();
                        $smena_javob->topshiriq_id = $smena_topshiriq_name->id;
                        $smena_javob->tg_user_id = $userID;
                        $smena_javob->topshiriq_key = $smena_topshiriq_name->key;
                        $smena_javob->topshiriq_done = $smena;
                        $smena_javob->topshiriq_number = $smena_number;
                        $smena_javob->topshiriq_star = 0;
                        $smena_javob->status = 0;
                        $smena_javob->save();
//                     star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = 0;
                        $star->level = $level_user->level_user;
                        $star->save();
//                     end star
                    }
                }
            }else{
                if ($smena >= $smena_number){
                    if (!$smena_topshiriq_javob){
                        $javob = new TopshiriqJavob();
                        $javob->topshiriq_id = $smena_topshiriq_name->id;
                        $javob->tg_user_id = $userID;
                        $javob->topshiriq_key = $smena_topshiriq_name->key;
                        $javob->topshiriq_done = $smena;
                        $javob->topshiriq_number = $smena_number;
                        $javob->topshiriq_star = $smena_topshiriq_name->star;
                        $javob->status = 1;
                        $javob->save();
//                     star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = $smena_topshiriq_name->star;
                        $star->level = $level_user->level_user;
                        $star->save();
//                     end star
                    }
                }
            }
        }

//         END SMENA

//         Savdo 300
        $userID = \auth()->user()->id;
        $savdo_topshiriq_name = Topshiriq::where(['key'=>'savdo_300','status'=>1])->first();
        if ($savdo_topshiriq_name){
            $savdo_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$savdo_topshiriq_name->id,'topshiriq_key'=>$savdo_topshiriq_name->key,'tg_user_id'=>$userID])->first();
            $savdo_first_date=  $savdo_topshiriq_name->first_date;
            $savdo_end_date = $savdo_topshiriq_name->end_date;
            $savdo_number = $savdo_topshiriq_name->number;

            $savdo = $topshiriq->savdo_300($userID,$savdo_first_date,$savdo_end_date);
            $time = new DateTime();
            $soat = new DateTime('23:59');
            $sana = new DateTime($savdo_end_date);
            $intervalSana = $time->diff($sana);
            $intervalSoat = $time->diff($soat);
            $savdo_days = $intervalSana->days == 0 && $intervalSoat->h == 0 && $intervalSoat->i == 0 && $intervalSoat->s == 0;


            if ($savdo_days){
                if ($savdo >= $savdo_number){
                    if (!$savdo_topshiriq_javob){
                        $savdo_javob = new TopshiriqJavob();
                        $savdo_javob->topshiriq_id = $savdo_topshiriq_name->id;
                        $savdo_javob->tg_user_id = $userID;
                        $savdo_javob->topshiriq_key = $savdo_topshiriq_name->key;
                        $savdo_javob->topshiriq_done = $savdo;
                        $savdo_javob->topshiriq_number = $savdo_number;
                        $savdo_javob->topshiriq_star = $savdo_topshiriq_name->star;
                        $savdo_javob->status = 1;
                        $savdo_javob->save();
//                     star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = $savdo_topshiriq_name->star;
                        $star->level = $level_user->level_user;
                        $star->save();
//                     end star
                    }
                }else{
                    if (!$savdo_topshiriq_javob){
                        $savdo_javob = new TopshiriqJavob();
                        $savdo_javob->topshiriq_id = $savdo_topshiriq_name->id;
                        $savdo_javob->tg_user_id = $userID;
                        $savdo_javob->topshiriq_key = $savdo_topshiriq_name->key;
                        $savdo_javob->topshiriq_done = $savdo;
                        $savdo_javob->topshiriq_number = $savdo_number;
                        $savdo_javob->topshiriq_star = 0;
                        $savdo_javob->status = 0;
                        $savdo_javob->save();
//                     star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = 0;
                        $star->level = $level_user->level_user;
                        $star->save();
//                     end star
                    }
                }
            }else{
                if ($savdo >= $savdo_number){
                    if (!$savdo_topshiriq_javob){
                        $javob = new TopshiriqJavob();
                        $javob->topshiriq_id = $savdo_topshiriq_name->id;
                        $javob->tg_user_id = $userID;
                        $javob->topshiriq_key = $savdo_topshiriq_name->key;
                        $javob->topshiriq_done = $savdo;
                        $javob->topshiriq_number = $savdo_number;
                        $javob->topshiriq_star = $savdo_topshiriq_name->star;
                        $javob->status = 1;
                        $javob->save();
//                     star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = $savdo_topshiriq_name->star;
                        $star->level = $level_user->level_user;
                        $star->save();
//                     end star
                    }
                }
            }
        }

//         end Savdo 300


//         Oltin Sut
        $oltin_sut_topshiriq_name = Topshiriq::where(['key'=>'oltin_sut','status'=>1])->first();
        if ($oltin_sut_topshiriq_name){
            $oltin_sut_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$oltin_sut_topshiriq_name->id,'topshiriq_key'=>$oltin_sut_topshiriq_name->key,'tg_user_id'=>$userID])->first();
            $oltin_sut_first_date =  $oltin_sut_topshiriq_name->first_date;
            $oltin_sut_end_date = $oltin_sut_topshiriq_name->end_date;
            $oltin_sut_number = $oltin_sut_topshiriq_name->number;

            $oltin_sut = $topshiriq->oltin_sut($userID,$oltin_sut_first_date,$oltin_sut_end_date);
            $time = new DateTime();
            $soat = new DateTime('23:59');
            $sana = new DateTime($oltin_sut_end_date);
            $intervalSana = $time->diff($sana);
            $intervalSoat = $time->diff($soat);
            $oltin_sut_days = $intervalSana->days == 0 && $intervalSoat->h == 0 && $intervalSoat->i == 0 && $intervalSoat->s == 0;

            if ($oltin_sut_days){
                if ($oltin_sut >= $oltin_sut_number){
                    if (!$oltin_sut_topshiriq_javob){
                        $oltin_sut_javob = new TopshiriqJavob();
                        $oltin_sut_javob->topshiriq_id = $oltin_sut_topshiriq_name->id;
                        $oltin_sut_javob->tg_user_id = $userID;
                        $oltin_sut_javob->topshiriq_key = $oltin_sut_topshiriq_name->key;
                        $oltin_sut_javob->topshiriq_done = $oltin_sut;
                        $oltin_sut_javob->topshiriq_number = $oltin_sut_number;
                        $oltin_sut_javob->topshiriq_star = $oltin_sut_topshiriq_name->star;
                        $oltin_sut_javob->status = 1;
                        $oltin_sut_javob->save();
//                    star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = $oltin_sut_topshiriq_name->star;
                        $star->level = $level_user->level_user;
                        $star->save();
//                    end star
                        if (!$user_crystall){
                            $crystall = new UserCrystall();
                            $crystall->user_id = $userID;
                            $crystall->crystall = $oltin_sut_topshiriq_name->crystall;
                            $crystall->save();
                        }else{
                            DB::table('user_crystalls')->where('user_id',$userID)->update([
                                'crystall'=>$user_crystall->crystall + $oltin_sut_topshiriq_name->crystall
                            ]);
                        }

                    }
                }else{
                    if (!$oltin_sut_topshiriq_javob){
                        $oltin_sut_javob = new TopshiriqJavob();
                        $oltin_sut_javob->topshiriq_id = $oltin_sut_topshiriq_name->id;
                        $oltin_sut_javob->tg_user_id = $userID;
                        $oltin_sut_javob->topshiriq_key = $oltin_sut_topshiriq_name->key;
                        $oltin_sut_javob->topshiriq_done = $oltin_sut;
                        $oltin_sut_javob->topshiriq_number = $oltin_sut_number;
                        $oltin_sut_javob->topshiriq_star = 0;
                        $oltin_sut_javob->status = 0;
                        $oltin_sut_javob->save();
//                     star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = 0;
                        $star->level = $level_user->level_user;
                        $star->save();
//                     end star
                        if (!$user_crystall){
                            $crystall = new UserCrystall();
                            $crystall->user_id = $userID;
                            $crystall->crystall = 0;
                            $crystall->save();
                        }else{
                            DB::table('user_crystalls')->where('user_id',$userID)->update([
                                'crystall'=>$user_crystall->crystall + 0
                            ]);
                        }
                    }
                }
            }else{
                if ($oltin_sut >= $oltin_sut_number){
                    if (!$oltin_sut_topshiriq_javob){
                        $javob = new TopshiriqJavob();
                        $javob->topshiriq_id = $oltin_sut_topshiriq_name->id;
                        $javob->tg_user_id = $userID;
                        $javob->topshiriq_key = $oltin_sut_topshiriq_name->key;
                        $javob->topshiriq_done = $oltin_sut;
                        $javob->topshiriq_number = $oltin_sut_number;
                        $javob->topshiriq_star = $oltin_sut_topshiriq_name->star;
                        $javob->status = 1;
                        $javob->save();
//                     star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = $oltin_sut_topshiriq_name->star;
                        $star->level = $level_user->level_user;
                        $star->save();
//                     end star
                        if (!$user_crystall){
                            $crystall = new UserCrystall();
                            $crystall->user_id = $userID;
                            $crystall->crystall = $oltin_sut_topshiriq_name->crystall;
                            $crystall->save();
                        }else{
                            DB::table('user_crystalls')->where('user_id',$userID)->update([
                                'crystall'=>$user_crystall->crystall + $oltin_sut_topshiriq_name->crystall
                            ]);
                        }
                    }
                }
            }
        }
//         End Oltin Sut

//         Suyak Komplex
        $suyak_komplex_topshiriq_name = Topshiriq::where(['key'=>'suyak_komplex','status'=>1])->first();
        if ($suyak_komplex_topshiriq_name){
            $suyak_komplex_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$suyak_komplex_topshiriq_name->id,'topshiriq_key'=>$suyak_komplex_topshiriq_name->key,'tg_user_id'=>$userID])->first();
            $suyak_komplex_first_date =  $suyak_komplex_topshiriq_name->first_date;
            $suyak_komplex_end_date = $suyak_komplex_topshiriq_name->end_date;
            $suyak_komplex_number = $suyak_komplex_topshiriq_name->number;

            $suyak_komplex = $topshiriq->suyak_complex($userID,$suyak_komplex_first_date,$suyak_komplex_end_date);
            $time = new DateTime();
            $soat = new DateTime('23:59');
            $sana = new DateTime($suyak_komplex_end_date);
            $intervalSana = $time->diff($sana);
            $intervalSoat = $time->diff($soat);
            $suyak_komplex_days = $intervalSana->days == 0 && $intervalSoat->h == 0 && $intervalSoat->i == 0 && $intervalSoat->s == 0;

            if ($suyak_komplex_days){
                if ($suyak_komplex >= $suyak_komplex_number){
                    if (!$suyak_komplex_topshiriq_javob){
                        $suyak_komplex_javob = new TopshiriqJavob();
                        $suyak_komplex_javob->topshiriq_id = $suyak_komplex_topshiriq_name->id;
                        $suyak_komplex_javob->tg_user_id = $userID;
                        $suyak_komplex_javob->topshiriq_key = $suyak_komplex_topshiriq_name->key;
                        $suyak_komplex_javob->topshiriq_done = $suyak_komplex;
                        $suyak_komplex_javob->topshiriq_number = $suyak_komplex_number;
                        $suyak_komplex_javob->topshiriq_star = $suyak_komplex_topshiriq_name->star;
                        $suyak_komplex_javob->status = 1;
                        $suyak_komplex_javob->save();
//                     star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = $suyak_komplex_topshiriq_name->star;
                        $star->level = $level_user->level_user;
                        $star->save();
//                     end star
                        if (!$user_crystall){
                            $crystall = new UserCrystall();
                            $crystall->user_id = $userID;
                            $crystall->crystall = $suyak_komplex_topshiriq_name->crystall;
                            $crystall->save();
                        }else{
                            DB::table('user_crystalls')->where('user_id',$userID)->update([
                                'crystall'=>$user_crystall->crystall + $suyak_komplex_topshiriq_name->crystall
                            ]);
                        }
                    }
                }else{
                    if (!$suyak_komplex_topshiriq_javob){
                        $suyak_komplex_javob = new TopshiriqJavob();
                        $suyak_komplex_javob->topshiriq_id = $suyak_komplex_topshiriq_name->id;
                        $suyak_komplex_javob->tg_user_id = $userID;
                        $suyak_komplex_javob->topshiriq_key = $suyak_komplex_topshiriq_name->key;
                        $suyak_komplex_javob->topshiriq_done = $suyak_komplex;
                        $suyak_komplex_javob->topshiriq_number = $suyak_komplex_number;
                        $suyak_komplex_javob->topshiriq_star = 0;
                        $suyak_komplex_javob->status = 0;
                        $suyak_komplex_javob->save();
//                     star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = 0;
                        $star->level = $level_user->level_user;
                        $star->save();
//                    end star
                        if (!$user_crystall){
                            $crystall = new UserCrystall();
                            $crystall->user_id = $userID;
                            $crystall->crystall = 0;
                            $crystall->save();
                        }else{
                            DB::table('user_crystalls')->where('user_id',$userID)->update([
                                'crystall'=>$user_crystall->crystall + 0
                            ]);
                        }
                    }
                }
            }else{
                if ($suyak_komplex >= $suyak_komplex_number){
                    if (!$suyak_komplex_topshiriq_javob){
                        $javob = new TopshiriqJavob();
                        $javob->topshiriq_id = $suyak_komplex_topshiriq_name->id;
                        $javob->tg_user_id = $userID;
                        $javob->topshiriq_key = $suyak_komplex_topshiriq_name->key;
                        $javob->topshiriq_done = $suyak_komplex;
                        $javob->topshiriq_number = $suyak_komplex_number;
                        $javob->topshiriq_star = $suyak_komplex_topshiriq_name->star;
                        $javob->status = 1;
                        $javob->save();
//                    star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = $suyak_komplex_topshiriq_name->star;
                        $star->level = $level_user->level_user;
                        $star->save();
//                     end star
                        if (!$user_crystall){
                            $crystall = new UserCrystall();
                            $crystall->user_id = $userID;
                            $crystall->crystall = $suyak_komplex_topshiriq_name->crystall;
                            $crystall->save();
                        }else{
                            DB::table('user_crystalls')->where('user_id',$userID)->update([
                                'crystall'=>$user_crystall->crystall + $suyak_komplex_topshiriq_name->crystall
                            ]);
                        }
                    }
                }
            }
        }
//         End Suyak Komplex


//        Kombo Sotuv
        $kombo_topshiriq_name = Topshiriq::where(['key'=>'kombo_sotuv','status'=>1])->first();
        if ($kombo_topshiriq_name){
            $kombo_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$kombo_topshiriq_name->id,'topshiriq_key'=>$kombo_topshiriq_name->key,'tg_user_id'=>$userID])->first();
            $sotuv = $topshiriq->kombo_sotuv($userID);
            $kombo_sotuv = $sotuv['number'];
            $kombo_end_date = $kombo_topshiriq_name->end_date;
            $time = new DateTime();
            $soat = new DateTime('23:59');
            $sana = new DateTime($kombo_end_date);
            $intervalSana = $time->diff($sana);
            $intervalSoat = $time->diff($soat);
            $kombo_days = $intervalSana->days == 0 && $intervalSoat->h == 0 && $intervalSoat->i == 0 && $intervalSoat->s == 0;

            if ($kombo_days){
                if ($kombo_sotuv >= $kombo_topshiriq_name->number){
                    if (!$kombo_topshiriq_javob){
                        $kombo_javob = new TopshiriqJavob();
                        $kombo_javob->topshiriq_id = $kombo_topshiriq_name->id;
                        $kombo_javob->tg_user_id = $userID;
                        $kombo_javob->topshiriq_key = $kombo_topshiriq_name->key;
                        $kombo_javob->topshiriq_done = $kombo_sotuv;
                        $kombo_javob->topshiriq_number = $kombo_topshiriq_name->number;
                        $kombo_javob->topshiriq_star = $kombo_topshiriq_name->star;
                        $kombo_javob->status = 1;
                        $kombo_javob->save();
//                     star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = $kombo_topshiriq_name->number->star;
                        $star->level = $level_user->level_user;
                        $star->save();
//                     end star
                        if ($kombo_topshiriq_name->crystall){
                            if (!$user_crystall){
                                $crystall = new UserCrystall();
                                $crystall->user_id = $userID;
                                $crystall->crystall = $kombo_topshiriq_name->crystall;
                                $crystall->save();
                            }else{
                                DB::table('user_crystalls')->where('user_id',$userID)->update([
                                    'crystall'=>$user_crystall->crystall + $kombo_topshiriq_name->number->crystall
                                ]);
                            }
                        }
                    }
                }else{
                    if (!$kombo_topshiriq_javob){
                        $kombo_javob = new TopshiriqJavob();
                        $kombo_javob->topshiriq_id = $kombo_topshiriq_name->id;
                        $kombo_javob->tg_user_id = $userID;
                        $kombo_javob->topshiriq_key = $kombo_topshiriq_name->key;
                        $kombo_javob->topshiriq_done = $kombo_sotuv;
                        $kombo_javob->topshiriq_number = $kombo_topshiriq_name->number;
                        $kombo_javob->topshiriq_star = 0;
                        $kombo_javob->status = 0;
                        $kombo_javob->save();
//                     star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = 0;
                        $star->level = $level_user->level_user;
                        $star->save();
//                    end star
                        if ($kombo_topshiriq_name->crystall){
                            if (!$user_crystall){
                                $crystall = new UserCrystall();
                                $crystall->user_id = $userID;
                                $crystall->crystall = 0;
                                $crystall->save();
                            }else{
                                DB::table('user_crystalls')->where('user_id',$userID)->update([
                                    'crystall'=>$user_crystall->crystall + 0
                                ]);
                            }
                        }
                    }
                }
            }else{
                if ($kombo_sotuv >= $kombo_topshiriq_name->number){
                    if (!$kombo_topshiriq_javob){
                        $javob = new TopshiriqJavob();
                        $javob->topshiriq_id = $kombo_topshiriq_name->id;
                        $javob->tg_user_id = $userID;
                        $javob->topshiriq_key = $kombo_topshiriq_name->key;
                        $javob->topshiriq_done = $kombo_sotuv;
                        $javob->topshiriq_number = $kombo_topshiriq_name->number;
                        $javob->topshiriq_star = $kombo_topshiriq_name->star;
                        $javob->status = 1;
                        $javob->save();
//                    star
                        $star = new TopshiriqStar();
                        $star->tg_user_id = $userID;
                        $star->star = $kombo_topshiriq_name->star;
                        $star->level = $level_user->level_user;
                        $star->save();
//                     end star
                        if($kombo_topshiriq_name->crystall){
                            if (!$user_crystall){
                                $crystall = new UserCrystall();
                                $crystall->user_id = $userID;
                                $crystall->crystall = $kombo_topshiriq_name->crystall;
                                $crystall->save();
                            }else{
                                DB::table('user_crystalls')->where('user_id',$userID)->update([
                                    'crystall'=>$user_crystall->crystall + $kombo_topshiriq_name->crystall
                                ]);
                            }
                        }
                    }
                }
            }

        }
//        End Kombo Sotuv

//         Birga bir jang
        $birga_bir_topshiriq_name = Topshiriq::where(['key'=>'birga_bir','status'=>1])->first();
        if ($birga_bir_topshiriq_name){
            $birga_bir_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$birga_bir_topshiriq_name->id,'topshiriq_key'=>$birga_bir_topshiriq_name->key,'tg_user_id'=>$userID])->first();
            $birga_bir = $topshiriq->birga_bir_jang($userID);

//         return $birga_bir;
            if ($birga_bir['win_count'] >= $birga_bir_topshiriq_name->number){
                if (!$birga_bir_topshiriq_javob){
                    $birga_bir_javob = new TopshiriqJavob();
                    $birga_bir_javob->topshiriq_id = $birga_bir_topshiriq_name->id;
                    $birga_bir_javob->tg_user_id = $userID;
                    $birga_bir_javob->topshiriq_key = $birga_bir_topshiriq_name->key;
                    $birga_bir_javob->topshiriq_done = $birga_bir['win_count'];
                    $birga_bir_javob->topshiriq_number = $birga_bir_topshiriq_name->number;
                    $birga_bir_javob->topshiriq_star = $birga_bir_topshiriq_name->star;
                    $birga_bir_javob->status = 1;
                    $birga_bir_javob->save();
//                     star
                    $star = new TopshiriqStar();
                    $star->tg_user_id = $userID;
                    $star->star = $birga_bir_topshiriq_name->star;
                    $star->level = $level_user->level_user;
                    $star->save();
//                     end star
                    if ($birga_bir_topshiriq_name->crystall){
                        if (!$user_crystall){
                            $crystall = new UserCrystall();
                            $crystall->user_id = $userID;
                            $crystall->crystall = $birga_bir_topshiriq_name->crystall;
                            $crystall->save();
                        }else{
                            DB::table('user_crystalls')->where('user_id',$userID)->update([
                                'crystall'=>$user_crystall->crystall + $birga_bir_topshiriq_name->crystall
                            ]);
                        }
                    }
                }
            }
        }
//         end Birga bir jang

//        Oraliq Test
        $oraliq_test_topshiriq_name = Topshiriq::where(['key'=>'oraliq_test','status'=>1])->first();
        if ($oraliq_test_topshiriq_name){
            $oraliq_test_topshiriq_javob = TopshiriqJavob::where(['topshiriq_id'=>$oraliq_test_topshiriq_name->id,'topshiriq_key'=>$oraliq_test_topshiriq_name->key,'tg_user_id'=>$userID])->first();
            $oraliq_test = $topshiriq->OraliqTest($userID);
            if ($oraliq_test){
                if (!$oraliq_test_topshiriq_javob && $oraliq_test->success == 1){
                    $oraliq_test_javob = new TopshiriqJavob();
                    $oraliq_test_javob->topshiriq_id = $oraliq_test_topshiriq_name->id;
                    $oraliq_test_javob->tg_user_id = $userID;
                    $oraliq_test_javob->topshiriq_key = $oraliq_test_topshiriq_name->key;
                    $oraliq_test_javob->topshiriq_done = $oraliq_test->success;
                    $oraliq_test_javob->topshiriq_number = $oraliq_test_topshiriq_name->number;
                    $oraliq_test_javob->topshiriq_star = $oraliq_test_topshiriq_name->star;
                    $oraliq_test_javob->status = 1;
                    $oraliq_test_javob->save();
//                     star
                    $star = new TopshiriqStar();
                    $star->tg_user_id = $userID;
                    $star->star = $oraliq_test_topshiriq_name->star;
                    $star->level = $level_user->level_user;
                    $star->save();
//                     end star
                    if ($oraliq_test_topshiriq_name->crystall){
                        if (!$user_crystall){
                            $crystall = new UserCrystall();
                            $crystall->user_id = $userID;
                            $crystall->crystall = $oraliq_test_topshiriq_name->crystall;
                            $crystall->save();
                        }else{
                            DB::table('user_crystalls')->where('user_id',$userID)->update([
                                'crystall'=>$user_crystall->crystall + $oraliq_test_topshiriq_name->crystall
                            ]);
                        }
                    }
                }
                elseif (!$oraliq_test_topshiriq_javob && $oraliq_test->success == 0){
                    $oraliq_test_javob = new TopshiriqJavob();
                    $oraliq_test_javob->topshiriq_id = $oraliq_test_topshiriq_name->id;
                    $oraliq_test_javob->tg_user_id = $userID;
                    $oraliq_test_javob->topshiriq_key = $oraliq_test_topshiriq_name->key;
                    $oraliq_test_javob->topshiriq_done = $oraliq_test->success;
                    $oraliq_test_javob->topshiriq_number = $oraliq_test_topshiriq_name->number;
                    $oraliq_test_javob->topshiriq_star = $oraliq_test_topshiriq_name->star;
                    $oraliq_test_javob->status = 0;
                    $oraliq_test_javob->save();
//                     star
                    $star = new TopshiriqStar();
                    $star->tg_user_id = $userID;
                    $star->star = 0;
                    $star->level = $level_user->level_user;
                    $star->save();
//                     end star
                    if ($oraliq_test_topshiriq_name->crystall){
                        if (!$user_crystall){
                            $crystall = new UserCrystall();
                            $crystall->user_id = $userID;
                            $crystall->crystall = $oraliq_test_topshiriq_name->crystall;
                            $crystall->save();
                        }else{
                            DB::table('user_crystalls')->where('user_id',$userID)->update([
                                'crystall'=>$user_crystall->crystall + $oraliq_test_topshiriq_name->crystall
                            ]);
                        }
                    }
                }
            }
        }
//        End oraliq test

//        Plan Week

        $monday = date("Y-m-d", strtotime('monday this week'));
        $sunday = date("Y-m-d", strtotime('sunday this week'));
        $users = DB::table('topshiriq_user_plan_week')->where(['start_day'=>$monday,'end_day'=>$sunday,'status'=>1,'user_id'=>$userID])->first();

        if ($users){
            $topshiriq = new LMSTopshiriq();
            $user_id = $users->user_id;
            $plan = $users->plan_week;
            $start_day = $users->start_day;
            $end_day = $users->end_day;
            $data = $topshiriq->CheckHaftalikPlan($user_id,$start_day,$end_day,$plan);
            if ($data != null){
                $update = TopshiriqUserPlanWeek::where(['user_id'=>$user_id,'status'=>1,'start_day'=>$monday,'end_day'=>$sunday])->update([
                    'success'=>1
                ]);
//                star
                $star = new TopshiriqStar();
                $star->tg_user_id = $userID;
                $star->star = $users->star;
                $star->level = $level_user->level_user;
                $star->save();
//                     end star
            }
//            else{
//                $update = TopshiriqUserPlanWeek::where(['user_id'=>$user_id,'status'=>1,'start_day'=>$monday,'end_day'=>$sunday])->update([
//                    'success'=>0
//                ]);
//            }
        }



//        End Plan Week


//         Origin Savdo
        $user_id = auth()->user()->id;
        $topshiriq = new LMSTopshiriq();

        $monday = date("Y-m-d", strtotime('monday this week'));
        $saturday = date("Y-m-d", strtotime('saturday this week'));
        $origin_savdo = ElexirExercise::select('elexir_exercises.*','tg_medicine.name as medicine_name')
            ->where('elexir_exercises.user_id', $user_id)
            ->join('tg_medicine', 'tg_medicine.id', '=', 'elexir_exercises.medicine_id')
//            ->whereDate('elexir_exercises.start_day', '>=', $monday)
//            ->whereDate('elexir_exercises.end_day', '<=', $saturday)
            ->whereDate('elexir_exercises.start_day', '<=', $monday)
            ->whereDate('elexir_exercises.end_day', '>=', $saturday)
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

//         End Origin Savdo

        $lock = $this->lockElchiService->init(Auth::user()->id);

        $news = News::where('publish', true)->orderBy('id', "DESC")->get();



        return view('index',compact('haveTurnirBattle','battle_yes','outerMarket','lock','shifts','makeCloseShift','products','pharmacy','all_sold'
            ,'summa1'
            ,'summa2'
            ,'battle_history'
            ,'summa_bugun2'
            ,'summa_bugun1'
            ,'my_battle'
            ,'all_battle'
            ,'battle_start_day'
            ,'user_level_profile'
            ,'news',
            'winImage',
        ));

    }
    public function index2()
    {
        $shifts = Shift::with('pharmacy')->where('user_id',Auth::user()->id)
            ->whereDate('open_date',Carbon::now())
            ->orderBy('id','DESC')->limit(1)
            ->where('active',1)->get();

        return view('index2',compact('shifts'));
    }
    public function index3()
    {

        if(userme()->rm == 1)
        {
            return view('rm');
        }
        if(userme()->rm == 2)
        {
            return view('kurator');
        }
        $my_id = userme()->id;
        // if(getTeacher() == 0)
        // {
        //     return redirect()->route('another-teacher');
        // }
        if (count(getShogirdStar()) == 1 &&  getTestReview() == 0)
        {

            if (userme()->status == 0 && gettype(getTeacher()) != 'array') {
                $shifts123 = Shift::whereDate('close_date','<=',date('Y-m-d'))->where('user_id',$my_id)->orderBy('id','ASC')->get();
                if(count($shifts123) >= 7)
                {
                    return redirect()->route('login');
                }
            }
        }

        if (userme()->status == 4) {
            return redirect()->route('block');
        }








        $host = substr(request()->getHttpHost(),0,3);
        if($host == 127)
        {
            // $sold_date = '2023-02-04';
            // $battle_date = date('2023-02-04');
            $battle_date = date('Y-m-d');
            $sold_date = date('Y-m-d');

        }else{
            $battle_date = date('Y-m-d');
            $sold_date = date('Y-m-d');

        }
        if (count(getOneMonthUser()) != 0)
        {
            $my_battle_all = UserBattle::with('u1ids','u2ids')
                ->where(function($query) use ($my_id){
                    $query->where('u1id',$my_id)
                        ->orWhere('u2id',$my_id);
                })->get();


            if(count($my_battle_all) < 2)
            {
                $b = new NewUserOneMonthService;
                $bser = $b->getBattle($my_id);
            }

            $my_battle_all_ends = UserBattle::with('u1ids','u2ids')
                ->where(function($query) use ($my_id){
                    $query->where('u1id',$my_id)
                        ->orWhere('u2id',$my_id);
                })->where('ends',1)->get();


            if(count($my_battle_all_ends) < 2)
            {
                $my_battle = UserBattle::with('u1ids','u2ids')
                    ->whereDate('start_day','<=',$battle_date)
                    ->whereDate('end_day','>=',$battle_date)
                    ->where(function($query) use ($my_id){
                        $query->where('u1id',$my_id)
                            ->orWhere('u2id',$my_id);
                    })->get();

                // return count($my_battle);

                $battle_yes = 'yes';
            }else{
                $my_battle = UserBattle::with('u1ids','u2ids')
                    ->whereDate('start_day','<=',$battle_date)
                    ->whereDate('end_day','>=',$battle_date)
                    ->where(function($query) use ($my_id){
                        $query->where('u1id',$my_id)
                            ->orWhere('u2id',$my_id);
                    })->get();

                $battle_yes = 'yes';

                if(count($my_battle) == 0)
                {
                    $battle_yes = 'no';
                }
                if(count($my_battle) == 2)
                {
                    $my_battle = UserBattle::with('u1ids','u2ids')->where('bot',0)
                        ->whereDate('start_day','<=',$battle_date)
                        ->whereDate('end_day','>=',$battle_date)
                        ->where(function($query) use ($my_id){
                            $query->where('u1id',$my_id)
                                ->orWhere('u2id',$my_id);
                        })->get();
                    $battle_yes = 'yes';
                }


                $n = new HelperServices;
                $my_jang = $n->myBattle($my_battle,$sold_date);
                $summa1 = $my_jang->summa1;
                $summa2 = $my_jang->summa2;
                $summa_bugun1 = $my_jang->summa_bugun1;
                $summa_bugun2 = $my_jang->summa_bugun2;
                $battle_start_day = $my_jang->battle_start_day;
            }


            if(count($my_battle_all) == 1)
            {
                $n = new NewUserOneMonthService;
                $my_jang = $n->myFirstFakeBattle($my_battle,$sold_date);
                $summa1 = $my_jang->summa1;
                $summa2 = $my_jang->summa2;
                $summa_bugun1 = $my_jang->summa_bugun1;
                $summa_bugun2 = $my_jang->summa_bugun2;
                $battle_start_day = $my_jang->battle_start_day;
            }elseif(count($my_battle_all) == 2)
            {
                $n = new NewUserOneMonthService;
                $my_jang = $n->mySecondFakeBattle($my_battle,$sold_date);
                $summa1 = $my_jang->summa1;
                $summa2 = $my_jang->summa2;
                $summa_bugun1 = $my_jang->summa_bugun1;
                $summa_bugun2 = $my_jang->summa_bugun2;
                $battle_start_day = $my_jang->battle_start_day;
            }else{
                $my_battle = UserBattle::with('u1ids','u2ids')
                    ->whereDate('start_day','<=',$battle_date)
                    ->whereDate('end_day','>=',$battle_date)
                    ->where(function($query) use ($my_id){
                        $query->where('u1id',$my_id)
                            ->orWhere('u2id',$my_id);
                    })->get();

                $battle_yes = 'yes';

                if(count($my_battle) == 0)
                {
                    $battle_yes = 'no';
                }
                if(count($my_battle) == 2)
                {
                    $my_battle = UserBattle::with('u1ids','u2ids')->where('bot',0)
                        ->whereDate('start_day','<=',$battle_date)
                        ->whereDate('end_day','>=',$battle_date)
                        ->where(function($query) use ($my_id){
                            $query->where('u1id',$my_id)
                                ->orWhere('u2id',$my_id);
                        })->get();
                    $battle_yes = 'yes';
                }


                $n = new HelperServices;
                $my_jang = $n->myBattle($my_battle,$sold_date);
                $summa1 = $my_jang->summa1;
                $summa2 = $my_jang->summa2;
                $summa_bugun1 = $my_jang->summa_bugun1;
                $summa_bugun2 = $my_jang->summa_bugun2;
                $battle_start_day = $my_jang->battle_start_day;
            }


        }else{
            $my_battle = UserBattle::with('u1ids','u2ids')
                ->whereDate('start_day','<=',$battle_date)
                ->whereDate('end_day','>=',$battle_date)
                ->where(function($query) use ($my_id){
                    $query->where('u1id',$my_id)
                        ->orWhere('u2id',$my_id);
                })->get();

            $battle_yes = 'yes';

            if(count($my_battle) == 0)
            {
                $battle_yes = 'no';
            }
            if(count($my_battle) == 2)
            {
                $my_battle = UserBattle::with('u1ids','u2ids')->where('bot',0)
                    ->whereDate('start_day','<=',$battle_date)
                    ->whereDate('end_day','>=',$battle_date)
                    ->where(function($query) use ($my_id){
                        $query->where('u1id',$my_id)
                            ->orWhere('u2id',$my_id);
                    })->get();
                $battle_yes = 'yes';
            }


            $n = new HelperServices;
            $my_jang = $n->myBattle($my_battle,$sold_date);
            $summa1 = $my_jang->summa1;
            $summa2 = $my_jang->summa2;
            $summa_bugun1 = $my_jang->summa_bugun1;
            $summa_bugun2 = $my_jang->summa_bugun2;
            $battle_start_day = $my_jang->battle_start_day;

        }
        // return $battle_start_day;


        $battle_history = UserBattle::where('ends',1)
            ->where(function($query) use ($my_id){
                $query->where('u1id',$my_id)
                    ->orWhere('u2id',$my_id);
            })->orderBy('id','DESC')->get();
        foreach ($battle_history as $key => $value) {
            if($value->u2id == $my_id && $value->bot ==1)
            {
                unset($battle_history[$key]);
            }
        }
        $teskari2=[];
        foreach ($battle_history as $key => $value) {
            $teskari2[] = $value;
        }
        // $teskari=[];
        // foreach ($teskari2 as $key => $value) {
        //     $teskari[] = $teskari2[count($teskari2)-$key-1];
        // }
        // $battle_history = $teskari;

        $winImage = null;
        $battle_history = array_merge([], $battle_history->all());
        if(count($battle_history) > 0) {
            $winImage = $this->image->make($battle_history[count($battle_history)-1]);
        }

        // return $winImage;
        // return $battle_history[count($battle_history)-2];

        $all_battle = UserBattle::with('u1ids','u2ids','battle_elchi','battle_elchi.u1ids','battle_elchi.u2ids')
            ->where(function($query) use ($my_id){
                $query->where('u1id',$my_id)
                    ->orWhere('u2id',$my_id);
            })->orderBy('id','DESC')->get();
        foreach ($all_battle as $key => $value) {
            if($value->u2id == $my_id && $value->bot ==1)
            {
                unset($all_battle[$key]);
            }
        }

        $shifts = Shift::with('pharmacy')->where('user_id',Auth::user()->id)
            ->whereDate('open_date',Carbon::now())
            ->orderBy('id','DESC')->limit(1)
            ->where('active',1)->get();

        $makeCloseShift = Shift::with('pharmacy')->where('user_id', Auth::user()->id)
            ->whereDate('open_date', Carbon::now())
            ->orderBy('id','DESC')
            ->where('active', 0)->first();

        $close_shifts = Shift::where('user_id',Auth::user()->id)
            ->whereDate('open_date',Carbon::now())
            ->where('active',2)->pluck('pharma_id')->toArray();

        $pharmacy = PharmacyUser::with('pharmacy')->where('user_id',Auth::user()->id)->whereNotIn('pharma_id',$close_shifts)->get();

        // return $pharmacy;
        $exercise = ElchiExercise::with('exercise','exercise.medicine')->where('user_id',Auth::user()->id)->get();

        $products = Shift::with('pharmacy.shablon_pharmacy.shablon.price.medicine')->where('user_id',Auth::user()->id)
            ->whereDate('open_date',Carbon::now())
            ->where('active',1)
            ->get();
        $number_array=[];
        foreach ($exercise as $key => $value) {
            $number = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number) as number')
                ->whereDate('tg_productssold.created_at','>=','2022-11-01')
                ->where('tg_productssold.medicine_id',$value->exercise->medicine_id)
                ->where('tg_productssold.user_id',Auth::user()->id)
                ->get();

            $number_array[$value->exercise->medicine_id]=$number;
        }



        $user_exercise = ElchiUserExercise::with('medicine')->where('user_id',Auth::user()->id)->get();

        $number_array_user=[];
        foreach ($user_exercise as $key => $value) {
            $number = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number) as number')
                ->whereDate('tg_productssold.created_at','>=','2022-11-01')
                ->where('tg_productssold.medicine_id',$value->medicine_id)
                ->where('tg_productssold.user_id',Auth::user()->id)
                ->get();

            $number_array_user[$value->medicine_id]=$number;
        }

        $last_solt_day = date('Y-m-d',(strtotime ( '-3 day' , strtotime ( date('Y-m-d') ) ) ));

        $all_sold = Order::with('sold','king_sold','sold.medicine')->where('user_id',Auth::id())
            ->whereDate('created_at','>=',$last_solt_day)
            // ->whereDate('created_at',date('Y-m-d'))
            ->orderBy('id','DESC')
            ->get();

        // $n = new HelperServices;
        // $money = $n->money();
        // $week_array = $money->week_array;
        // $money_array = $money->money_array;
        // $user_money = $money->user_money;
        // $array_sold = $money->array_sold;
        // $plan_make = $money->day_make;
        // $plan_days = $money->day_plan;




        $bonus_product = ProductService::bonusProduct();
        $producte = Product::all();
        $outerMarket = OuterMarket::all();

        $weekDays = [
            0 => "Yakshanba",
            1 => "Dushanba",
            2 => "Seshanba",
            3 => "Chorshanba",
            4 => "Payshanba",
            5 => "Juma",
            6 => "Shanba"
        ];

        $lock = $this->lockElchiService->init(Auth::user()->id);
        $news = News::where('publish', true)->orderBy('id', "DESC")->get();
        if(count($my_battle) == 0)
        {
            $battle_yes = 'no';
        }
        $user_king_liga = DB::table('user_king_liga')->where('user_id', Auth::id())->first();
        $videos = Video::where('publish', true)->where('category', 0)->orderBy('id', "DESC")->get();
        $battleVideos = Video::where('publish', true)->where('category', 1)->orderBy('id', "DESC")->get();
        $infos = Info::where('publish', true)->orderBy('id', "DESC")->get();
        $turnir = new TurnirService;
        $haveTurnirBattle = $turnir->haveTurnirBattle(Auth::id());

        // return view('home',compact('haveTurnirBattle','battleVideos','makeCloseShift','user_king_liga','videos','infos','outerMarket','news','weekDays','lock','winImage','bonus_product','producte','all_sold','all_battle','battle_history','battle_start_day','summa1','summa_bugun1','summa_bugun2','summa2','my_battle','products','shifts','pharmacy','number_array','number_array_user','exercise','user_exercise','battle_yes'));
        return view('home',compact('haveTurnirBattle',));

    }
    public function index4()
    {

        if(userme()->rm == 1)
        {
            return view('rm');
        }
        if(userme()->rm == 2)
        {
            return view('kurator');
        }

        $my_id = userme()->id;

        if (userme()->status == 4) {
            return redirect()->route('block');
        }






        $host = substr(request()->getHttpHost(),0,3);
        if($host == 127)
        {
            $battle_date = date('Y-m-d');
            $sold_date = date('Y-m-d');

        }else{
            $battle_date = date('Y-m-d');
            $sold_date = date('Y-m-d');

        }

        if (count(getOneMonthUser()) != 0)
        {
            $my_battle_all = UserBattle::with('u1ids','u2ids')
                ->where(function($query) use ($my_id){
                    $query->where('u1id',$my_id)
                        ->orWhere('u2id',$my_id);
                })->get();


            if(count($my_battle_all) < 2)
            {
                $b = new NewUserOneMonthService;
                $bser = $b->getBattle($my_id);
            }

            $my_battle_all_ends = UserBattle::with('u1ids','u2ids')
                ->where(function($query) use ($my_id){
                    $query->where('u1id',$my_id)
                        ->orWhere('u2id',$my_id);
                })->where('ends',1)->get();


            if(count($my_battle_all_ends) < 2)
            {
                $my_battle = UserBattle::with('u1ids','u2ids')
                    ->whereDate('start_day','<=',$battle_date)
                    ->whereDate('end_day','>=',$battle_date)
                    ->where(function($query) use ($my_id){
                        $query->where('u1id',$my_id)
                            ->orWhere('u2id',$my_id);
                    })->get();

                // return count($my_battle);

                $battle_yes = 'yes';
            }else{
                $my_battle = UserBattle::with('u1ids','u2ids')
                    ->whereDate('start_day','<=',$battle_date)
                    ->whereDate('end_day','>=',$battle_date)
                    ->where(function($query) use ($my_id){
                        $query->where('u1id',$my_id)
                            ->orWhere('u2id',$my_id);
                    })->get();

                $battle_yes = 'yes';

                if(count($my_battle) == 0)
                {
                    $battle_yes = 'no';
                }
                if(count($my_battle) == 2)
                {
                    $my_battle = UserBattle::with('u1ids','u2ids')->where('bot',0)
                        ->whereDate('start_day','<=',$battle_date)
                        ->whereDate('end_day','>=',$battle_date)
                        ->where(function($query) use ($my_id){
                            $query->where('u1id',$my_id)
                                ->orWhere('u2id',$my_id);
                        })->get();
                    $battle_yes = 'yes';
                }


                $n = new HelperServices;
                $my_jang = $n->myBattle($my_battle,$sold_date);
                $summa1 = $my_jang->summa1;
                $summa2 = $my_jang->summa2;
                $summa_bugun1 = $my_jang->summa_bugun1;
                $summa_bugun2 = $my_jang->summa_bugun2;
                $battle_start_day = $my_jang->battle_start_day;
            }


            if(count($my_battle_all) == 1)
            {
                $n = new NewUserOneMonthService;
                $my_jang = $n->myFirstFakeBattle($my_battle,$sold_date);
                $summa1 = $my_jang->summa1;
                $summa2 = $my_jang->summa2;
                $summa_bugun1 = $my_jang->summa_bugun1;
                $summa_bugun2 = $my_jang->summa_bugun2;
                $battle_start_day = $my_jang->battle_start_day;
            }elseif(count($my_battle_all) == 2)
            {
                $n = new NewUserOneMonthService;
                $my_jang = $n->mySecondFakeBattle($my_battle,$sold_date);
                $summa1 = $my_jang->summa1;
                $summa2 = $my_jang->summa2;
                $summa_bugun1 = $my_jang->summa_bugun1;
                $summa_bugun2 = $my_jang->summa_bugun2;
                $battle_start_day = $my_jang->battle_start_day;
            }else{
                $my_battle = UserBattle::with('u1ids','u2ids')
                    ->whereDate('start_day','<=',$battle_date)
                    ->whereDate('end_day','>=',$battle_date)
                    ->where(function($query) use ($my_id){
                        $query->where('u1id',$my_id)
                            ->orWhere('u2id',$my_id);
                    })->get();

                $battle_yes = 'yes';

                if(count($my_battle) == 0)
                {
                    $battle_yes = 'no';
                }
                if(count($my_battle) == 2)
                {
                    $my_battle = UserBattle::with('u1ids','u2ids')->where('bot',0)
                        ->whereDate('start_day','<=',$battle_date)
                        ->whereDate('end_day','>=',$battle_date)
                        ->where(function($query) use ($my_id){
                            $query->where('u1id',$my_id)
                                ->orWhere('u2id',$my_id);
                        })->get();
                    $battle_yes = 'yes';
                }


                $n = new HelperServices;
                $my_jang = $n->myBattle($my_battle,$sold_date);
                $summa1 = $my_jang->summa1;
                $summa2 = $my_jang->summa2;
                $summa_bugun1 = $my_jang->summa_bugun1;
                $summa_bugun2 = $my_jang->summa_bugun2;
                $battle_start_day = $my_jang->battle_start_day;
            }


        }else{
            $my_battle = UserBattle::with('u1ids','u2ids')
                ->whereDate('start_day','<=',$battle_date)
                ->whereDate('end_day','>=',$battle_date)
                ->where(function($query) use ($my_id){
                    $query->where('u1id',$my_id)
                        ->orWhere('u2id',$my_id);
                })->get();

            $battle_yes = 'yes';

            if(count($my_battle) == 0)
            {
                $battle_yes = 'no';
            }
            if(count($my_battle) == 2)
            {
                $my_battle = UserBattle::with('u1ids','u2ids')->where('bot',0)
                    ->whereDate('start_day','<=',$battle_date)
                    ->whereDate('end_day','>=',$battle_date)
                    ->where(function($query) use ($my_id){
                        $query->where('u1id',$my_id)
                            ->orWhere('u2id',$my_id);
                    })->get();
                $battle_yes = 'yes';
            }


            $n = new HelperServices;
            $my_jang = $n->myBattle($my_battle,$sold_date);
            $summa1 = $my_jang->summa1;
            $summa2 = $my_jang->summa2;
            $summa_bugun1 = $my_jang->summa_bugun1;
            $summa_bugun2 = $my_jang->summa_bugun2;
            $battle_start_day = $my_jang->battle_start_day;

        }


        $battle_history = UserBattle::where('ends',1)
            ->where(function($query) use ($my_id){
                $query->where('u1id',$my_id)
                    ->orWhere('u2id',$my_id);
            })->orderBy('id','DESC')->get();
        foreach ($battle_history as $key => $value) {
            if($value->u2id == $my_id && $value->bot ==1)
            {
                unset($battle_history[$key]);
            }
        }
        $teskari2=[];
        foreach ($battle_history as $key => $value) {
            $teskari2[] = $value;
        }




        $all_battle = UserBattle::with('u1ids','u2ids','battle_elchi','battle_elchi.u1ids','battle_elchi.u2ids')
            ->where(function($query) use ($my_id){
                $query->where('u1id',$my_id)
                    ->orWhere('u2id',$my_id);
            })->orderBy('id','DESC')->get();
        foreach ($all_battle as $key => $value) {
            if($value->u2id == $my_id && $value->bot ==1)
            {
                unset($all_battle[$key]);
            }
        }

        $shifts = Shift::with('pharmacy')->where('user_id',Auth::user()->id)
            ->whereDate('open_date',Carbon::now())
            ->orderBy('id','DESC')->limit(1)
            ->where('active',1)->get();

        $makeCloseShift = Shift::with('pharmacy')->where('user_id', Auth::user()->id)
            ->whereDate('open_date', Carbon::now())
            ->orderBy('id','DESC')
            ->where('active', 0)->first();

        $close_shifts = Shift::where('user_id',Auth::user()->id)
            ->whereDate('open_date',Carbon::now())
            ->where('active',2)->pluck('pharma_id')->toArray();

        $pharmacy = PharmacyUser::with('pharmacy')->where('user_id',Auth::user()->id)->whereNotIn('pharma_id',$close_shifts)->get();

        // $exercise = ElchiExercise::with('exercise','exercise.medicine')->where('user_id',Auth::user()->id)->get();

        $products = Shift::with('pharmacy.shablon_pharmacy.shablon.price.medicine')->where('user_id',Auth::user()->id)
            ->whereDate('open_date',Carbon::now())
            ->where('active',1)
            ->get();
        // $number_array=[];
        // foreach ($exercise as $key => $value) {
        //     $number = DB::table('tg_productssold')
        //             ->selectRaw('SUM(tg_productssold.number) as number')
        //             ->whereDate('tg_productssold.created_at','>=','2022-11-01')
        //             ->where('tg_productssold.medicine_id',$value->exercise->medicine_id)
        //             ->where('tg_productssold.user_id',Auth::user()->id)
        //             ->get();

        //         $number_array[$value->exercise->medicine_id]=$number;
        // }



        // $user_exercise = ElchiUserExercise::with('medicine')->where('user_id',Auth::user()->id)->get();

        // $number_array_user=[];
        // foreach ($user_exercise as $key => $value) {
        //     $number = DB::table('tg_productssold')
        //             ->selectRaw('SUM(tg_productssold.number) as number')
        //             ->whereDate('tg_productssold.created_at','>=','2022-11-01')
        //             ->where('tg_productssold.medicine_id',$value->medicine_id)
        //             ->where('tg_productssold.user_id',Auth::user()->id)
        //             ->get();

        //         $number_array_user[$value->medicine_id]=$number;
        // }

        $last_solt_day = date('Y-m-d',(strtotime ( '-3 day' , strtotime ( date('Y-m-d') ) ) ));

        $all_sold = Order::with('sold','king_sold','sold.medicine')->where('user_id',Auth::id())
            ->whereDate('created_at','>=',$last_solt_day)
            ->orderBy('id','DESC')
            ->get();





        // $bonus_product = ProductService::bonusProduct();
        // $producte = Product::all();



        $lock = $this->lockElchiService->init(Auth::user()->id);
        $news = News::where('publish', true)->orderBy('id', "DESC")->get();
        // if(count($my_battle) == 0)
        // {
        //     $battle_yes = 'no';
        // }
        // $user_king_liga = DB::table('user_king_liga')->where('user_id', Auth::id())->first();
        $videos = Video::where('publish', true)->where('category', 0)->orderBy('id', "DESC")->get();
        // $battleVideos = Video::where('publish', true)->where('category', 1)->orderBy('id', "DESC")->get();
        $infos = Info::where('publish', true)->orderBy('id', "DESC")->get();
        // $turnir = new TurnirService;
        // $haveTurnirBattle = $turnir->haveTurnirBattle(Auth::id());

        $userId = Auth::id();
        $date_mini = megaMini();
        $begin = $date_mini['begin'];
        $end = $date_mini['end'];
        $sold = $date_mini['sold'];


        $users_battles = MegaTurnirUserBattle::with('user1','user2')
            ->whereDate('begin','=',$begin)
            ->whereDate('end','=',$end)
            ->where(function($query) use ($userId){
                $query->where('user1id',$userId)
                    ->orWhere('user2id',$userId);
            })
            ->first();

        if(!$users_battles)
        {
            $users_battles = MegaTurnirTeamBattle::with('user1','user2')
                ->whereDate('begin','=',$begin)
                ->whereDate('end','=',$end)
                ->where(function($query) use ($userId){
                    $query->where('user1id',$userId)
                        ->orWhere('user2id',$userId);
                })
                ->first();

            if($users_battles)
            {
                $haveTurnirBattle = 1;
            }else{
                $haveTurnirBattle = 0;
            }
        }else{
            $haveTurnirBattle = 1;

        }

        $ard = [323,232];

        // $winImage = null;
        // $battle_history = array_merge([], $battle_history->all());
        // if(count($battle_history) > 0) {
        //     $winImage = $this->image->make($users_battles);
        // }
        $userId = Auth::id();
        $date_mini = megaTurnir();
        $begin = $date_mini['begin'];
        $end = $date_mini['end'];
        $sold = $date_mini['sold'];

        if(in_array($userId,$ard))
        {
            $haveTurnirBattle = 1;
        }



        $outerMarket = OuterMarket::all();
        $battle_yes = 'no';

        if($userId == 474)
        {
            $battle_yes = 'yes';

        }
        return $news;
        return view('index',compact('videos','infos','battle_yes','outerMarket','lock','haveTurnirBattle','news','shifts','makeCloseShift','products','pharmacy','all_sold'
            ,'summa1'
            ,'summa2'
            ,'battle_history'
            ,'summa_bugun2'
            ,'summa_bugun1'
            ,'my_battle'
            ,'all_battle'
            ,'battle_start_day'
        ));

    }
    public function rm()
    {

    }
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return the server IP if the client IP is not found using this method.
    }
}
