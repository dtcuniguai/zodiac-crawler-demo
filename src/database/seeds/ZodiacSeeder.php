<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ZodiacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('daily_zodiac')->insert([
            'zodiac' => '水瓶座',
            'total_score' => 5,
            'total_comment' => '今天更易體會到等待難熬的滋味，已婚者空守居室會覺得生活太平淡，有尋求刺激的強烈想法；得天獨厚的好財運，與合作者的默契可望達到最高點，求財輕鬆；工作辛苦反而覺得充實，很有幹勁。',
            'love_score' => 5,
            'love_comment' => '愛情運挺不錯的，有許多喜悅的事情發生。如果沒有特殊狀況，就自個兒主動創造吧！',
            'business_score' => 3,
            'business_comment' => '事業運佳，適合在今日做點文書、計算型的工作；有機會呢可以翻翻書來增加靈感。',
            'fortune_score' => 2,
            'fortune_comment' => '今日的財運與事業息息相關，事業上有增資擴充的慾念，順利的財運對於增資有正面幫助。',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);
    }
}
