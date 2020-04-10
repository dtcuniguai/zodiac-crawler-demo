<?php

namespace App\Http\Controllers;

use App\Service\CrawlerService;
use Illuminate\Http\Request;

class testController extends Controller
{
    private $crawlerSrv;

    public function __construct(CrawlerService $crawlerService)
    {
        $this->crawlerSrv = $crawlerService;
    }

    public function test()
    {


        dd('successful');


    }
}
