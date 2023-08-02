<?php
use App\Models\AllSold;
use App\Models\Client;
use App\Models\District;
use App\Models\ElchiBall;
use App\Models\ElchiElexir;
use App\Models\ElchiLevel;
use App\Models\ElexirHistory;
use App\Models\KingSoldBattle;
use App\Models\Liga;
use App\Models\Medicine;
use App\Models\News;
use App\Models\NewUserOneMonth;
use App\Models\Pharmacy;
use App\Models\Premya;
use App\Models\PremyaTask;
use App\Models\Price;
use App\Models\Region;
use App\Models\Shift;
use App\Models\ShiftCode;
use App\Models\TeacherUser;
use App\Models\TeachGradeStar;
use App\Models\TeachStudQues;
use App\Models\TestReview;
use App\Models\User;
use App\Models\UserCrystall;
use App\Models\UserLiga;
use App\Services\ExerciseServices;
use App\Services\HelperServices;
use App\Services\MoneyService;
use App\Services\PlanServices;
use App\Services\TeamBattleServices;
use App\Services\UserProfilService;
use App\Services\WorkDayServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

if(!function_exists('userme')){
    function userme() {

        return Session::get('userme');

    }
}

if(!function_exists('recommendNews')){
    function recommendNews(){
        $newsIds = News::where('publish', true)->pluck('id');
        $count = News::where('publish', true)->count();
        $index = rand(0,$count - 1);
        $id = $newsIds[$index];
        $news = News::find($id);
        Session::flash('recommendNews', $news);
    }
}

if(!function_exists('userNickName')){
    function userNickName($id) {
        $nick = "Chaqaloq";
        $date_joined = User::where('id', $id)->first()->date_joined;
        $interval = strtotime(now()) - strtotime($date_joined);
        $days = round($interval / 86400);
        if($days > 30 && $days < 180) {
            $nick = "Jangchi";
        } else {
            $nick = "Oqsoqol";
        }
        return $nick;
    }
}



if(!function_exists('createShiftCode')){
    function createShiftCode($number) {

        $alifbe = ['A','B','C','D','E','F','G','H','J','K','L','M','N','O','P','Q','R','S','T','U','V','Y','W','X','Z'];
        $open = $alifbe[rand(0,24)].rand(10,99);
        $close = $alifbe[rand(0,24)].rand(10,99);

        $new_smena_code = new ShiftCode([
            'open' => $open,
            'close' => $close,
            'number' => $number
        ]);
        $new_smena_code->save();

        return $new_smena_code;

    }
}
if(!function_exists('userLevel')){
    function userLevel() {

        $level = ElchiLevel::where('user_id',Auth::user()->id)->value('level');
        return $level;

    }
}
if(!function_exists('userBall')){
    function userBall() {

        $elchi_ball = ElchiBall::where('user_id',userme()->id)->first();
        return $elchi_ball;

    }
}
if(!function_exists('userElexir')){
    function userElexir() {

        $elchi_elexir = ElchiElexir::where('user_id',userme()->id)->first();
        return $elchi_elexir;

    }
}
if(!function_exists('kuboks')){
    function kuboks() {

        if(Auth::user()->rm == 0)
        {
            if(Auth::user()->specialty_id == 1)
            {
                $userin = User::where('specialty_id',1)->pluck('id')->toArray();
            }else{
                $userin = User::where('specialty_id',9)->pluck('id')->toArray();
            }
        }else{
            $userin = User::pluck('id')->toArray();
        }



        $startday = date('Y-m-d',(strtotime ( '-30 day' , strtotime ( date('Y-m-d') ) ) ));

        $new_user_in = [];

        foreach ($userin as $key => $value) {

            $summa = DB::table('tg_productssold')
                        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                        ->whereDate('tg_productssold.created_at','>=',$startday)
                        ->where('tg_productssold.user_id','=',$value)
                        ->get()[0]->allprice;
            if($summa != null)
            {
                $new_user_in[] = $value;
            }
        }

        $kuboks = ElchiBall::with('user')
        ->whereIn('user_id',$new_user_in)
        ->orderBy('ball','DESC')->get();
        return $kuboks;

    }
}
if(!function_exists('daySold')){
    function daySold($number = FALSE) {

        if(Auth::user()->rm == 0)
        {
            if(Auth::user()->specialty_id == 1)
            {
                $userin = User::where('specialty_id',1)->pluck('id')->toArray();
            }else{
                $userin = User::where('specialty_id',9)->pluck('id')->toArray();
            }
        }else{
            $userin = User::pluck('id')->toArray();
        }

        if($number)
            {
                $summa = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id,tg_user.first_name,tg_user.last_name')
                ->whereDate('tg_productssold.created_at',date('Y-m-d'))
                ->join('tg_user','tg_user.id','tg_productssold.user_id')
                ->where('tg_user.id','!=',72)
                ->whereIn('tg_user.id',$userin)
                ->orderBy('allprice','DESC')
                ->groupBy('tg_user.id','tg_user.first_name','tg_user.last_name')->limit($number)->get();
            }else{
                $summa = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id,tg_user.first_name,tg_user.last_name,tg_region.name as t')
                ->whereDate('tg_productssold.created_at',date('Y-m-d'))
                ->join('tg_user','tg_user.id','tg_productssold.user_id')
                ->join('tg_region','tg_region.id','tg_user.region_id')
                ->where('tg_user.id','!=',72)
                ->whereIn('tg_user.id',$userin)
                ->orderBy('allprice','DESC')
                ->groupBy('tg_user.id','tg_user.first_name','tg_user.last_name','t')->get();
            }
        return $summa;


    }
}
if(!function_exists('regionSold')){
    function regionSold() {

        if(Auth::user()->rm == 0)
        {
            if(Auth::user()->specialty_id == 1)
            {
                $userin = User::where('specialty_id',1)->pluck('id')->toArray();
            }else{
                $userin = User::where('specialty_id',9)->pluck('id')->toArray();
            }
        }else{
            $userin = User::pluck('id')->toArray();
        }

        $regions = DB::table('tg_productssold')
        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_region.id,tg_region.name')
        ->whereDate('tg_productssold.created_at',date('Y-m-d'))
        ->join('tg_user','tg_user.id','tg_productssold.user_id')
        ->whereIn('tg_user.id',$userin)
        ->where('tg_user.id','!=',72)
        ->whereNotIn('tg_region.id',[11,14])
        ->join('tg_region','tg_region.id','tg_user.region_id')
        ->orderBy('allprice','DESC')
        ->groupBy('tg_region.id','tg_region.name')->get();
    $arr = array();
    foreach ($regions as $key => $value) {
        $arr[] = array('allprice' => $value->allprice,'id' => $value->id, 'name' => $value->name);
    }
    $capital = DB::table('tg_productssold')
        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
        ->whereDate('tg_productssold.created_at',date('Y-m-d'))
        ->join('tg_user','tg_user.id','tg_productssold.user_id')
        ->whereIn('tg_user.id',$userin)

        ->where('tg_user.id','!=',72)
        ->whereIn('tg_region.id',[11,14])
        ->join('tg_region','tg_region.id','tg_user.region_id')
        ->get()[0]->allprice;
    if($capital != NULL)
    {
        $arr[] = array('allprice' =>  $capital , 'id' => 14, 'name' => 'Toshkent shahri');
    }

    array_multisort(array_column($arr, 'allprice'),SORT_DESC, $arr);

    return $arr;
    }
}
if(!function_exists('regionStrikeDayBad')){
    function regionStrikeDayBad() {
        $b_date = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ) ));
        $e_date = date('Y-m-d',(strtotime ( '-50 day' , strtotime ( date('Y-m-d') ) ) ));
        $mustang = [];

        $arrayDate = array();
                $Variable1 = strtotime($b_date);
                $Variable2 = strtotime($e_date);
                $sum = 0;
                for ($currentDate = $Variable1; $currentDate >= $Variable2;$currentDate -= (86400))
                {
                    $summa = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_region.id,tg_region.name')
                    ->whereDate('tg_productssold.created_at',date('Y-m-d', $currentDate))
                    ->join('tg_user','tg_user.id','tg_productssold.user_id')
                    ->where('tg_user.id','!=',72)
                    ->join('tg_region','tg_region.id','tg_user.region_id')
                    ->orderBy('allprice','ASC')
                    ->groupBy('tg_region.id','tg_region.name')->first();

                    if($summa != NULL)
                    {
                        if(count($mustang) > 0)
                        {
                            if(in_array($summa->id,$mustang))
                            {
                                $mustang[] = $summa->id;

                            }else{
                                $Variable2 = $Variable1;
                            }

                        }else{
                            $mustang[] = $summa->id;
                        }
                    }
                }
        return $mustang;
}}
if(!function_exists('regionStrikeDay')){
    function regionStrikeDay() {
        $b_date = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ) ));
        $e_date = date('Y-m-d',(strtotime ( '-50 day' , strtotime ( date('Y-m-d') ) ) ));
        $mustang = [];

        $arrayDate = array();
                $Variable1 = strtotime($b_date);
                $Variable2 = strtotime($e_date);
                $sum = 0;
                for ($currentDate = $Variable1; $currentDate >= $Variable2;$currentDate -= (86400))
                {
                    $summa = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_region.id,tg_region.name')
                    ->whereDate('tg_productssold.created_at',date('Y-m-d', $currentDate))
                    ->join('tg_user','tg_user.id','tg_productssold.user_id')
                    ->where('tg_user.id','!=',72)

                    ->join('tg_region','tg_region.id','tg_user.region_id')
                    ->orderBy('allprice','DESC')
                    ->groupBy('tg_region.id','tg_region.name')->first();
                    if($summa != NULL)
                    {
                        if(count($mustang) > 0)
                        {
                            if(in_array($summa->id,$mustang))
                            {
                                $mustang[] = $summa->id;

                            }else{
                                $Variable2 = $Variable1;
                            }

                        }else{
                            $mustang[] = $summa->id;
                        }
                    }
                }
        return $mustang;
}}
if(!function_exists('regionKingSoldStrikeDayBad')){
    function regionKingSoldStrikeDayBad() {
        $d = date('w');
        if($d = 6)
        {
            $b_date = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ) ));
        }else{
            $b_date = date('Y-m-d',(strtotime ( '-'.($d+2).' day' , strtotime ( date('Y-m-d') ) ) ));
        }
        $e_date = date('Y-m-d',(strtotime ( '-6 day' , strtotime ( $b_date )) ));

                $Variable1 = strtotime($b_date);
                $Variable2 = strtotime(date('2023-01-01'));
                $sum = 0;
                $arrayDate = array();
                $mustang = [];
                for ($currentDate = $Variable1; $currentDate >= $Variable2;$currentDate -= (7*86400))
                {
                    $end_date = date('Y-m-d',$currentDate);
                    $begin_date = date('Y-m-d',(strtotime ( '-6 day' , strtotime ( $end_date )) ));
                    $king_sold = DB::table('tg_king_sold')
                                ->selectRaw('count(tg_king_sold.id) as count,tg_region.id,tg_region.name')
                                ->where('tg_king_sold.admin_check',1)
                                ->whereDate('tg_king_sold.created_at','>=',$begin_date)
                                ->whereDate('tg_king_sold.created_at','<=',$end_date)
                                ->join('tg_order','tg_order.id','tg_king_sold.order_id')
                                ->join('tg_user','tg_user.id','tg_order.user_id')
                                ->join('tg_region','tg_region.id','tg_user.region_id')
                                ->orderBy('count','ASC')
                                ->groupBy('tg_region.id','tg_region.name')
                                ->first();

                    if($king_sold != NULL)
                    {
                        if(count($mustang) > 0)
                        {
                            if(in_array($king_sold->id,$mustang))
                            {
                                $mustang[] = $king_sold->id;

                            }else{
                                $Variable2 = $Variable1;
                            }

                        }else{
                            $mustang[] = $king_sold->id;
                        }
                    }
                }
        return $mustang;
}}
if(!function_exists('regionKingSoldStrikeDay')){
    function regionKingSoldStrikeDay() {
        $d = date('w');
        if($d = 6)
        {
            $b_date = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( date('Y-m-d') ) ) ));
        }else{
            $b_date = date('Y-m-d',(strtotime ( '-'.($d+2).' day' , strtotime ( date('Y-m-d') ) ) ));
        }
        $e_date = date('Y-m-d',(strtotime ( '-6 day' , strtotime ( $b_date )) ));

                $Variable1 = strtotime($b_date);
                $Variable2 = strtotime(date('2023-01-01'));
                $sum = 0;
                $arrayDate = array();
                $mustang = [];
                for ($currentDate = $Variable1; $currentDate >= $Variable2;$currentDate -= (7*86400))
                {
                    $end_date = date('Y-m-d',$currentDate);
                    $begin_date = date('Y-m-d',(strtotime ( '-6 day' , strtotime ( $end_date )) ));
                    $king_sold = DB::table('tg_king_sold')
                                ->selectRaw('count(tg_king_sold.id) as count,tg_region.id,tg_region.name')
                                ->where('tg_king_sold.admin_check',1)
                                ->whereDate('tg_king_sold.created_at','>=',$begin_date)
                                ->whereDate('tg_king_sold.created_at','<=',$end_date)
                                ->join('tg_order','tg_order.id','tg_king_sold.order_id')
                                ->join('tg_user','tg_user.id','tg_order.user_id')
                                ->join('tg_region','tg_region.id','tg_user.region_id')
                                ->orderBy('count','DESC')
                                ->groupBy('tg_region.id','tg_region.name')
                                ->first();
                    if($king_sold != NULL)
                    {
                        if(count($mustang) > 0)
                        {
                            if(in_array($king_sold->id,$mustang))
                            {
                                $mustang[] = $king_sold->id;

                            }else{
                                $Variable2 = $Variable1;
                            }

                        }else{
                            $mustang[] = $king_sold->id;
                        }
                    }
                }
        return $mustang;
}}
if(!function_exists('myRegion')){
    function myRegion() {
        $my_region_id = Auth::user()->region_id;
        $my_region_name = Region::find($my_region_id);
        $my_region_capitan = User::where('region_id',$my_region_id)->where('level',2)->get();
        $summa = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id,tg_user.first_name,tg_user.last_name,tg_user.date_joined')
            ->whereDate('tg_productssold.created_at','>=',date('Y-m').'-01')
            ->whereDate('tg_productssold.created_at','<=',date('Y-m-d'))
            ->where('tg_region.id',$my_region_id)
            ->where('tg_user.id','!=',72)
            ->join('tg_user','tg_user.id','tg_productssold.user_id')
            ->join('tg_region','tg_region.id','tg_user.region_id')
            ->orderBy('allprice','DESC')
            ->groupBy('tg_user.id')->get();
        $my = [];
        $my = array('id' => $my_region_id,'name' => $my_region_name,'cap' => $my_region_capitan,'array' => $summa);
        return $my;
    }
}

