<?php

namespace App\Http\Controllers;

use App\Models\KingSoldBattle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class KingSoldBattleController extends Controller
{
    public function ksBattle(Request $request)
    {

        $start_date = date('Y-m-d');
        $end_date = getThursday();
        $inputs = $request->all();
        $new_battle = new KingSoldBattle([
            'offer_uid' => Auth::id(),
            'accept_uid' => $inputs['user_id'],
            'offer_comment' => $inputs['comment'],
            'start_date' => $start_date,
            'end_date' => $end_date,
            'start' => 0,
        ]);
        $new_battle->save();

        $weekStartDate = date('Y-m-d',(strtotime ( '-6 day' , strtotime ( getThursday() ) ) ));
        $weekEndDate = getThursday();
        $king_sold = DB::table('tg_king_sold')
            ->selectRaw('tg_order.user_id,tg_user.phone_number')
            ->where('tg_king_sold.admin_check', 1)
            ->whereDate('tg_king_sold.created_at', '>=', $weekStartDate)
            ->whereDate('tg_king_sold.created_at', '<=', $weekEndDate)
            ->join('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
            ->join('tg_user', 'tg_user.id', 'tg_order.user_id')
            ->groupBy('tg_order.user_id', 'tg_user.phone_number')
            ->pluck('phone_number')->toArray();

        $king_sold[] = '+998990821015';

        $king_sold[] = '+998977332305';
        $king_sold[] = '+998931810408';
        $king_sold[] = '+998930000047';
        $king_sold[] = '+998935050498';
        $king_sold[] = '+998946890010';
        $king_sold[] = '+998990316244';
        $king_sold[] = '+998995511944';

        // $offer_full = getUser(Auth::id())->last_name.' '.substr(getUser(Auth::id())->first_name,0,1);

        // $accept_last = User::find($inputs['user_id'])->last_name.' '.substr(User::find($inputs['user_id'])->first_name,0,1);
        // $response = Http::post('notify.eskiz.uz/api/auth/login', [
        //     'email' => 'mubashirov2002@gmail.com',
        //     'password' => 'PM4g0AWXQxRg0cQ2h4Rmn7Ysoi7IuzyMyJ76GuJa'
        // ]);
        // $token = $response['data']['token'];

        // foreach ($king_sold as $key => $value) {
        //     $sms = Http::withToken($token)->post('notify.eskiz.uz/api/message/sms/send', [
        //         'mobile_phone' => substr($value, 1),
        //         'message' => $offer_full. ' hozir ' . $accept_last. ' ni shoh yurish dueliga taklif qildi !!!',
        //         'from' => '4546',
        //         'callback_url' => 'http://0000.uz/test.php'
        //     ]);
        // }

        return redirect()->back();
    }
    public function ksBattleAnswer(Request $request)
    {
        $inputs = $request->all();
        if($inputs['accept'] == 1)
        {
            $new_battle = KingSoldBattle::where('id',$inputs['ksb_id'])->update([
                'accept_comment' => $inputs['comment'],
                'start' => 1,
            ]);
        }else{
            $accept_full = getUser(Auth::id())->last_name.' '.substr(getUser(Auth::id())->first_name,0,1);

            $offer_full = User::find(KingSoldBattle::find($inputs['ksb_id'])->offer_uid)->last_name.' '.substr(User::find(KingSoldBattle::find($inputs['ksb_id'])->offer_uid)->first_name,0,1);

            $new_battle = KingSoldBattle::where('id',$inputs['ksb_id'])->delete();
        }

        $weekStartDate = date('Y-m-d',(strtotime ( '-6 day' , strtotime ( getThursday() ) ) ));
        $weekEndDate = getThursday();
        $king_sold = DB::table('tg_king_sold')
            ->selectRaw('tg_order.user_id,tg_user.phone_number')
            ->where('tg_king_sold.admin_check', 1)
            ->whereDate('tg_king_sold.created_at', '>=', $weekStartDate)
            ->whereDate('tg_king_sold.created_at', '<=', $weekEndDate)
            ->join('tg_order', 'tg_order.id', 'tg_king_sold.order_id')
            ->join('tg_user', 'tg_user.id', 'tg_order.user_id')
            ->groupBy('tg_order.user_id', 'tg_user.phone_number')
            ->pluck('phone_number')->toArray();

        $king_sold[] = '+998990821015';

        $king_sold[] = '+998977332305';
        $king_sold[] = '+998931810408';
        $king_sold[] = '+998930000047';
        $king_sold[] = '+998935050498';
        $king_sold[] = '+998946890010';
        $king_sold[] = '+998990316244';
        $king_sold[] = '+998995511944';

        // $accept_full = getUser(Auth::id())->last_name.' '.substr(getUser(Auth::id())->first_name,0,1);
        // $offer_full = User::find(KingSoldBattle::find($inputs['ksb_id'])->offer_uid)->last_name.' '.substr(User::find(KingSoldBattle::find($inputs['ksb_id'])->offer_uid)->first_name,0,1);


        // $response = Http::post('notify.eskiz.uz/api/auth/login', [
        //     'email' => 'mubashirov2002@gmail.com',
        //     'password' => 'PM4g0AWXQxRg0cQ2h4Rmn7Ysoi7IuzyMyJ76GuJa'
        // ]);
        // $token = $response['data']['token'];




        // if($inputs['accept'] == 1)
        // {
        //     $message = 'Duel boshlandi '.$accept_full. ' hozir ' . $offer_full. ' ni shoh yurish dueliga qilgan taklifini qabul qildi !!!';
        // }else{
        //     $message = $offer_full. ' hozir ' . $accept_full. ' ni shoh yurish dueliga qilgan taklifini qabul qilmadi !!!';
        // }


        // foreach ($king_sold as $key => $value) {
        //     $sms = Http::withToken($token)->post('notify.eskiz.uz/api/message/sms/send', [
        //         'mobile_phone' => substr($value, 1),
        //         'message' => $message,
        //         'from' => '4546',
        //         'callback_url' => 'http://0000.uz/test.php'
        //     ]);
        // }
        return redirect()->back();
    }

}
