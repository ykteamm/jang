<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeImageRequest;
use App\Http\Requests\ChangeProfilRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    public function changeImage(ChangeImageRequest $request)
    {
        // return $request;
        $file = $request->file('change_image') ;
        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path().'/images/users/photo' ;
        $file->move($destinationPath,$imageName);

        $url = 'https://jang.novatio.uz/images/users/photo/'.$imageName;
        $update = DB::table('tg_user')->where('id',Auth::id())->update([
            'image_url' => $url
        ]);

        return redirect()->back();
    }
    public function changeProfil(ChangeProfilRequest $request)
    {
        $phone = preg_replace("/[^0-9]/", '', $request->phone_number);
        $nickname = $request->nickname;
        $first_name = $request->first_name;
        $last_name = $request->last_name;

        $user = DB::table('tg_user')->where('id',Auth::id())->update([
            'nickname' => $nickname,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => '+998'.$phone
        ]);
        return redirect()->back();
    }
    
}
