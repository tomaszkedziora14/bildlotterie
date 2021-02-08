<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CrawlerInterface;
use App\Service\FileUploader;

class PictureLotteryController extends AbstractController
{
    /**
     * @Route("/picture/lottery", name="picture_lottery")
     */
    public function randomRemoteUploader(
        CrawlerInterface $imageCrawler,
        FileUploader $fileUploder
    ): Response {

        $pageUrl = 'https://sklep.swiatkwiatow.pl/';

        $imagesArray = $imageCrawler->getImagesList($pageUrl);
        $randKeys = array_rand($imagesArray, 3);

        foreach($randKeys as $key){
            $fileUploder->upload($imagesArray[$key]);
        }
        return new Response($pageUrl);
    }
}
