<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'elixir',
        'img',
        'name',
    ];

    public function shops()
    {
        return $this->hasMany(Shop::class,'product_id','id');
    }
}