if(!function_exists('addDay')){
    function addDay($date,$day) {
        return date('Y-m-d',strtotime('+ '.$day.' day',strtotime($date)));
    }
}
if(!function_exists('myHost')){
    function myHost() {
        return $host = substr(request()->getHttpHost(),0,3);
    }
}

if(!function_exists('getKSBId')){
    function getKSBId() {
        $date = date('Y-m-d',strtotime('- 7 day',strtotime(getThursday())));
        $offer_uid = KingSoldBattle::whereDate('end_date','>',$date)
        ->pluck('offer_uid')
        ->toArray();
        $accept_uid = KingSoldBattle::whereDate('end_date','>',$date)
        ->pluck('accept_uid')
        ->toArray();
        $alluid = array_unique(array_merge($offer_uid,$accept_uid));
        return $alluid;
    }
}
if(!function_exists('getThursday')){
    function getThursday() {
        $d = date('w');
        if(in_array($d,[1,2,3,4]))
        {
            $b_date = Carbon::parse('this thursday')->toDateString();
        }elseif($d == 0){
            $b_date = date('Y-m-d',(strtotime ( '+3 day' , strtotime ( date('Y-m-d') ) ) ));
        }elseif($d == 5){
            $b_date = date('Y-m-d',(strtotime ( '+6 day' , strtotime ( date('Y-m-d') ) ) ));
        }else{
            $b_date = date('Y-m-d',(strtotime ( '+5 day' , strtotime ( date('Y-m-d') ) ) ));
        }
        return $b_date;
    }
}

if(!function_exists('getKSDay')){
    function getKSDay() {

        $dates = date('Y-m-d');

        $d = date('w' , strtotime( $dates ));

        if($d == 0)
        {
            $this_start = date('Y-m-d',(strtotime ( '-2 day' , strtotime ( $dates ) ) ));
            $this_end = date('Y-m-d',(strtotime ( '+6 day' , strtotime ( $this_start ) ) ));

        }elseif($d == 6)
        {
            $this_start = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $dates ) ) ));
            $this_end = date('Y-m-d',(strtotime ( '+6 day' , strtotime ( $this_start ) ) ));
        }elseif($d == 5)
        {
            $this_start = $dates;
            $this_end = date('Y-m-d',(strtotime ( '+6 day' , strtotime ( $this_start ) ) ));
        }elseif($d == 1)
        {
            $this_start = date('Y-m-d',(strtotime ( '-3 day' , strtotime ( $dates ) ) ));
            $this_end = date('Y-m-d',(strtotime ( '+6 day' , strtotime ( $this_start ) ) ));
        }
        elseif($d == 2)
        {
            $this_start = date('Y-m-d',(strtotime ( '-4 day' , strtotime ( $dates ) ) ));
            $this_end = date('Y-m-d',(strtotime ( '+6 day' , strtotime ( $this_start ) ) ));
        }
        elseif($d == 3)
        {
            $this_start = date('Y-m-d',(strtotime ( '-5 day' , strtotime ( $dates ) ) ));
            $this_end = date('Y-m-d',(strtotime ( '+6 day' , strtotime ( $this_start ) ) ));
        }else{
            $this_start = date('Y-m-d',(strtotime ( '-6 day' , strtotime ( $dates ) ) ));
            $this_end = date('Y-m-d',(strtotime ( '+6 day' , strtotime ( $this_start ) ) ));
        }

        $last_start = date('Y-m-d',(strtotime ( '-7 day' , strtotime ( $this_start ) ) ));
        $last_end = date('Y-m-d',(strtotime ( '+6 day' , strtotime ( $last_start ) ) ));

        $arr = array(
            'this_start' => $this_start,
            'this_end' => $this_end,
            'last_start' => $last_start,
            'last_end' => $last_end,
        );

        return $arr;
    }
}
if(!function_exists('getKSN')){
    function getKSN() {
        $fev_date = date('2023-03-31');
        $now_date = date('Y-m-d');

        $diff = (strtotime($now_date) - strtotime($fev_date))/3600/24;

        return floor($diff/7);
    }
}

