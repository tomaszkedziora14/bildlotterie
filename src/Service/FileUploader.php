<?php

namespace App\Service;

use App\Service\FileInfo;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class FileUploader
{
  private $fileInfo;

  public function __construct(FileInfo $fileInfo)
  {
      $this->fileInfo = $fileInfo;
  }

  public function uploadImage($imageUrl)
  {
      $imageName = $this->fileInfo->getOnlyFileNameFromLink($imageUrl);
      $uploadsDir = $this->fileInfo->getRootDirToOnlyFolder().$imageName;

      $log = new Logger('test');
      $log->pushHandler(new StreamHandler($this->fileInfo->getDirToLogFolder().'upload_log', Logger::WARNING));

      if(file_exists($this->fileInfo->getRootDirWitchFile($imageName))){
          $log->warning('trying to upload the same image '.$imageName);
      }

      $content = file_get_contents($imageUrl);
      $fp = fopen($uploadsDir, "w");
      fwrite($fp, $content);
      fclose($fp);
  }
}
