<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllSold extends Model
{
    use HasFactory;
    protected $table = 'tg_productssold';
    
    public function medicine()
    {
        return $this->belongsTo(Medicine::class,'medicine_id','id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }
    public function pharma()
    {
        return $this->belongsTo(Pharmacy::class,'pharm_id','id');
    }
}
