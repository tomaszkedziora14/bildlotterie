<?php

namespace App\Service;

use Symfony\Component\DomCrawler\Crawler;
use App\Service\FileInfo;

class CrawlerService
{
    protected $fileInfo;

    public function __construct(FileInfo $fileInfo)
    {
        $this->fileInfo = $fileInfo;
    }

    public function getCrawler($pageUrl)
    {
        $html = file_get_contents($pageUrl);
        return new Crawler($html);
    }

    public function getImagesList($pageUrl) 
    {
        $crawler = $this->getCrawler($pageUrl);
        $result = $crawler->filterXpath('//img')->extract(array('src'));
        $array = $this->getHttpsLinks($result);

        return array_values($array);
    }

    public function getHttpsLinks($imgList)
    {
        return preg_grep ('/^https/', $imgList);
    }
}
