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

    public function getImagesList($pageUrl) 
    {
        $html = file_get_contents($pageUrl);
        $crawler = new Crawler($html);
        $result = $crawler->filterXpath('//img')->extract(array('src'));
        $array = $this->getHttpsLinks($result);

        return array_values($array);
    }

    public function getImagesListWithoutUrl($pageUrl)
    {
        $html = file_get_contents($pageUrl);
        $crawler = new Crawler($html);
        $result = $crawler->filterXpath('//img')->extract(array('src'));
        $array = $this->getHttpsLinks($result);
        $listWitchUrl = array_values($array);

        $list = [];
        foreach($listWitchUrl as $value){
           $list[] = $this->fileInfo->getOnlyFileNameFromLink($value);
        }

        return $list;
    }

    public function getHttpsLinks($imgList)
    {
        return preg_grep ('/^https/', $imgList);
    }
}