if(!function_exists('getWeekKSCount')){
    function getWeekKSCount()
    {
        $date = date("Y-m-d");
        $day = Carbon::parse($date)->getDaysFromStartOfWeek();
        if($day >= 5) {
            $endWeek = Carbon::parse($date)->endOfWeek()->format("Y-m-d");
            $start = date("Y-m-d", strtotime('-2 day', strtotime($endWeek)));
            $end = date("Y-m-d", strtotime('+4 day', strtotime($endWeek)));
        } else {
            $startWeek = Carbon::parse($date)->startOfWeek()->format("Y-m-d");
            $start = date("Y-m-d", strtotime('-3 day', strtotime($startWeek)));
            $end = date("Y-m-d", strtotime('+3 day', strtotime($startWeek)));
        }
        return (float)DB::select("SELECT
        SUM(CASE WHEN k.status = 1 THEN 1 ELSE 0.5 END) AS count
        FROM tg_king_sold AS k
        LEFT JOIN tg_order AS o ON o.id = k.order_id
        WHERE k.admin_check = 1
        AND o.user_id = ?
        AND DATE(k.created_at) BETWEEN ? AND ?
        ",
        [Auth::id(), $start, $end])[0]->count;
        try {
        } catch (\Throwable $th) {
            return 0;
        }
    }
}

if(!function_exists('getKSCount')){
    function getKSCount($user_id,$start,$end)
    {
            $king_sold = DB::table('tg_king_sold')
            ->selectRaw('count(tg_king_sold.id) as count')
            ->where('tg_king_sold.admin_check',1)
            ->where('tg_king_sold.status',1)
            ->whereDate('tg_king_sold.created_at','>=',$start)
            ->whereDate('tg_king_sold.created_at','<=',$end)
            ->where('tg_user.id',$user_id)
            ->join('tg_order','tg_order.id','tg_king_sold.order_id')
            ->join('tg_user','tg_user.id','tg_order.user_id')
            ->get();
            if($king_sold[0]->count == null)
            {
                $count = 0;
            }else{
                $count = $king_sold[0]->count;
            }

            $king_sold05 = DB::table('tg_king_sold')
            ->selectRaw('count(tg_king_sold.id) as count')
            ->where('tg_king_sold.admin_check',1)
            ->where('tg_king_sold.status',2)
            ->whereDate('tg_king_sold.created_at','>=',$start)
            ->whereDate('tg_king_sold.created_at','<=',$end)
            ->where('tg_user.id',$user_id)
            ->join('tg_order','tg_order.id','tg_king_sold.order_id')
            ->join('tg_user','tg_user.id','tg_order.user_id')
            ->get();
            if($king_sold05[0]->count == null)
            {
                $count05 = 0;
            }else{
                $count05 = $king_sold05[0]->count;
            }
            $all_count = $count + $count05/2;


        return $all_count;
    }
}
if(!function_exists('numb')){
    function numb($number) {
        if ($number < 999999 && $number > 999) {
            // Anything less than a billion
            $format =  number_format($number / 1000).'K';
        }else if ($number < 999999999 && $number > 999999) {
            // Anything less than a billion
            $format =  number_format($number / 1000000,).'M';
        }else {
            $format = number_format($number, 0, '', '.');
        }
        return $format;
    }
}
if(!function_exists('formatterr')){
    function formatterr($number) {
        if ($number < 999999 && $number > 999) {
            // Anything less than a billion
            $format =  number_format($number / 1000).'K';
        }else if ($number < 999999999 && $number > 999999) {
            // Anything less than a billion
            $b = $number / 1000000;
            $format =  round($b, 3).'M';
        }else {
            $format = number_format($number, 0, '', '.');
        }
        return $format;
    }
}


