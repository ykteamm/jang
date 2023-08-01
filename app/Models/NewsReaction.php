<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsReaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'news_id',
        'emoji_id'
    ];

    public function emoji()
    {
        return $this->hasOne(NewsEmoji::class, 'id', 'emoji_id');
    }
}
