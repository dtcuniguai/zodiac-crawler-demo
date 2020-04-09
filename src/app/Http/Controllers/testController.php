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
        $content = $this->crawlerSrv->getUrlContent('http://astro.click108.com.tw/');
        $starUrls = $this->crawlerSrv->getStarUrlNodes($content);
        $starContent = $this->crawlerSrv->getUrlContent($this->crawlerSrv->getRedirectStarContent($starUrls[0]));
        dd($this->crawlerSrv->parseStarNode($starContent));

    }
}