if(!function_exists('fff')){
    function fff($date_begin,$date_end) {
        // $monthStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $enddays = date('Y-m-d',(strtotime ( Carbon::now() ) ));
        $monthStartDate = $date_begin;
        if(strtotime($date_end) > strtotime($enddays))
        {
            $endday = $enddays;
        }else{
            $endday = $date_end;
        }
        $Variable1 = strtotime($monthStartDate);
        $Variable2 = strtotime($endday);
        $arr = [];
        $arr2 = [];
        $arr3 = [];
        for ($currentDate = $Variable2; $currentDate >= $Variable1;$currentDate -= (86400))
        {


            $day_sol = DB::table('tg_productssold')
                ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                // ->whereDate('tg_productssold.created_at','=','2023-04-20')
                ->whereDate('tg_productssold.created_at','=',date('Y-m-d', $currentDate))
                ->where('tg_productssold.user_id',Auth::id())
                ->get()[0]->allprice;
            if($day_sol == NULL)
                {
                    $day_sol = 0;
                }
            $service = new WorkDayServices(Auth::id());
            // $arr2[date('Y-m-d', $currentDate)] = array('maosh' => maosh($day_sol));
            if($currentDate >= strtotime('2023-03-15') && $currentDate != strtotime(date('Y-m-d')))
            {
                $jarima = $service->getDayJarima(date('Y-m-d', $currentDate));
            }else{
                $jarima = 0;
            }
            $smena = DB::table('tg_shift')
                ->whereDate('created_at', date('Y-m-d', $currentDate))
                ->where('user_id', Auth::id())
                ->first();
            $workSchedule = DB::select("SELECT
                d.start_work AS sw,
                d.finish_work AS fw
                FROM daily_works AS d
                WHERE CASE WHEN d.finish IS NOT NULL THEN d.finish > ? ELSE d.start < ? END
                AND d.user_id = ?
            ", [date('Y-m-d', $currentDate), date('Y-m-d', $currentDate), Auth::id()]);

            if(strtotime($date_end) < strtotime(date('Y-m-d')))
            {
                $last_month = 1;
            }else{
                $last_month = 0;
            }

            $arr2[date('Y-m-d', $currentDate)] = array(
                'last_month' => $last_month,
                'maosh' => maosh($day_sol),
                'fact' => $day_sol,
                'jarima' => $jarima,
                'minut' => $service->getMinutesDate(date('Y-m-d', $currentDate),Auth::id()),
                'open_date' => $smena ? $smena->open_date : null,
                'close_date' => $smena ? $smena->close_date : null,
                'start_work' => count($workSchedule) > 0 ? $workSchedule[0]->sw : null,
                'finish_work' => count($workSchedule) > 0 ? $workSchedule[0]->fw : null
            );
        }
        return $arr2;
    }
}



if(!function_exists('myFakt')){
    function myFakt($id) {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        $new = new PlanServices;

        $fakt = $new->getFakt($start,$end,$id);

        return $fakt;
    }
}

if(!function_exists('myOylik')){
    function myOylik($id) {
        $monthStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');

        $month_sol = DB::table('tg_productssold')
        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
        ->whereDate('tg_productssold.created_at','>=',$monthStartDate)
        ->whereDate('tg_productssold.created_at','<=',date('Y-m-d'))
        ->where('tg_productssold.user_id',$id)
        ->get()[0]->allprice;

        if($month_sol == NULL)
        {
            $month_sol = 0;
        }

        $myoylik = maosh($month_sol);
        return $myoylik;
    }
}
if(!function_exists('myLastOylik')){
    function myLastOylik($id) {
        $monthStartDate = Carbon::now()->startOfMonth()->format('Y-m-d');

        $month_sol = DB::table('tg_productssold')
        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
        ->whereDate('tg_productssold.created_at','>=','2023-02-01')
        ->whereDate('tg_productssold.created_at','<=','2023-02-28')
        ->where('tg_productssold.user_id',$id)
        ->get()[0]->allprice;

        if($month_sol == NULL)
        {
            $month_sol = 0;
        }

        $myoylik = maosh($month_sol);
        return $myoylik;
    }
}
if(!function_exists('maosh')){

    function maosh($sum) {

        if($sum < 25000000)
        {
            $koef = 2000000/15000000;
            $oylik = $sum*$koef;
        }elseif ($sum >= 25000000 && $sum < 35000000) {
            $koef = 3500000/25000000;
            $oylik = $sum*$koef;
        }else{
            $koef = 5000000/35000000;
            $oylik = $sum*$koef;
        }

        return $oylik;
    }
}
if(!function_exists('getMonthM')){
    function getMonthM($month) {
        $b= new MoneyService;

        $dd = $b->getMonthMaosh($month);


        return $dd;
    }
}
if(!function_exists('getMonthMP')){
    function getMonthMP($month) {
        $b= new MoneyService;

        $dd = $b->getMonthMaoshProvizor($month);


        return $dd;
    }
}
if(!function_exists('getMonthName')){
    function getMonthName($text) {
        return getMonths()[$text];
    }
}
if(!function_exists('getMonths')){
    function getMonths() {
        return [
            'January' => 'Yanvar',
            'February' => 'Fevral',
            'March' => 'Mart',
            'April' => 'Aprel',
            'May' => 'May',
            'June' => 'Iyun',
            'July' => 'Iyul',
            'August' => 'August',
            'September' => 'Sentabr',
            'October' => 'Oktabr',
            'November' => 'Noyabr',
            'December' => 'Dekabr'
        ];
    }
}
if(!function_exists('myPlan')){
    function myPlan($id) {

        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        $new = new PlanServices;

        return $new->getPlan($start,$end,$id);
    }
}
if(!function_exists('myNextLiga')){
    function myNextLiga($id) {

        $month_start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $month_end = Carbon::now()->endOfMonth()->format('Y-m-d');
        $last_month_start = date('Y-m-d',(strtotime ( '-1 month' , strtotime ( $month_start ) ) ));
        $first_date = Carbon::createFromFormat('Y-m-d', $last_month_start)
                        ->firstOfMonth()
                        ->format('Y-m-d');
        $last_date = Carbon::createFromFormat('Y-m-d', $last_month_start)
                        ->lastOfMonth()
                        ->format('Y-m-d');

        $sum = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                    ->whereDate('tg_productssold.created_at','>=',$first_date)
                    ->whereDate('tg_productssold.created_at','<=',$last_date)
                    ->where('tg_user.id',$id)
                    // ->where('tg_user.id',178)
                    ->join('tg_user','tg_user.id','tg_productssold.user_id')
                    ->get()[0]->allprice;
        if($sum == NULL)
        {
            $sum = 0;
        }
        if($sum > 35000000)
        {
            $sum = 35000000;
        }
        $liga = Liga::where('plan','>',$sum)->orderBy('id','asc')->first()->plan;

        $new_plan = floor(($sum + $liga)/2);
        if($new_plan > 35000000)
        {
            $new_plan = 35000000;
        }
        // $liga = Liga::where('plan','>',$new_plan)->orderBy('id','asc')->first();

        $liga = Liga::where('plan','<=',$new_plan)->orderBy('plan','DESC')->first();

        return $liga;
    }
}
if(!function_exists('myLiga')){
    function myLiga($id) {

        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        $new = new PlanServices;

        return $new->getLiga($start,$end,$id);

    }
}
if(!function_exists('LigasUser')){
    function LigasUser($id) {

        $ligas = UserLiga::where('user_id',$id)->where('month',date('Y-m'))->first();

        if($ligas)
        {
            $liga = Liga::find($ligas->liga_id);
        }else{
            $liga = Liga::where('plan',0)->first();

        }

        return $liga;

    }
}

if(!function_exists('chartOylik')){
    function chartOylik() {
        $new = new PlanServices;
        $chartx = $new->chart();
        return $chartx[0];
    }
}
if(!function_exists('chartPlan')){
    function chartPlan() {
        $new = new PlanServices;
        $chartx = $new->chart();
        return $chartx[1];
    }
}
if(!function_exists('chartLiga')){
    function chartLiga() {
        $new = new PlanServices;
        $chartx = $new->chart();
        return $chartx[2];
    }
}

if(!function_exists('getAllRegion')){
    function getAllRegion() {
        $new = Region::all();
        return $new;
    }
}
if(!function_exists('getAllDistrict')){
    function getAllDistrict() {
        $new = District::all();
        return $new;
    }
}
if(!function_exists('getAllPharmacy')){
    function getAllPharmacy() {
        $new = Pharmacy::all();
        return $new;
    }
}
if(!function_exists('kurator')){
    function kurator() {

        $my_id = Auth::user()->id;
        if($my_id == 73)
        {
            $reg = Region::where('side',1)->pluck('id')->toArray();
        }else{
            $reg = Region::where('side',2)->pluck('id')->toArray();
        }

        $teams = DB::table('tg_teams')->whereIn('region_id',$reg)->pluck('id')->toArray();

        $members = DB::table('tg_members')->whereIn('team_id',$teams)->distinct('team_id')->pluck('user_id')->toArray();

        return $members;
    }
}

if(!function_exists('kuratorRegion')){
    function kuratorRegion() {

        $my_id = Auth::user()->id;
        if($my_id == 73)
        {
            $reg = Region::where('side',1)->pluck('id')->toArray();
        }else{
            $reg = Region::where('side',2)->pluck('id')->toArray();
        }

        $teams = DB::table('tg_teams')->whereIn('region_id',$reg)->get();


        $mem = [];

        foreach ($teams as $key => $value) {

            $members = DB::table('tg_members')->where('team_id',$value->id)->distinct('team_id')->pluck('user_id')->toArray();

            if(isset($members[0]))
            {
                $mem[$members[0]] = $value;
            }

        }

        return $mem;
    }
}
if(!function_exists('myTeamBattle')){
    function myTeamBattle() {
        $new = new TeamBattleServices(Auth::id());
        $arr = $new->getMyTeamBattle();
        return $arr;
    }
}

if(!function_exists('getCategoryId')){
    function getCategoryId() {
        $ids = DB::table('tg_category')->where('name','!=','Choy')->pluck('id')->toArray();
        return $ids;
    }
}
if(!function_exists('getCategoryTeaId')){
    function getCategoryTeaId() {
        $ids = DB::table('tg_category')->where('name','=','Choy')->pluck('id')->toArray();
        return $ids;
    }
}
if(!function_exists('getCategoryTeaId')){
    function getCategoryTeaId() {
        $ids = DB::table('tg_category')->where('name','=','Choy')->pluck('id')->toArray();
        return $ids;
    }
}
if(!function_exists('getLigasUserId')){
    function getLigasUserId() {
        $ids = DB::table('liga_king_users')->pluck('user_id')->toArray();
        return $ids;
    }
}
if(!function_exists('getUser')){
    function getUser($id) {
        $user = User::find($id);
        return $user;
    }
}
if(!function_exists('setRegionTosh')){
    function setRegionTosh($name) {
        if($name == 'Toshkent shahri')
        {
            $text = substr($name,0,-7);
        }elseif($name == 'Online Sharq')
        {
            $text = $name;
        }else{
            $text = substr($name,0,-9);
        }
        return $text;
    }
}
if(!function_exists('myKSBattleHistory')){
    function myKSBattleHistory() {
        $my_id = Auth::user()->id;

        $myks_battle = KingSoldBattle::with('offer_uids','accept_uids')
        ->where(function($query) use ($my_id){
                    $query->where('offer_uid',$my_id)
                    ->orWhere('accept_uid',$my_id);
                })
                ->whereDate('end_date','<',date('Y-m-d'))
                ->where('start',1)
                ->get();
        return $myks_battle;
    }
}
if(!function_exists('getExercises')){
    function getExercises() {
        $new = new ExerciseServices;
        $exercise = $new->getExercise(Auth::id());
        return $exercise;
    }
}
if(!function_exists('historyElexir')){
    function historyElexir($id) {
        $history = ElexirHistory::where('user_id',$id)->orderBy('id','DESC')->get();
        return $history;
    }
}
if(!function_exists('getBattleElexir')){
    function getBattleElexir($id,$start_day,$end_day) {
        $history = ElexirHistory::where('user_id',$id)
        ->whereDate('start_day','=',$start_day)
        ->whereDate('end_day','=',$end_day)
        ->get();

        return $history;
    }
}
if(!function_exists('alluserId')){
    function alluserId() {
        $id = User::pluck('id')->toArray();
        return $id;
    }
}
if(!function_exists('historyLiga')){
    function historyLiga($id) {
        $services = new UserProfilService;

        return $services->historyLiga($id);
    }
}
if(!function_exists('allRegion')){
    function allRegion() {

        // $summa = DB::table('tg_productssold')
        // ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_region.id,tg_region.name')
        // ->join('tg_user','tg_user.id','tg_productssold.user_id')
        // ->join('tg_region','tg_region.id','tg_user.region_id')
        // ->orderBy('allprice','DESC')
        // ->groupBy('tg_region.id','tg_region.name')
        // ->get();
        $summa = DB::select("SELECT
            rg.id, rg.name,
            COUNT(rg.id) AS count,
            (SELECT
                COALESCE(SUM(pr.number * pr.price_product), 0)
                FROM tg_productssold AS pr
                LEFT JOIN tg_user AS u ON u.id = pr.user_id
                WHERE u.region_id = rg.id
            ) AS allprice
            FROM tg_region AS rg
            LEFT JOIN tg_user AS us ON  us.region_id = rg.id
            GROUP BY rg.id
            ORDER BY allprice DESC
        ");

        return $summa;
    }
}
if(!function_exists('getShogird')){
    function getShogird() {

        $shogird = TeacherUser::where('teacher_id',Auth::id())
        ->where('first_view',0)->get();
        return $shogird;
    }
}
if(!function_exists('getTeachQuestion')){
    function getTeachQuestion() {
        $shogird = TeachStudQues::where('status',1)->get();
        return $shogird;
    }
}

if(!function_exists('getShogirdUser')){
    function getShogirdUser() {
        $shogird = TeacherUser::where('teacher_id',Auth::id())->pluck('user_id')->toArray();
        // foreach ($shogird as $key => $value) {
            $user = User::whereIn('id',$shogird)->whereIn('status',[0,1,4])->get();
        // }
        return $user;
    }
}


if(!function_exists('getRekrut')){
    function getRekrut() {
        $rekruts= DB::table('rekruts')
        ->select('tg_user.first_name as f','tg_user.last_name as l','tg_region.name as r',
                 'tg_region.name as r','tg_district.name as d',
                 'rekruts.full_name as fname','rekruts.phone','rekruts.status','rekruts.comment','rekruts.id'
                 )
        ->join('tg_user','tg_user.id','rekruts.rm_id')
        ->join('tg_region','tg_region.id','rekruts.region_id')
        ->join('tg_district','tg_district.id','rekruts.district_id')
        ->where('rekruts.rm_id',Auth::user()->id)
        ->get();

        return $rekruts;
    }
}


if(!function_exists('getShogirdStar')){
    function getShogirdStar() {
        $shogird = TeachGradeStar::where('tester_id',Auth::id())->whereDate('created_at','=',date('Y-m-d'))->get();
        return $shogird;
    }
}

if(!function_exists('getTeacher')){
    function getTeacher() {
        $a = [];
        $id = TeacherUser::where('user_id',Auth::id())->first();
        if($id == null)
        {
            return $a;

        }else{
            $ustoz = User::find($id->teacher_id);
            return $ustoz;
        }

    }
}
if(!function_exists('getMoneyExercise')){
    function getMoneyExercise() {

        $ids = PremyaTask::where('user_id',Auth::id())->whereDate('created_at','=',date('Y-m-d'))->pluck('premya_id')->toArray();

        $tasks = Premya::whereIn('id',$ids)->orderBy('id','ASC')->get();

        $pr = [];

        foreach($tasks as $key => $value)
        {
                    $bool = PremyaTask::where('user_id',Auth::id())->where('premya_id',$value->id)->exists();

            if($bool)
            {
                $ptask = PremyaTask::where('user_id',Auth::id())->where('premya_id',$value->id)->first();

                $pr[] = array('task' => $value->task,'premya' => $value->premya, 'fakt' => $ptask->prodaja,'done' => 1);
            }else{
                $pr[] = array('task' => $value->task,'premya' => $value->premya, 'done' => 0);
            }
        }

        return $pr;
    }
}
if(!function_exists('getPremya')){
    function getPremya($date_begin,$date_end) {

        if(strtotime($date_begin) >= strtotime('2023-05-01'))
        {
            $exists = PremyaTask::with('premya')->where('user_id',Auth::id())
            ->whereDate('created_at','>=',$date_begin)
            ->whereDate('created_at','<=',$date_end)
            ->where('active',1)
            ->orderBy('premya_id','ASC')
            ->get();
        }else{
            $exists = [];
        }

        return $exists;

    }
}
if(!function_exists('getPremyaDefault')){
    function getPremyaDefault($date_begin,$date_end) {

        if(strtotime($date_begin) >= strtotime('2023-05-01'))
        {
            $exists = DB::table('tg_details')->where('user_id',Auth::id())
            ->where('status',1)
            ->whereDate('created_at','>=',$date_begin)
            ->whereDate('created_at','<=',$date_end)->get();

        }else{
            $exists = [];
        }

        return $exists;

    }
}
if(!function_exists('getShtrafDefault')){
    function getShtrafDefault($date_begin,$date_end) {

        $if_user = DB::table('teacher_users')->where('user_id',Auth::id())->first();

        if($if_user)
        {
            if(strtotime($if_user->week_date) > strtotime($date_end))
            {
                $exists = [];
                return $exists;
            }else{
                if(strtotime($if_user->week_date) < strtotime($date_begin))
                {
                    $exists = DB::table('tg_details')
                    ->select('price','message',DB::raw('DATE(created_at)'))
                    ->where('user_id',Auth::id())
                    ->where('status',2)
                    ->whereDate('created_at','>=',$date_begin)
                    ->whereDate('created_at','<=',$date_end)
                    ->distinct('date')
                    ->get();
                    return $exists;

                }else{
                    $exists = DB::table('tg_details')
                    ->select('price','message',DB::raw('DATE(created_at)'))
                    ->where('user_id',Auth::id())
                    ->where('status',2)
                    ->whereDate('created_at','>=',$if_user->week_date)
                    ->whereDate('created_at','<=',$date_end)
                    ->distinct('date')
                    ->get();

                    return $exists;
                }

            }


        }
        $exists = DB::table('tg_details')
        ->select('price','message',DB::raw('DATE(created_at)'))
        ->where('user_id',Auth::id())
        ->where('status',2)
        ->whereDate('created_at','>=',$date_begin)
        ->whereDate('created_at','<=',$date_end)
        ->distinct('date')
        ->get();

        return $exists;


    }
}
if(!function_exists('getMoneyExerciseFirst')){
    function getMoneyExerciseFirst() {

        $exists = PremyaTask::where('user_id',Auth::id())->whereDate('created_at','=',date('Y-m-d'))->exists();
        if($exists)
        {
            $tasks = [];
        }else{
            $ids = PremyaTask::where('user_id',Auth::id())->pluck('premya_id')->toArray();
            $tasks = Premya::whereNotIn('id',$ids)->orderBy('id','ASC')->first();
        }

        return $tasks;
    }
}
if(!function_exists('getTodaySold')){
    function getTodaySold($id) {

        $price= AllSold::selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as price')
                ->where('user_id',$id)
                ->whereDate('created_at','=',date('Y-m-d'))
                ->get()[0]->price??0;

        return $price;
    }
}
if(!function_exists('getShogirdExercise')){
    function getShogirdExercise() {

        $my_id = Auth::user()->id;



        $user = User::find($my_id);
        $start_day = date('Y-m-d',strtotime($user->date_joined));
        $end_day = date('Y-m-d');

        $Variable1 = strtotime($start_day);
            $Variable2 = strtotime($end_day);
            $sum = [];

                for ($currentDate = $Variable1; $currentDate <= $Variable2;$currentDate += (86400))
                {
                    $price= AllSold::selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as price')
                    ->where('user_id',$my_id)
                    ->whereDate('created_at','=',date('Y-m-d',$currentDate))
                    ->get()[0]->price;

                    if ($price == null) {
                        $price = 0;
                    }

                    // $sum[date('Y-m-d',$currentDate)] = $price;
                    if($price >= 3000000)
                    {
                        $sum[date('Y-m-d',$currentDate)] = array('plan' => 3000000,'bonus' => 750000,'make' => $price,'active' => 1);
                    }
                    elseif($price >= 2500000)
                    {
                        $sum[date('Y-m-d',$currentDate)] = array('plan' => 2500000,'bonus' => 500000,'make' => $price,'active' => 1);
                    }
                    elseif($price >= 2000000)
                    {
                        $sum[date('Y-m-d',$currentDate)] = array('plan' => 2000000,'bonus' => 300000,'make' => $price,'active' => 1);
                    }
                    elseif($price >= 1500000)
                    {
                        $sum[date('Y-m-d',$currentDate)] = array('plan' => 1500000,'bonus' => 200000,'make' => $price,'active' => 1);
                    }
                    elseif($price >= 1000000)
                    {
                        $sum[date('Y-m-d',$currentDate)] = array('plan' => 1000000,'bonus' => 100000,'make' => $price,'active' => 1);
                    }
                    elseif($price >= 700000)
                    {
                        $sum[date('Y-m-d',$currentDate)] = array('plan' => 700000,'bonus' => 30000,'make' => $price,'active' => 1);
                    }
                    // else{
                    //     $sum[date('Y-m-d',$currentDate)] = array('plan' => 700000,'bonus' => 30000,'make' => $price,'active' => 0);
                    // }

                }
        return $sum;

    }
}
if(!function_exists('kingsoldcheck')){
    function kingsoldcheck() {
        $ser = new HelperServices;
        $shu = $ser->kingSoldDay('Shu hafta');
        $otgan = $ser->kingSoldDay('Oldingi hafta');

        $users = User::all();
        $check = [];
        foreach ($users as $key => $value) {
            $check[] = array('id' => $value->id,'b' =>$shu->date_begin,'e' => $shu->date_end);
            $check[] = array('id' => $value->id,'b' =>$otgan->date_begin,'e' => $otgan->date_end);
        }
        return $check;
    }
}
if(!function_exists('getShogirdPlan')){
    function getShogirdPlan() {
        $plan = 1750000;
        return $plan;
    }
}
if(!function_exists('getAllShiftShogird')){
    function getAllShiftShogird($id) {
        $user = Shift::where('user_id',$id)->get();
        return $user;
    }
}
if(!function_exists('getCloseShift')){
    function getCloseShift($id) {
        $user = Shift::where('active',2)->whereDate('close_date',date('Y-m-d'))->where('user_id',$id)->count();
        return $user;
    }
}
if(!function_exists('getTestReview')){
    function getTestReview() {
        $test = TestReview::where('tester_id',Auth::id())->count();
        $user = Shift::where('user_id',Auth::id())->count();
        if($test == 0 && $user >= 7)
        {
            return 1;
        }else{
            return 0;
        }
    }
}
if(!function_exists('getTestReviewById')){
    function getTestReviewById($id) {
        $test = TestReview::where('tester_id',Auth::id())->count();
        $user = Shift::where('user_id',$id)->count();
        if($test == 0 && $user >= 7)
        {
            return 1;
        }else{
            return 0;
        }
    }
}
if(!function_exists('getShogirdOneMonth')){
    function getShogirdOneMonth($id) {
        $user = NewUserOneMonth::where('user_id',$id)->where('active',1)->count();
        return $user;
    }
}

if(!function_exists('getShogirdFact')){
    function getShogirdFact($id) {

        $week_date = TeacherUser::where('user_id',$id)->first();


        $shifts = Shift::whereDate('close_date', '<=', date('Y-m-d'))
                            ->whereDate('close_date', '>=', $week_date->week_date)
                            ->where('user_id', $id)->orderBy('id', 'ASC')->limit(7)->get();

        if(count($shifts) == 0)
        {
            $ndate = date('Y-m-d');
        }else{
            $ndate = date('Y-m-d',strtotime($shifts[count($shifts)-1]->open_date));

        }
        $month_sol = DB::table('tg_productssold')
        ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
        ->whereDate('tg_productssold.created_at','>=',$week_date->week_date)
        ->whereDate('tg_productssold.created_at','<=',$ndate)
        ->where('tg_productssold.user_id',$id)
        ->get()[0]->allprice;
        if($month_sol == NULL)
        {
            $month_sol = 0;
        }
        return $month_sol;
    }
}
if(!function_exists('getShogirdDay')){
    function getShogirdDay($user_id) {

        $days = [];

        $week_date = TeacherUser::where('user_id',$user_id)->first();

        if($week_date == null)
        {
            return $days;
        }

        $shifts = Shift::whereDate('open_date','<=',date('Y-m-d'))
        ->whereDate('open_date','>=',$week_date->week_date)
        ->where('user_id',$user_id)->orderBy('id','ASC')->limit(7)->get();

        foreach ($shifts as $key => $value) {
                # code...
            $dm = DB::table('day_medicines')->where('day',$key+1)->get();
            $day_plan = round(getShogirdPlan()/7);
            // $med = AllSold::whereIn('medicines_id',$dm->medicines)->get();
            $arr = json_decode($dm[0]->medicines);
            $sum = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                    ->whereDate('tg_productssold.created_at','>=',$value->created_at)
                    ->whereDate('tg_productssold.created_at','<=',$value->created_at)
                    ->where('tg_productssold.user_id',$user_id)
                    ->whereIn('tg_productssold.medicine_id',$arr)
                    ->get()[0]->allprice;
            if($sum == NULL)
            {
                $sum = 0;
            }

            $other_sum = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                    ->whereDate('tg_productssold.created_at','>=',$value->created_at)
                    ->whereDate('tg_productssold.created_at','<=',$value->created_at)
                    ->where('tg_productssold.user_id',$user_id)
                    ->whereNotIn('tg_productssold.medicine_id',$arr)
                    ->get()[0]->allprice;
            if($other_sum == NULL)
            {
                $other_sum = 0;
            }
            $all_med = Medicine::whereIn('id',$arr)->get();
            $days[$key+1] = array('dm' => $dm,'all_med' => $all_med, 'day' => $key+1 ,'plan' => $day_plan ,'make' => $sum, 'make_other' => $other_sum ,'open' =>$value->created_at);

        }
        return $days;
    }
}
if(!function_exists('getOneMonthUser')){
    function getOneMonthUser() {
        $user = NewUserOneMonth::where('user_id',Auth::id())->where('active',1)->get();

        return $user;
    }
}
if(!function_exists('getSavdo')){
    function getSavdo($id,$date) {
        $other_sum = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                    ->whereDate('tg_productssold.created_at','=',$date)
                    ->where('tg_productssold.user_id',$id)
                    ->get()[0]->allprice;
            if($other_sum == NULL)
            {
                $other_sum = 0;
            }
        return $other_sum;
    }
}
if(!function_exists('getSinovUser')){
    function getSinovUser($id) {

        $red_date = date('Y-m-d');
        $user = NewUserOneMonth::where('user_id',$id)->where('active',1)->count();
        $us = User::find($id);
        if($user == 1 && $us->status == 1)
        {

            $start1 = $us->work_start;
            $end1 = date('Y-m-d',(strtotime ( '+6 day' , strtotime ( $start1) ) ));

            $start2 = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $end1) ) ));
            $end2 = date('Y-m-d',(strtotime ( '+6 day' , strtotime ( $start2) ) ));

            $start3 = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $end2) ) ));
            $end3 = date('Y-m-d',(strtotime ( '+6 day' , strtotime ( $start3) ) ));

            $start3 = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $end2) ) ));
            $end3 = date('Y-m-d',(strtotime ( '+6 day' , strtotime ( $start3) ) ));

            $start4 = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $end3) ) ));
            $end4 = date('Y-m-d',(strtotime ( '+29 day' , strtotime ( $start1) ) ));

            $arrayDate = [];
            $arrayDate[] = array('start' => $start1,'ends' => $end1);
            $arrayDate[] = array('start' => $start2,'ends' => $end2);
            $arrayDate[] = array('start' => $start3,'ends' => $end3);
            $arrayDate[] = array('start' => $start4,'ends' => $end4);

            $montharr = [];
            $plan = 3000000;
            foreach ($arrayDate as $key => $value) {
                $summa1 = DB::table('tg_productssold')
                    ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice')
                    ->whereDate('tg_productssold.created_at','>=',$value['start'])
                    ->whereDate('tg_productssold.created_at','<=',$value['ends'])
                    ->where('tg_productssold.user_id','=',$id)
                    ->get()[0]->allprice;
                if($summa1 == null)
                {
                    $summa1 = 0;
                }

                if($red_date > $value['start'] && $value['ends'] > $red_date)
                {
                    $diff = (strtotime($red_date) - strtotime($value['start']))/3600/24;
                    if($diff == 2)
                    {
                        if(( ($plan*30)/100) >= $summa1)
                        {
                            $minus = 0;
                        }else{
                            $minus = 1;
                        }
                    }else{
                        $minus = 1;
                    }
                }else{
                    $minus = 1;
                }
                $montharr[] = array('make' => $summa1,'plan' => $plan,'start' => $value['start'],'end' =>$value['ends'],'red_day' => $minus);

            }

        }else{
            $montharr = 0;
        }
        return $montharr;
    }
}

