<?php

namespace App\Http\Controllers;

use App\Http\Requests\KingSoldRequest;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Shift;
use App\Models\ElchiLevel;
use App\Models\ElchiBall;
use App\Models\ElchiElexir;
use App\Models\AllSold;
use App\Models\KingSold;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Traits\SMSTrait;
use App\Models\Premya;
use App\Models\PremyaTask;
use App\Services\SoldService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class SoldController extends Controller
{
    use SMSTrait;
    public function index()
    {

    }
    public function store(Request $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $firewall = 0;
        foreach ($inputs as $key => $value) {
            if($value !=0 )
            {
                $str = $key;
                $arr = explode("-",$str);
                $firewall += $value*$arr[1];
            }
        }
         
        // if($firewall >= 500000)
        // {
        //     $services = new SoldService;
        //     $fire = $services->firewallSold($inputs);
        //     return redirect()->back()->with('checksold',null);
        // }

        $pharm_id = Shift::where('user_id',Auth::user()->id)
        ->whereDate('open_date',Carbon::now())
        ->where('active',1)
        ->value('pharma_id');

        if(isset($inputs['phone_number']))
        {
            $phone = preg_replace("/[^0-9]/", '', $inputs['phone_number']);
        }else{
            $phone = null;
        }

        if(isset($inputs['full_name']))
        {
            $fio = $inputs['full_name'];
        }else{
            $fio = null;
        }
        // $fio = $inputs['full_name'];
        unset($inputs['_token']);
        unset($inputs['phone_number']);
        unset($inputs['full_name']);

        $pharm_id = Shift::where('user_id',Auth::user()->id)
        ->whereDate('open_date',Carbon::now())
        ->where('active',1)
        ->value('pharma_id');
        $order_id = DB::table('tg_order')->insertGetId([
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => Auth::user()->id,
            'pharm_id' => $pharm_id,
            // 'full_name' => $fio,
            // 'phone_number' => '+998'.$phone,
        ]);

        foreach ($inputs as $key => $value) {
            if($value !=0 )
            {
                $str = $key;
                $arr = explode("-",$str);
                $sold = DB::table('tg_productssold')->insertGetId([
                    'number' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'medicine_id' => $arr[0],
                    'user_id' => Auth::user()->id,
                    'order_id' => $order_id,
                    'price_product' => $arr[1],
                    'is_active' => TRUE,
                    'pharm_id' => $pharm_id,
                ]);
            }
        }

        // if($phone != NULL)
        // {
        //     if(myHost() == 127)
        //     {
        //         $message = 'Hurmatli mijoz bu sizning shaxsiy profilingiz. http://127.0.0.1:8000/'.$phone;
        //         $this->sms($phone,$message);
        //     }elseif(myHost() == 192)
        //     {
        //         $message = 'Hurmatli mijoz bu sizning shaxsiy profilingiz. http://192.168.0.175:8000/'.'+998'.$phone;
        //         $this->sms($phone,$message);
        //     }
        //     else{
        //         $message = 'Hurmatli mijoz bu sizning shaxsiy profilingiz. https://mijoz.novatio.uz/'.$phone;
        //         $this->sms($phone,$message);
        //     }

        // }

        $prodaja = DB::table('tg_productssold as p')
            ->selectRaw('COALESCE(SUM(p.number * p.price_product),0) as prodaja')
            ->where('p.user_id', Auth::id())
            ->whereDate('p.created_at', date("Y-m-d"))
            ->value('prodaja');

        $exists = PremyaTask::where('user_id',Auth::id())->whereDate('created_at','=',date('Y-m-d'))->first();
        if($exists)
        {
            $premya = Premya::find($exists->premya_id);

        }else{
            $ids = PremyaTask::where('user_id',Auth::id())->pluck('premya_id')->toArray();
            $premya = Premya::whereNotIn('id',$ids)->orderBy('id','ASC')->first();
        }


        if($premya)
        {
            $first = PremyaTask::where('user_id',Auth::id())
            ->whereDate('created_at', date('Y-m-d'))
            ->first();

            // return $premya;  

            if($first)
            {
                $first->prodaja = $prodaja;
                $first->save();
            }else{
                if($premya->task <= $prodaja)
                {
                    PremyaTask::create([
                        'user_id' => Auth::id(),
                        'premya_id' => $premya->id,
                        'prodaja' => $prodaja
                    ]);
                }

            }
        }


        $all_sold = AllSold::with('medicine')->where('user_id',Auth::user()->id)->where('order_id',$order_id)->get();
        return redirect()->back()->with('checksold',$all_sold);
    }
    public function zakazPro(Request $request)
    {
        $inputs = $request->all();

        unset($inputs['_token']);

        if(!isset($inputs['provizor_id']))
        {
            return redirect()->back();
        }
        $provizor_id = $inputs['provizor_id'];
        unset($inputs['provizor_id']);

        $ddd = [];

        $order_price = 0;
        $promo_price = 0;

        $proId = [36,37,38,39,29];


        foreach ($inputs as $key => $value) {
            if($value !=0 )
            {
                $str = $key;
                $arr = explode("-",$str);
                if(in_array($arr[0],$proId))
                {
                    $promo_price += $arr[1]*$value;
                }
                $order_price += $arr[1]*$value;

                $ddd[] = array('medicine_id' => $arr[0],'price_product' => $arr[1],'number' => $value);
            }
        }

        $arr = array('order' => $ddd,'provizor_id' => $provizor_id,'order_price' => $order_price,'promo_price' => $promo_price);

        $response = Http::post(apiProvizorUrl().'/api/order-store', $arr);

        if($response['status'] == 200)
        {
            $msg = 'Buyurtmangiz saqlandi';
        }else{
            $msg = 'Xatolik.Buyurtmangiz saqlanmadi!';
        }

        return redirect()->back()->with('msg_pro',$msg);

    }
    public function kingSold(KingSoldRequest $request,$id)
    {
        $exist = KingSold::where('order_id',$id)->get();
        if(count($exist) > 0)
        {
            $image_path = public_path("images/users/king_sold/".$exist[0]->image);

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $x=15;
            $file = $request->file('image') ;
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $img->save('images/users/king_sold/'.$imageName,$x);

            $king_sold = KingSold::where('id',$exist[0]->id)->update([
                'image' => $imageName,
                'admin_check' => 0,
            ]);

            return redirect()->back()->with('kingSold',$exist[0]->id);

        }else{

            $x=15;
            $file = $request->file('image') ;
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $img=\Image::make($file);
            $img->save('images/users/king_sold/'.$imageName,$x);

            $king_sold = new KingSold([
                'order_id' => $id,
                'image' => $imageName,
            ]);
            $king_sold->save();
            if($king_sold->id)
            {
                return redirect()->back()->with('kingSold',$id);
            }
        }


    }

    public function viewCheck($user_id = null,$date_begin = null,$date_end = null)
    {
        $new_solds = KingSold::with(['order' => function ($query) use($user_id){
            $query->where('user_id',$user_id);
        },'order.sold','order.sold.medicine','order.user'])
        ->whereDate('created_at','>=',$date_begin)
        ->whereDate('created_at','<=',$date_end)
        ->where('image','!=','add')
        ->where('admin_check',1)
        ->orderBy('id','DESC')->get();
        $solds=[];
        foreach($new_solds as $key => $value)
        {
            if($value->order != NULL)
            {
                $solds[] = $value;
            }
        }
        // return $date_end;
        return redirect()->back()->with('kingCheck',$solds);
    }
}
