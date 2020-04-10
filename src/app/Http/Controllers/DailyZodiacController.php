<?php

namespace App\Http\Controllers;

use App\Model\DailyZodiac;
use App\Service\ZodiacService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyZodiacController extends Controller
{
    private $zodiacSrv;

    public function __construct(ZodiacService $zodiacService)
    {
        $this->zodiacSrv = $zodiacService;
    }


    public function today()
    {
        $zodiacs = $this->zodiacSrv->getZodiacs();
        return view('zodiac', [
            "zodiac" => $zodiacs,
            "time" => Carbon::now()->toDateTime()
        ]);
    }

    public function yesterday()
    {
        $condition['time'] = Carbon::yesterday()->toDateTimeString();
        $zodiacs = $this->zodiacSrv->getZodiacs($condition);
        return view('zodiac', [
            "zodiac" => $zodiacs,
            "time" => Carbon::now()->toDateTime()
        ]);
    }

    public function month()
    {

    }
}
