<?php

namespace App\Http\Controllers;

use App\Models\AllSold;
use App\Models\MegaTurnirTeamBattle;
use App\Models\MegaTurnirUserBattle;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
        return view('home',compact('haveTurnirBattle'));

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
        // if (count(getShogirdStar()) == 1 &&  getTestReview() == 0)
        // {

        //     if (userme()->status == 0 && gettype(getTeacher()) != 'array') {
        //         $shifts123 = Shift::whereDate('close_date','<=',date('Y-m-d'))->where('user_id',$my_id)->orderBy('id','ASC')->get();
        //         if(count($shifts123) >= 7)
        //         {
        //             return redirect()->route('login');
        //         }
        //     }
        // }





            // $fsd = new UserBattleService;

            // $ff = $fsd->battle('2023-09-14');

            // dd($ff);




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

        $winImage = null;
        $battle_history = array_merge([], $battle_history->all());
        if(count($battle_history) > 0) {
            // $winImage = $this->image->make($battle_history[count($battle_history)-1]);
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
        $begin = '2023-12-05';
        $end = '2023-12-07';

        $soldd = '2023-12-07';


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


        // return $haveTurnirBattle;
        $outerMarket = OuterMarket::all();
        $battle_yes = 'no';
        // return $my_battle;
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
