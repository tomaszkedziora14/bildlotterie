<?php

namespace App\Service;

use Symfony\Component\Finder\Finder;
use App\Service\FileInfoInterface;

class FileInfo implements FileInfoInterface
{
    public function getRootDir()
    {
       return '../uploads/';
    }

    public function getRootDirWitchFile($file)
    {
        return '../uploads/'.$file;
    }

    public function getDirToLogFolder()
    {
      return '../var/log/';
    }

    public function getImagesFromDir()
    {
       $finder = new Finder;
       $dir = $this->getRootDirToOnlyFolder();
       $finder->files()->in($dir);
       if ($finder->hasResults()) {
       }

       $tab = [];
       foreach ($finder as $file) {
          $absoluteFilePath = $file->getRealPath();
          $fileNameWithExtension = $file->getRelativePathname();
          $tab[] =$fileNameWithExtension;
       }
         return $tab;
    }

    public function getFileNameFromLink($imageUrl)
    {
        $originalName = str_replace('\\', '/', $imageUrl);
        $pos = strrpos($originalName, '/');
        $originalName = false === $pos ? $originalName : substr($originalName, $pos + 1);

        return $originalName;
    }
}