if(!function_exists('myPrognoz')){
    function myPrognoz() {
        $start = Carbon::now()->startOfMonth()->format("Y-m-d");
        $end = Carbon::now()->endOfMonth()->format("d");
        $now = Carbon::now()->format("Y-m-d");
        $fakt = DB::select(
            "SELECT
            COALESCE(SUM(CASE WHEN DATE(p.created_at) BETWEEN ? AND ? THEN p.number * p.price_product ELSE 0 END), 0) AS allprice
            FROM tg_productssold AS p
            WHERE p.user_id = ?",
            [$start, $now, Auth::user()->id]
        );
        $koef = 0;
        if(count($fakt) > 0) {
            $koef = round($fakt[0]->allprice / (int)date("d"));
        }
        $prognoz = $koef * $end;
        return $prognoz;
    }
}
if(!function_exists('getRMPRO')){
    function getRMPRO() {
        $idr = Auth::id();


        if($idr == 107)
        {
            $pid = ['11','14'];
        }
        elseif($idr == 72)
        {
            $pid = ['3','6','13'];
        }
        elseif($idr == 61)
        {
            $pid = ['2'];
        }
        elseif($idr == 60)
        {
            $pid = ['5'];
        }
        elseif($idr == 93)
        {
            $pid = ['7','12'];
        }
        elseif($idr == 4)
        {
            $pid = ['1','8'];
        }
        elseif($idr == 73)
        {
            $pid = ['14'];
        }
        else{
            $pid = [];
        }

        $response = Http::post(apiProvizorUrl().'/api/get-provizor', [
            'regions' => $pid,
        ]);



        return $response['provizors'];
    }
}
if(!function_exists('getOrderUser')){
    function getOrderUser() {
        $idr = Auth::id();
        if($idr == 107)
        {
            $pid = ['11','14'];
        }
        elseif($idr == 72)
        {
            $pid = ['3','6','13'];
        }
        elseif($idr == 61)
        {
            $pid = ['2'];
        }
        elseif($idr == 60)
        {
            $pid = ['5'];
        }
        elseif($idr == 93)
        {
            $pid = ['7','12'];
        }
        elseif($idr == 4)
        {
            $pid = ['1','8'];
        }
        else{
            $pid = [];
        }

        $response = Http::post(apiProvizorUrl().'/api/order-user', [
            'regions' => $pid,
        ]);

        return $response['orders'];
    }
}
if(!function_exists('getProProd')){
    function getProProd() {
        // $products = Shift::with('pharmacy.shablon_pharmacy.shablon.price.medicine')
        // ->orderBy('id','DESC')
        // ->limit(1)
        // ->get();

        $response = Http::get(apiProvizorUrl().'/api/get-medicine')->collect();

        return $response;
    }
}
if(!function_exists('getProProdPrice')){
    function getProProdPrice($id) {
        $shablon_id = 3;
        $price = Price::where('shablon_id',3)->where('medicine_id',$id)->first();
        return $price->price??10;
    }
}
if(!function_exists('apiProvizorUrl')){
    function apiProvizorUrl() {
        $host = substr(request()->getHttpHost(),0,3);
        if($host == 127)
        {
            $url = 'http://127.0.0.1:8000';

        }else{
            $url = 'https://promo.novatio.uz';
        }
        return $url;
    }
}

