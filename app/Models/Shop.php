<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function user_ids()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'user_id','id');
    }

    public function product_ids()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function product()
    {
        return $this->hasOne(Product::class,'product_id','id');
    }
}
