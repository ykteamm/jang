<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiProvizorController extends Controller
{
    public function getRegionDistrict()
    {
        $region = Region::with('district')->orderBy('id','ASC')->get();

        return response()->json($region);
    }

    public function proProductSave(Request $request,$user_id,$order_id)
    {

        $product = $request->all();
        unset($product['_token']);
        $arr = array(
            'user_id' => $user_id,
            'order_id' => $order_id,
            'product' => $product['product'],
        );

        $response = Http::post(apiProvizorUrl().'/api/product-save', $arr);

        $arr = [
            'sts' => $response['status'],
            'msg' => $response['msg'],
        ];

        return redirect()->back()->with('rsp',$arr);

    }
}
