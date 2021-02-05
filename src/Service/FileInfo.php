<?php

namespace App\Service;

use Symfony\Component\Finder\Finder;

class FileInfo
{
    public function getRootDirWitchFile($file)
    {
       return '../uploads/'.$file;
    }

    public function getRootDirToOnlyFolder()
    {
       return '../uploads/';
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

    public function getOnlyFileNameFromLink($imageUrl)
    {
        $originalName = str_replace('\\', '/', $imageUrl);
        $pos = strrpos($originalName, '/');
        $originalName = false === $pos ? $originalName : substr($originalName, $pos + 1);

        return $originalName;
    }
}
