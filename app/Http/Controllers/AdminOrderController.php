<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('order','order.orderProduct','order.orderProduct.product')->get();
        return view('admin.order.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delivery(Request $request, $id)
    {
        $update = Order::where('id',$id)->update([
            'delivery' => 1
        ]);

        return redirect()->back();
    }

    public function cashback(Request $request, $id)
    {
        $orders = Order::with('orderProduct','orderProduct.product','user')->where('id',$id)->first();
        $user_id = Order::where('id',$id)->value('user_id');

        $bonus = 0;
        foreach ($orders->orderProduct as $key => $value) {
            $bonus += $value->product->bonus*$value->stock;
        }


        $user_account = User::where('id',$user_id)->value('account');
        $user_cashback = User::where('id',$user_id)->value('cashback');

        // return $user_account + $bonus/2000;

        $users = User::where('id',$user_id)->update([
            'account' => $user_account + $bonus/2,
            'cashback' => $user_cashback + $bonus/2000,
        ]);
        $update = Order::where('id',$id)->update([
            'cashback' => 1
        ]);
        return redirect()->back();
    }


}
