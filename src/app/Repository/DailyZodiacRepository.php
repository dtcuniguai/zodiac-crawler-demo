<?php

namespace App\Repository;


use App\Model\DailyZodiac;

class DailyZodiacRepository
{
    private $zodiac;

    public function __construct(DailyZodiac $dailyZodiac)
    {
        $this->zodiac = $dailyZodiac;
    }

    public function newDailyZodiac($form)
    {
        return $this->zodiac->create($form);
    }
}