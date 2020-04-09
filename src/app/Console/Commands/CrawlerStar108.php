<?php

namespace App\Console\Commands;

use App\Service\CrawlerService;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;
use GuzzleHttp\Client;

class CrawlerStar108 extends Command
{

    private $crawlerSrv;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:hi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CrawlerService $crawlerService)
    {
        parent::__construct();
        $this->crawlerSrv = $crawlerService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $content = $this->crawlerSrv->getUrlContent('http://astro.click108.com.tw/');
        $doms = $this->crawlerSrv->getStarUrlNodes($content);
        dd($doms);
//        $crawler = new Crawler($homePageBody);

//        dd($crawler->filterXPath('//div[contains(@class, "STAR12_BOX")]'));
//        foreach ($crawler as $domElement) {
//            echo $domElement->nodeName;
//        }
    }
}
