<?php

namespace App\Http\Controllers;

use App\Services\Shop;

class ShopController extends Controller
{
    public function shop(int $productId) {
        $shop = new Shop($productId);
        if ($shop()) {
            return redirect()->back()->with('smena','Muvaffaqiyatli bajarildi');
        }
        return redirect()->back()->with('smena','Rasvo !!!!');
    }
}
