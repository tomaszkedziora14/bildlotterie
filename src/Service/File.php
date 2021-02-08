<?php


namespace App\Service;

use App\Service\FileInterface;
use Symfony\Component\HttpFoundation\File\File as FileBase;

class File extends FileBase
{
    private function upload()
    {
        parent::move('../uploads/',);
    }
}
