<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $table = 'tg_pharmacy';
    protected $fillable = [
        'id',
        'name',
        'phone_number',
        'location',
        'image',
    ];

    public function pharmacy_user()
    {
        return $this->hasmany(PharmacyUser::class,'pharma_id','id');
    }
    public function shift()
    {
        return $this->hasMany(Shift::class,'pharma_id','id');
    }
    public function shablon_pharmacy()
    {
        return $this->hasMany(ShablonPharmacy::class,'pharmacy_id','id');
    }
    public function sold()
    {
        return $this->hasMany(AllSold::class,'pharmacy_id','id');
    }
}
