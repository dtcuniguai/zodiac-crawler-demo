<?php

namespace App\Service;


use Symfony\Component\DomCrawler\Crawler;

class CrawlerService
{

    public function getUrlContent($url) : string
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

    public function getRedirectStarContent($url) : string
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
        preg_match($preg, $target, $tmp);
        return $tmp[0];
    }

    public function getStarUrlNodes($content) : array
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
        $stars = array();
        $crawler->addHtmlContent($content);
        //parse TODAY_FORTUNE
        $target = $crawler->filterXPath('//div[contains(@class, "STARBABY")]')->html();
        //parse FORTUNE_CONTENT
        dd($target);
    }

    private function parseZodiacBlock()
    {

    }

    private function parseCommentBlock()
    {

    }


}