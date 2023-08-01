<?php

namespace App\Http\Controllers;

use App\Models\OuterMarket;
use Illuminate\Http\Request;

class OuterMarketController extends Controller
{
    public function index()
    {
        return view('admin.shop-product.index');
    }

    public function store(Request $request)
    {
        $file = $request->file('image') ;
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path().'/outermarket' ;

            $inputs = $request->all();
            $inputs['image'] = $imageName;
            unset($inputs['_token']);
            // dd($inputs);
            $products = new OuterMarket($inputs);
            $products->save();
            if($products->id)
            {
                $file->move($destinationPath,$imageName);
                return redirect()->back();
            }
            else{
                return redirect()->back();
            }
    }

    public function outerMarketAllApi()
    {
        $all = OuterMarket::orderBy('crystall', 'DESC')->get();
        return response()->json($all);
    }
}
