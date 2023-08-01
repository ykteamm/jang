<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;

trait SMSTrait {

    public function sms($phone_number,$message) {

        $token = $this->getToken();
        // $sms = Http::withToken($token)->post('notify.eskiz.uz/api/message/sms/send', [
        //     'mobile_phone' => '998'.$phone_number,
        //     'message' => $message,
        //     'from' => '4546',
        //     'callback_url' => 'http://0000.uz/test.php'
        // ]);
    }
    public function getToken()
    {
        $response = Http::post('notify.eskiz.uz/api/auth/login', [
            'email' => 'mubashirov2002@gmail.com',
            'password' => 'PM4g0AWXQxRg0cQ2h4Rmn7Ysoi7IuzyMyJ76GuJa'
        ]);
        $token = $response['data']['token'];
        return $token;
    }
}
