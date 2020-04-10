<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DailyZodiac extends Model
{
    protected $table = 'daily_zodiac';
    protected $fillable = ['zodiac', 'total_score', 'total_comment', 'love_score', 'love_comment', 'business_score', 'business_comment', 'fortune_score', 'fortune_comment'];
    protected $hidden = ['id'];
}
