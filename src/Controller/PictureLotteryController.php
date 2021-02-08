<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CrawlerInterface;
use App\Service\FileUploaderInterface;

class PictureLotteryController extends AbstractController
{
    /**
     * @Route("/picture/lottery", name="picture_lottery")
     */
    public function randomRemoteUploader(
        CrawlerInterface $imageCrawler,
        FileUploaderInterface $fileUploder
    ): Response {

        $url = 'https://sklep.swiatkwiatow.pl/';

        $imagesList = $imageCrawler->getImagesList($url);
        $randKeys = array_rand($imagesList, 3);

        foreach($randKeys as $key){
            $fileUploder->upload($imagesList[$key]);
        }
        return new Response($url);
    }
}
