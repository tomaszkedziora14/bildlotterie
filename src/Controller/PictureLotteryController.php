<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CrawlerService;
use App\Service\FileUploader;
use App\Service\FileInfo;

class PictureLotteryController extends AbstractController
{
    /**
     * @Route("/picture/lottery", name="picture_lottery")
     */
    public function randomRemoteUploader(
        CrawlerService $crawlerService,
        FileUploader $fileUploder
    ): Response {

        $pageUrl = 'https://sklep.swiatkwiatow.pl/';

        $imagesArray = $crawlerService->getImagesList($pageUrl);
        $randKeys = array_rand($imagesArray, 3);

        foreach($randKeys as $key){
            $fileUploder->uploadImage($imagesArray[$key]);
        }
        return new Response($pageUrl);
    }
}
