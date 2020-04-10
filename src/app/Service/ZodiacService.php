<?php

namespace App\Service;


use App\Repository\DailyZodiacRepository;
use Carbon\Carbon;

class ZodiacService
{
    private $zodiacRpy;

    public function __construct(DailyZodiacRepository $dailyZodiacRepository)
    {
        $this->zodiacRpy = $dailyZodiacRepository;
    }

    public function getZodiacs($condition=null)
    {
        $ids = $this->zodiacRpy->getEachZodiacID($condition)->pluck('id');
        $zodiacs = $this->zodiacRpy->getZodiacByIDs($ids)->get();
        return $zodiacs;
    }


}