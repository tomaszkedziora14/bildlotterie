<?php

namespace App\Service;

use App\Service\FileInfoInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use App\Service\File;

class FileUploader
{
  private $fileInfo;

  public function __construct(FileInfoInterface $fileInfo)
  {
      $this->fileInfo = $fileInfo;
  }

  public function upload($imageUrl)
  {
      $imageName = $this->fileInfo->getFileNameFromLink($imageUrl);
      $uploadsDir = $this->fileInfo->getRootDir().$imageName;

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
