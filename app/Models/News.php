<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'img', 'desc', 'publish'];

    public function emojies()
    {
        return $this->hasMany(NewsReaction::class, 'news_id', 'id');
    }
    public function shows()
    {
        return $this->hasMany(NewsLike::class, 'news_id','id');
    }
}
