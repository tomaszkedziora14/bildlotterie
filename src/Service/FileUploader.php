<?php

namespace App\Service;

use App\Service\FileInfoInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use App\Service\File;
use App\Service\FileUploaderInterface;

class FileUploader implements FileUploaderInterface
{
  private $fileInfo;

  public function __construct(FileInfoInterface $fileInfo)
  {
      $this->fileInfo = $fileInfo;
  }

  public function upload($uploadedFile)
  {
      $imageName = $this->fileInfo->getFileNameFromLink($uploadedFile);
      $uploadsDir = $this->fileInfo->getRootDir().$imageName;

      $log = new Logger('test');
      $log->pushHandler(new StreamHandler($this->fileInfo->getDirToLogFolder().'upload_log', Logger::WARNING));

      if(file_exists($this->fileInfo->getRootDirWitchFile($imageName))){
          $log->warning('trying to upload the same image '.$imageName);
      }

      $content = file_get_contents($uploadedFile);
      $fp = fopen($uploadsDir, "w");
      fwrite($fp, $content);
      fclose($fp);
  }
}
