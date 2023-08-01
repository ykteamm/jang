<?php

namespace App\Http\Controllers;

use App\Models\ElchiBall;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Pharmacy;
use App\Models\PharmacyUser;
use App\Models\TeacherUser;
use App\Models\TeachGradeStar;
use App\Models\TestRegister;
use App\Models\TestReview;
use App\Models\UserCrystall;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
    public function getUserCrystall()
    {
        try {
            return UserCrystall::where('user_id', Auth::id())->first()->crystall;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public function shopping()
    {
        return view('user.shopping');
    }

    public function reyting()
    {
        $users = User::orderBy('cashback','DESC')->get();
        return view('reyting',compact('users'));
    }
    public function myOrder()
    {
        $user_id = Auth::user()->id;
        $orders = Order::with('orderProduct','orderProduct.product')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        return view('user.my-order',compact('orders'));
    }
    public function productShopping($id)
    {
        $order = new OrderProduct([
            'user_id' => Auth::user()->id,
            'product_id' => $id
        ]);
        return redirect()->back()->with('success_order','Buyurtmangiz adminga yetkazildi');
    }
    public function nameEtap(Request $request)
    {
        Session::put('first_name',$request->first_name);
        Session::put('last_name',$request->last_name);
        Session::put('name_etap',200);
        return [
            'status' => 200,
        ];
    }

    public function dateEtap(Request $request)
    {
        Session::put('year',$request->year);
        Session::put('month',$request->month);
        Session::put('day',$request->day);
        Session::put('date_etap',200);
        return [
            'status' => 200,
            'phone' => Session::get('code_etap'),
            'code' => Session::get('phone_etap'),
        ];
    }
    public function regionEtap(Request $request)
    {
        Session::put('region',$request->region);
        Session::put('district',$request->district);
        Session::put('region_etap',200);
        return [
            'status' => 200
        ];
    }
    public function passportEtap(Request $request)
    {
            $x=15;
            $file = $request->file('passport') ;
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $img->save('images/users/passport/'.$imageName,$x);

            Session::put('passport',$imageName);
            return [
                'status' => 200,
            ];
    }
    public function photoEtap(Request $request)
    {

            $x=15;
            $file = $request->file('image') ;
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $img->save('images/users/photo/'.$imageName,$x);

            Session::put('photo',$imageName);
            return [
                'status' => 200,
            ];
    }
    public function lavozimEtap(Request $request)
    {
        if(isset($request->admin))
        {
            Session::put('lavozim',$request->lavozim);
            Session::put('admin',$request->admin);
            Session::put('lavozim_etap',200);
            return [
                'status' => 200
            ];
        }else{
            Session::put('lavozim',$request->lavozim);
            Session::put('admin',0);
            Session::put('lavozim_etap',200);
            return [
                'status' => 200
            ];
        }
    }
    public function phoneEtap(Request $request)
    {

        $number = preg_replace("/[^0-9]/", '', $request->phone);
        Session::put('password',$request->password);

        $phone = User::where('phone_number',$number)->first();
        if($phone)
        {
            return [
                'status' => 505,
            ];
        }else{
            Session::put('phone',$number);
        }


            $elchi = [
                'first_name' => Session::get('first_name'),
                'last_name' => Session::get('last_name'),
                'year' => Session::get('year'),
                'month' => Session::get('month'),
                'day' => Session::get('day'),
                'region' => Session::get('region'),
                'district' => Session::get('district'),
                'lavozim' => Session::get('lavozim'),
                'admin' => Session::get('admin'),
                'passport' => Session::get('passport'),
                'photo' => Session::get('photo'),
                'phone' => Session::get('phone'),
            ];

            $new = new TestRegister([
                'elchi' => json_encode($elchi)
            ]);
            $new->save();
            // return $new;

            return [
                'status' => 200,
                'number' => Session::get('phone'),
            ];

    }
    public function phoneEtapCopy(Request $request)
    {

        $number = preg_replace("/[^0-9]/", '', $request->phone);
        Session::put('password',$request->password);

        $phone = User::where('phone_number',$number)->first();
        if($phone)
        {
            return [
                'status' => 505,
            ];
        }else{
            $x = 4; // Amount of digits
            $min = pow(10,$x);
            $max = pow(10,$x+1)-1;
            $value = rand($min, $max);

            // $response = Http::post('notify.eskiz.uz/api/auth/login', [
            //     'email' => 'mubashirov2002@gmail.com',
            //     'password' => 'PM4g0AWXQxRg0cQ2h4Rmn7Ysoi7IuzyMyJ76GuJa'
            // ]);
            // $token = $response['data']['token'];

            // $sms = Http::withToken($token)->post('notify.eskiz.uz/api/message/sms/send', [
            //     'mobile_phone' => '998'.$number,
            //     'message' => 'Tasdiqlash kodi - '.$value,
            //     'from' => '4546',
            //     'callback_url' => 'http://0000.uz/test.php'
            // ]);

            Session::put('phone',$number);
            Session::put('code',$value);
            Session::put('phone_etap',200);
            return [
                'status' => 200,
                'code' => $value,
            ];
        }
    }

    public function codeEtap(Request $request)
    {
        if(intval(Session::get('code')) == intval($request->code))
        {
            Session::put('code_etap',200);

            $elchi = [
                'first_name' => Session::get('first_name'),
                'last_name' => Session::get('last_name'),
                'year' => Session::get('year'),
                'month' => Session::get('month'),
                'day' => Session::get('day'),
                'region' => Session::get('region'),
                'district' => Session::get('district'),
                'lavozim' => Session::get('lavozim'),
                'admin' => Session::get('admin'),
                'passport' => Session::get('passport'),
                'photo' => Session::get('photo'),
                'phone' => Session::get('phone'),
            ];

            $new = new TestRegister([
                'elchi' => json_encode($elchi)
            ]);
            $new->save();
            // return $new;

            return [
                'status' => 200,
                'number' => Session::get('phone'),

            ];
        }else{
            return [
                'status' => 300
            ];
        }

    }
    public function testSold()
    {
        $summa = DB::table('tg_productssold')
            ->selectRaw('SUM(tg_productssold.number * tg_productssold.price_product) as allprice,tg_user.id,tg_user.first_name,tg_user.last_name')
            ->whereDate('tg_productssold.created_at','2023-01-28')
            ->join('tg_user','tg_user.id','tg_productssold.user_id')
            ->orderBy('allprice','DESC')
            ->groupBy('tg_user.id','tg_user.first_name','tg_user.last_name')->get();
        return $summa;
    }
    public function testKubok()
    {
        $kuboks = ElchiBall::with('user')->orderBy('ball','DESC')->get();

        return $kuboks;
    }
    public function testSoldp()
    {
        $kuboks = DB::table('tg_productssold')
        ->whereDate('created_at','>=','2022-12-01')
        ->whereDate('created_at','<=',date('Y-m-d'))
        ->get();

        return ($kuboks);
    }
    public function testOrder()
    {
        $kuboks = DB::table('tg_order')
        ->whereDate('created_at','>=','2022-12-01')
        ->whereDate('created_at','<=',date('Y-m-d'))
        ->get();

        return ($kuboks);
    }
    public function testUser()
    {
        $kuboks = DB::table('tg_user')->select('id','first_name','last_name')->get();

        return $kuboks;
    }
    public function testMedicine()
    {
        $kuboks = DB::table('tg_medicine')->select('id','name')->get();

        return $kuboks;
    }

    public function userModal(Request $request)
    {
        return $request;
    }

    public function firstSuccess(Request $request)
    {

        DB::table('tg_user')->where('id',Auth::id())->update([
            'first_enter' => 1
        ]);

        return [
            'code' => 200
        ];
    }
    public function firstViewSuccess(Request $request)
    {
        TeacherUser::where('teacher_id',Auth::id())->update([
            'first_view' => 1
        ]);
        // DB::table('tg_user')->where('id',Auth::id())->update([
        //     'first_enter' => 1
        // ]);

        return [
            'code' => 200
        ];
    }

    public function teachTestStore(Request $request)
    {
        $inputs  = $request->all();
        $id = Auth::id();
        $teacher_id = TeacherUser::where('user_id',$id)->first();
        unset($inputs['_token']);
           $new = new TeachGradeStar([
            'tester_id' => $id,
            'user_id' => $teacher_id->teacher_id,
            'star' => $inputs['star']
          ]);
          $new->save();
        return redirect()->back();
    }

    public function teachTestStoreTeach(Request $request)
    {
        $inputs  = $request->all();
        unset($inputs['_token']);
           $new = new TeachGradeStar([
            'tester_id' => Auth::id(),
            'user_id' => $inputs['user_id'],
            'star' => $inputs['star']
          ]);
          $new->save();
        return redirect()->back();
    }

    public function teachTestStore2(Request $request)
    {
        $inputs  = $request->all();
        unset($inputs['_token']);
        $id = Auth::id();
        $teacher_id = TeacherUser::where('user_id',$id)->first();
        foreach ($inputs as $key => $value) {
          $new = new TestReview([
            'tester_id' => $id,
            'user_id' => $teacher_id->teacher_id,
            'test_id' => $key
          ]);
          $new->save();
        }
        return redirect()->back();
    }

    public function teachTestStoreTeach2(Request $request)
    {
        $inputs  = $request->all();
        $user_id = $inputs['user_id'];
        // return $user_id;
        unset($inputs['_token']);
        unset($inputs['user_id']);
        foreach ($inputs as $key => $value) {
          $new = new TestReview([
            'tester_id' => Auth::id(),
            'user_id' => intval($user_id),
            'test_id' => $key
          ]);
          $new->save();
        }
        return redirect()->back();
    }

    public function addProvizor(Request $request)
    {

        if($request->apteka)
        {
            $lastPharm = Pharmacy::orderBy('id', "desc")->first();
            DB::table('tg_pharmacy')->insert([
                'name' => $request->apteka,
                'phone_number' => $lastPharm->phone_number,
                'location' => $lastPharm->location,
                'image' => $lastPharm->image,
                'image_id' => $lastPharm->image_id,
                'volume' => $lastPharm->volume,
                'sort' => $lastPharm->sort,
                'is_active' => $lastPharm->is_active,
                'created_at' => $lastPharm->created_at,
                'tg_id' => $lastPharm->tg_id,
                'day_count' => $lastPharm->day_count,
                'slug' => substr($lastPharm->slug, 0, 3).((int)substr($lastPharm->slug, 3) + 10),
                'region_id' => $request->provizor_region
            ]);
            $pharmacy_id = Pharmacy::orderBy('id', "desc")->first()->id;

            DB::table('tg_shablon_pharmacies')->insert([
                'shablon_id' => 3,
                'pharmacy_id' => $pharmacy_id
            ]);

        }else{
            $pharmacy_id = $request->pharmacy_id;
        }

        $phone_number = preg_replace("/[^0-9]/", '', $request->phone_number);

        $arr = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $phone_number,
            'region_id' => $request->provizor_region,
            'district_id' => $request->district_id,
            'pharmacy_id' => $pharmacy_id,
        );

        $response = Http::post(apiProvizorUrl().'/api/provizor-store', $arr);

        Session::put('provizor',$response['password']);


        return redirect()->back();

        // return $response['password'];

        // $last_user = User::orderBy('id', 'DESC')->first('username');
        // $username = 'nvt' . (intval(substr($last_user->username, 3)) + 1);
        // $number = preg_replace("/[^0-9]/", '', $request->phone);
        // $harf = ['a','b','c','d','e','f','h'];
        // $ph = $harf[rand(0, 6)];

        // $password = $ph.rand(1000, 9999);


        // Session::put('provizor',$password);

        // $new = DB::table('tg_user')->insertGetId([
        //     'password' => Hash::make($password),
        //     'last_login' => NULL,
        //     'is_superuser' => FALSE,
        //     'username' => $username,
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'phone_number' => '+998' . $number,
        //     'is_staff' => FALSE,
        //     'is_active' => TRUE,
        //     'is_verified' => TRUE,
        //     'date_joined' => Carbon::now(),
        //     'district_id' => $request->district_id,
        //     'region_id' => $request->provizor_region,
        //     'specialty_id' => 9,
        //     'email' => NULL,
        //     'tg_id' => 990821015,
        //     'birthday' => '1999-10-10',
        //     'admin' => FALSE,
        //     'write_time' => Carbon::now(),
        //     'work_start' => date('Y-m-d'),
        //     'salary' => 1500000,
        //     'pr' => $password,
        //     'tg_file_id' => NULL,
        //     'rol_id' => 27,
        //     'last_seen' => NULL,
        //     'teacher' => FALSE,
        //     'image_change' => TRUE,
        //     'pharmacy_id' => NULL,
        //     'image_url' => 'https://telegra.ph//file/04f99aa16eebd4af2a42c.jpg',
        //     'status' => 1,
        //     'level' => 0,
        //     'rm' => 0,
        //     'first_enter' => 1,
        //     'img_photo' => 'for-pro',
        //     'img_passport' => 'for-pro',
        // ]);

        // PharmacyUser::create([
        //     'user_id' => $new,
        //     'pharma_id' => $request->pharmacy_id,
        // ]);


    }

    public function provizor()
    {
        return view('auth.provizor');
    }

    public function rekrutCheck(Request $request,$id)
    {

       $rekrut = DB::table('rekruts')->where('id',$id)->update([
            'status' => $request->status,
            'comment' => $request->comment,
       ]);

       return redirect()->back();
    }

    public function mijozMessage(Request $request)
    {
        $path = $this->uploadImage($request);
        $this->create($request->all(), $path);

        return redirect()->back()->with('mjiz_message','saqlandi');
    }

    public function create($data, $path)
    {
        return Message::create([
            'chat_id' => $data['chat_id'],
            'client_id' => $data['client_id'],
            'user_id' => $data['tg_user_id'],
            'image' => $path,
            'wiriter_id' => $data['tg_user_id'],
            'message' => $data['message'] ?? NULL
          ]);
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path().'/mijoz/message';
            $path = $file->move($destinationPath,$fileName);
            return $fileName;
          }
          return NULL;
    }

}
