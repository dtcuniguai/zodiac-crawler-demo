<?php

namespace App\Service;


use App\Repository\DailyZodiacRepository;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerService
{
    private $zodiacRpy;

    public function __construct(DailyZodiacRepository $dailyZodiacRepository)
    {
        $this->zodiacRpy = $dailyZodiacRepository;
    }

    public function getUrlContent($url): string
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);
        error_log($url);

        if ($response->getStatusCode() != 200) {
            throw new \Exception("Cant not get correct Info from web");
        }

        $homePageBody = $response->getBody()->getContents();
        return $homePageBody;
    }

    public function getRedirectStarContent($url): string
    {
        $crawler = new Crawler();
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() != 200) {
            throw new \Exception("Cant not get correct Info from web");
        }

        $homePageBody = $response->getBody()->getContents();
        $crawler->addHtmlContent($homePageBody);
        $target = $crawler->filter('script')->html();

        $preg = '/http:\/\/([a-z]|[0-9]|[A-Z]|.)*/';
        preg_match($preg, $target, $url);
        return $url[0];
    }

    public function getStarUrlNodes($content): array
    {
        $crawler = new Crawler();
        $stars = array();
        $crawler->addHtmlContent($content);
        $target = $crawler->filterXPath('//div[contains(@class, "STAR12_BOX")]')->filter('li');
        $target->each(function ($node) use (&$stars) {
            $starUrls = $node->filter('a')->attr('href');
            array_push($stars, $starUrls);
        });
        return $stars;
    }

    public function parseStarNode($content)
    {
        $crawler = new Crawler();
        $crawler->addHtmlContent($content);
//      parse TODAY_FORTUNE
        //$target = $crawler->filterXPath('//div[contains(@class, "STARBABY")]')->html();
//      parse FORTUNE_CONTENT
        $zodiac = $this->parseCommentBlock($crawler->filterXPath('//div[contains(@class, "FORTUNE_BG")]'));
        return $zodiac;
    }

    public function newDailyZodiac($form)
    {
        return $this->zodiacRpy->newDailyZodiac($form);
    }

    //more info expansion in future
    private function parseZodiacBlock($crawler)
    {

    }

    private function parseCommentBlock(Crawler $crawler)
    {
        $parsers = array();
        $form = array();
        $content = $crawler->filterXPath('//div[contains(@class, "TODAY_CONTENT")]');
//        parse zodiac
        $form['zodiac'] = preg_replace('/(今日|解析)/', '',$content->filter('h3')->html());
//        parse comment
        $content->filter('p')->each(function ($node) use (&$parsers) {
            $f = $node->filter('span');
            if ($f->getNode(0)) {
                $parser = preg_split('/★/', $f->html());
                array_push($parsers, $parser[0]);
                array_push($parsers, count($parser) - 1);
            } else {
                array_push($parsers, $node->html());
            }
        });

        for ($i = 0; $i < count($parsers); $i += 3) {
            switch ($parsers[$i]) {
                case "整體運勢":
                    $title = 'total';
                    break;
                case "愛情運勢":
                    $title = 'love';
                    break;
                case "事業運勢":
                    $title = 'business';
                    break;
                case "財運運勢":
                    $title = 'fortune';
                    break;
                default:
                    $title = null;
                    break;
            }

            if($title) {
                $form[$title.'_score'] = $parsers[$i+1];
                $form[$title.'_comment'] = $parsers[$i+2];
            }
        }
        return $form;
    }


}