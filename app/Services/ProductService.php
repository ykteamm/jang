<?php

namespace App\Services;

use App\Models\Medicine;

class ProductService
{
    static public function bonusProduct()
    {
        $products = Medicine::where('tg_prices.shablon_id',3)->select('tg_medicine.name','tg_prices.price')
        ->join('tg_prices','tg_prices.medicine_id','tg_medicine.id')
        ->get();
        return $products;
    }
}