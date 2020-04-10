<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyZodiacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_zodiac', function (Blueprint $table) {
            $table->increments('id');
            $table->string('zodiac');
            $table->integer('total_score');
            $table->string('total_comment');
            $table->integer('love_score');
            $table->string('love_comment');
            $table->integer('business_score');
            $table->string('business_comment');
            $table->integer('fortune_score');
            $table->string('fortune_comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_zodiac');
    }
}
