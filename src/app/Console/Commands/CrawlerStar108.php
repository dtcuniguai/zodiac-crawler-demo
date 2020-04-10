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
    protected $signature = 'crawler:zodiac';

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
        $starUrls = $this->crawlerSrv->getStarUrlNodes($content);
        foreach ($starUrls as $url) {
            $starContent = $this->crawlerSrv->getUrlContent($this->crawlerSrv->getRedirectStarContent($url));
            $zodiac = $this->crawlerSrv->parseStarNode($starContent);
            $this->crawlerSrv->newDailyZodiac($zodiac);
        }
    }
}