if(!function_exists('apiProvizorUrl2')){
    function apiProvizorUrl2() {

        $host = substr(request()->getHttpHost(),0,3);

        return $host;
    }
}

// if(!function_exists('mijoz')){
//     function mijoz() {

//         $clients = Client::with('chat','chat.message')->where('user_id',Auth::id())->get();

//         return $clients;
//     }
// }
if(!function_exists('getcris')){
    function getcris($id) {

        try {
            return UserCrystall::where('user_id', $id)->first()->crystall;
        } catch (\Throwable $th) {
            return 0;
        }
    }
}

if(!function_exists('nickname')){
    function nickname() {

        $nick = [
            "Olivia",
            "Emma",
            "Amelia",
            "Sophia",
            "Evelyn",
            "Harper",
            "Luna",
            "Camila",
            "Gianna",
            "Eleanor",
            "Ella",
            "Abigail",
            "Sofia",
            "Avery",
            "Emily",
            "Aria",
            "Chloe",
            "Layla",
            "Mila",
            "Nora",
            "Hazel",
            "Madison",
            "Ellie",
            "Lily",
            "Nova",
            "Isla",
            "Grace",
            "Violet",
            "Aurora",
            "Riley",
            "Zoey",
            "Willow",
            "Emilia",
            "Stella",
            "Hannah",
            "Addison",
            "Leah",
            "Lucy",
            "Eliana",
            "Everly",
            "Lillian",
            "Paisley",
            "Elena",
            "Naomi",
            "Maya",
            "Natalie",
            "Kinsley",
            "Delilah",
            "Claire",
            "Audrey",
            "Aaliyah",
            "Ruby",
            "Alice",
            "Aubrey",
            "Autumn",
            "Leilani",
            "Kennedy",
            "Madelyn",
            "Bella",
            "Skylar",
            "Genesis",
            "Sophie",
            "Hailey",
            "Sadie",
            "Natalia",
            "Quinn",
            "Allison",
            "Anna",
            "Nevaeh",
            "Cora",
            "Ariana",
            "Emery",
            "Lydia",
            "Jade",
            "Sarah",
            "Adeline",
            "Piper",
            "Rylee",
            "Athena",
            "Peyton",
            "Vivian",
            "Clara",
            "Raelynn",
            "Liliana",
            "Maria",
            "Iris",
            "Ayla",
            "Eloise",
            "Lyla",
            "Eliza",
            "Hadley",
            "Melody",
            "Julia",
            "Parker",
            "Rose",
            "Brielle",
            "Adalynn",
            "Arya",
            "Eden",
            "Remi",
            "Maeve",
            "Reagan",
            "Charlie",
            "Alaia",
            "Melanie",
            "Josie",
            "Elliana",
            "Cecilia",
            "Mary",
            "Daisy",
            "Alina",
            "Lucia",
            "Ximena",
            "Juniper",
            "Kaylee",
            "Summer",
            "Adalyn",
            "Sloane",
            "Amara",
            "Arianna",
            "Isabel",
            "Reese",
            "Emersyn",
            "Sienna",
            "Kehlani",
            "River",
            "Freya",
            "Valerie",
            "Blakely",
            "Esther",
            "Valeria",
            "Kylie",
            "Norah",
            "Amaya",
            "Bailey",
            "Ember",
            "Ryleigh",
            "Georgia",
            "Emerson",
            "Faith",
            "Jasmine",
            "Ariella",
            "Ashley",
            "Andrea",
            "Millie",
            "June",
            "Khloe",
            "Callie",
            "Sage",
            "Olive",
            "Alani",
            "Brianna",
            "Rosalie",
            "Molly",
            "Brynlee",
            "Ruth",
            "Aubree",
            "Gemma",
            "Taylor",
            "Oakley",
            "Margot",
            "Sara",
            "Journee",
            "Harmony",
            "Blake",
            "Alaina",
            "Aspen",
            "Noelle",
            "Selena",
            "Oaklynn",
            "Morgan",
            "Londyn",
            "Zuri",
            "Aliyah",
            "Jordyn",
            "Juliana",
            "Finley",
            "Presley",
            "Zara",
            "Leila",
            "Marley",
            "Sawyer",
            "Amira",
            "Lilly",
            "London",
            "Elsie",
            "Ariel",
            "Lila",
            "Alana",
            "Diana",
            "Kamila",
            "Nyla",
            "Vera",
            "Hope",
            "Annie",
            "Kaia",
            "Myla",
            "Alyssa",
            "Angela",
            "Lennon",
            "Harlow",
            "Rachel",
            "Gracie",
            "Rowan",
            "Laila",
            "Elise",
            "Sutton",
            "Lilah",
            "Adelyn",
            "Phoebe",
            "Octavia",
            "Sydney",
            "Mariana",
            "Wren",
            "Lainey",
            "Vanessa",
            "Teagan",
            "Kayla",
            "Malia",
            "Elaina",
            "Saylor",
            "Brooke",
            "Lola",
            "Miriam",
            "Alayna",
            "Daniela",
            "Jane",
            "Payton",
            "Journey",
            "Lilith",
            "Delaney",
            "Dakota",
            "Charlee",
            "Alivia",
            "Kailani",
            "Lucille",
            "Trinity",
            "Tatum",
            "Raegan",
            "Camille",
            "Kaylani",
            "Kali",
            "Stevie",
            "Maggie",
            "Haven",
            "Tessa",
            "Daphne",
            "Adaline",
            "Hayden",
            "Joanna",
            "Jocelyn",
            "Lena",
            "Evie",
            "Juliet",
            "Fiona",
            "Leia",
            "Paige",
            "Milani",
            "Talia",
            "Rebecca",
            "Kendall",
            "Harley",
            "Phoenix",
            "Dahlia",
            "Logan",
            "Camilla",
            "Thea",
            "Jayla",
            "Blair",
            "Hallie",
            "Madilyn",
            "Mckenna",
            "Evelynn",
            "Ophelia",
            "Celeste",
            "Alayah",
            "Winter",
            "Collins",
            "Nina",
            "Briella",
            "Palmer",
            "Kiara",
            "Amari",
            "Adriana",
            "Lauren",
            "Cali",
            "Kalani",
            "Aniyah",
            "Nicole",
            "Alexis",
            "Mariah",
            "Wynter",
            "Amina",
            "Ariyah",
            "Adelynn",
            "Reign",
            "Alaya",
            "Dream",
            "Willa",
            "Avianna",
            "Makayla",
            "Elle",
            "Amiyah",
            "Arielle",
            "Elianna",
            "Giselle",
            "Brynn",
            "Ainsley",
            "Aitana",
            "Charli",
            "Demi",
            "Makenna",
            "Danna",
            "Melissa",
            "Samara",
            "Lana",
            "Mabel",
            "Everlee",
            "Fatima",
            "Esme",
            "Raelyn",
            "Nayeli",
            "Camryn",
            "Kira",
            "Selah",
            "Serena",
            "Royalty",
            "Rylie",
            "Celine",
            "Laura",
            "Brinley",
            "Frances",
            "Heidi",
            "Rory",
            "Sabrina",
            "Destiny",
            "Poppy",
            "Amora",
            "Nylah",
            "Luciana",
            "Maisie",
            "Miracle",
            "Liana",
            "Raven",
            "Shiloh",
            "Allie",
            "Daleyza",
            "Kate",
            "Lyric",
            "Alicia",
            "Lexi",
            "Addilyn",
            "Anaya",
            "Malani",
            "Paislee",
            "Elisa",
            "Azalea",
            "Jordan",
            "Regina",
            "Viviana",
            "Aylin",
            "Skye",
            "Legacy",
            "Maia",
            "Ariah",
            "Alessia",
            "Carmen",
            "Astrid",
            "Maren",
            "Helen",
            "Alexa",
            "Lorelei",
            "Paris",
            "Adelina",
            "Bianca",
            "Jazlyn",
            "Scarlet",
            "Bristol",
            "Navy",
            "Colette",
            "Jolene",
            "Marlee",
            "Sarai",
            "Hattie",
            "Nadia",
            "Rosie",
            "Kamryn",
            "Kenzie",
            "Alora",
            "Holly",
            "Matilda",
            "Sylvia",
            "Cameron",
            "Armani",
            "Emelia",
            "Keira",
            "Alison",
            "Amanda",
            "Cassidy",
            "Emory",
            "Haisley",
            "Jimena",
            "Jessica",
            "Elaine",
            "Dorothy",
            "Mira",
            "Oaklee",
            "Averie",
            "Lyra",
            "Angel",
            "Edith",
            "Raya",
            "Ryan",
            "Heaven",
            "Kyla",
            "Wrenley",
            "Meadow",
            "Carter",
            "Kora",
            "Saige",
            "Kinley",
            "Maci",
            "Salem",
            "Aisha",
            "Adley",
            "Sierra",
            "Alma",
            "Helena",
            "Bonnie",
            "Mylah",
            "Briar",
            "Aurelia",
            "Leona",
            "Macie",
            "April",
            "Aviana",
            "Lorelai",
            "Alondra",
            "Kennedi",
            "Monroe",
            "Emely",
            "Maliyah",
            "Ailani",
            "Renata",
            "Katie",
            "Zariah",
            "Imani",
            "Amber",
            "Analia",
            "Ariya",
            "Anya",
            "Emberly",
            "Emmy",
            "Mara",
            "Maryam",
            "Dior",
            "Amalia",
            "Mallory",
            "Opal",
            "Shelby",
            "Remy",
            "Xiomara",
            "Elliott",
            "Elora",
            "Skyler",
            "Hanna",
            "Kaliyah",
            "Alanna",
            "Haley",
            "Itzel",
            "Cecelia",
            "Jayleen",
            "Kensley",
            "Journi",
            "Dylan",
            "Ivory",
            "Yaretzi",
            "Sasha",
            "Gloria",
            "Oaklyn",
            "Sloan",
            "Abby",
            "Davina",
            "Lylah",
            "Erin",
            "Reyna",
            "Kaitlyn",
            "Jaliyah",
            "Jenna",
            "Sylvie",
            "Miranda",
            "Anne",
            "Mina",
            "Myra",
            "Aleena",
            "Alia",
            "Frankie",
            "Ellis",
            "Kathryn",
            "Nalani",
            "Nola",
            "Jemma",
            "Lennox",
            "Marie",
            "Ivanna",
            "Zelda",
            "Faye",
            "Karsyn",
            "Dayana",
            "Amirah",
            "Megan",
            "Siena",
            "Reina",
            "Rhea",
            "Julieta",
            "Henley",
            "Liberty",
            "Leslie",
            "Kelsey",
            "Charley",
            "Capri",
            "Zariyah",
            "Savanna",
            "Emerie",
            "Skyla",
            "Macy",
            "Mariam",
            "Melina",
            "Chelsea",
            "Dallas",
            "Laurel",
            "Briana",
            "Holland",
            "Lilian",
            "Amaia",
            "Blaire",
            "Margo",
            "Louise",
            "Rosalia",
            "Aleah",
            "Bethany",
            "Flora",
            "Kylee",
            "Kendra",
            "Sunny",
            "Laney",
            "Tiana",
            "Chaya",
            "Milan",
            "Aliana",
            "Estella",
            "Julie",
            "Yara",
            "Rosa",
            "Emmie",
            "Carly",
            "Janelle",
            "Kyra",
            "Naya",
            "Malaya",
            "Sevyn",
            "Lina",
            "Mikayla",
            "Jayda",
            "Leyla",
            "Eileen",
            "Irene",
            "Karina",
            "Aileen",
            "Aliza",
            "Kori",
            "Indie",
            "Lara",
            "Romina",
            "Jada",
            "Kimber",
            "Amani",
            "Louisa",
            "Winnie",
            "Kassidy",
            "Noah",
            "Monica",
            "Keilani",
            "Zahra",
            "Zaylee",
            "Jamie",
            "Allyson",
            "Anahi",
            "Maxine",
            "Karla",
            "Johanna",
            "Penny",
            "Hayley",
            "Marilyn",
            "Della",
            "Freyja",
            "Jazmin",
            "Kenna",
            "Ashlyn",
            "Ezra",
            "Melany",
            "Murphy",
            "Marina",
            "Noemi",
            "Selene",
            "Bridget",
            "Alaiya",
            "Angie",
            "Fallon",
            "Thalia",
            "Rayna",
            "Martha",
            "Halle",
            "Joelle",
            "Kinslee",
            "Roselyn",
            "Jolie",
            "Dani",
            "Elodie",
            "Halo",
            "Nala",
            "Promise",
            "Justice",
            "Nellie",
            "Novah",
            "Estelle",
            "Jenesis",
            "Miley",
            "Hadlee",
            "Janiyah",
            "Waverly",
            "Braelyn",
            "Pearl",
            "Aila",
            "Katelyn",
            "Sariyah",
            "Azariah",
            "Bexley",
            "Giana",
            "Cadence",
            "Mavis",
            "Rivka",
            "Jovie",
            "Yareli",
            "Bellamy",
            "Kamiyah",
            "Kara",
            "Baylee",
            "Jianna",
            "Alena",
            "Novalee",
            "Elliot",
            "Livia",
            "Ashlynn",
            "Denver",
            "Emmalyn",
            "Jazmine",
            "Kiana",
            "Mikaela",
            "Aliya",
            "Galilea",
            "Harlee",
            "Jaylah",
            "Lillie",
            "Mercy",
            "Ensley",
            "Bria",
            "Kallie",
            "Celia",
            "Berkley",
            "Ramona",
            "Jaylani",
            "Jessie",
            "Aubrie",
            "Madisyn",
            "Paulina",
            "Averi",
            "Chana",
            "Milana",
            "Cleo",
            "Iyla",
            "Cynthia",
            "Hana",
            "Lacey",
            "Andi",
            "Milena",
            "Leilany",
            "Saoirse",
            "Adele",
            "Drew",
            "Bailee",
            "Hunter",
            "Rayne",
            "Anais",
            "Kamari",
            "Paula",
            "Rosalee",
            "Teresa",
            "Zora",
            "Avah",
            "Belen",
            "Greta",
            "Layne",
            "Scout",
            "Zaniyah",
            "Amelie",
            "Dulce",
            "Chanel",
            "Clare",
            "Rebekah",
            "Ellison",
            "Isabela",
            "Rosalyn",
            "Royal",
            "Alianna",
            "August",
            "Nyra",
            "Vienna",
            "Amoura",
            "Anika",
            "Harmoni",
            "Kelly",
            "Linda",
            "Kairi",
            "Ryann",
            "Avayah",
            "Gwen",
            "Whitley",
            "Noor",
            "Khalani",
            "Addyson",
            "Annika",
            "Karter",
            "Vada",
            "Tiffany",
            "Artemis",
            "Clover",
            "Laylah",
            "Elyse",
            "Kaisley",
            "Veda",
            "Zendaya",
            "Simone",
            "Alexia",
            "Alisson",
            "Ocean",
            "Elia",
            "Maleah",
            "Avalynn",
            "Marisol",
            "Goldie",
            "Malayah",
            "Paloma",
            "Raina",
            "Valery",
            "Adalee",
            "Tinsley",
            "Violeta",
            "Baylor",
            "Lauryn",
            "Marlowe",
            "Birdie",
            "Jaycee",
            "Lexie",
            "Loretta",
            "Lilyana",
            "Shay",
            "Natasha",
            "Indigo",
            "Zaria",
            "Addisyn",
            "Deborah",
            "Leanna",
            "Barbara",
            "Kimora",
            "Emerald",
            "Raquel",
            "Julissa",
            "Robin",
            "Austyn",
            "Dalia",
            "Nyomi",
            "Ellen",
            "Kynlee",
            "Salma",
            "Luella",
            "Zayla",
            "Samira",
            "Amaris",
            "Madalyn",
            "Stormi",
            "Etta",
            "Ayleen",
            "Brylee",
            "Araceli",
            "Egypt",
            "Iliana",
            "Paityn",
            "Zainab",
            "Billie",
            "Haylee",
            "India",
            "Kaiya",
            "Nancy",
            "Taytum",
            "Rylan",
            "Ainhoa",
            "Aspyn",
            "Elina",
            "Elsa",
            "Kailey",
            "Arleth",
            "Joyce",
            "Judith",
            "Crystal",
            "Landry",
            "Paola",
            "Braylee",
            "Aarna",
            "Aiyana",
            "Kahlani",
            "Lyanna",
            "Sariah",
            "Aniya",
            "Frida",
            "Jaylene",
            "Kiera",
            "Loyalty",
            "Azaria",
            "Jaylee",
            "Kamilah",
            "Keyla",
            "Kyleigh",
            "Micah",
            "Nataly",
            "Zoya",
            "Meghan",
            "Soraya",
            "Zoie",
            "Arlette",
            "Zola",
            "Luisa",
            "Vida",
            "Ryder",
            "Tatiana",
            "Tori",
            "Aarya",
            "Sandra",
            "Soleil"
        ];
        return $nick;
    }
}
