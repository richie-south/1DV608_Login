<?php

namespace model;

class FileDontExsistException extends \Exception {};

class DAL {

    private static $target_dir = "files/";

    public function __construct(){
        $this->fileRemoval();
    }

    private function fileRemoval(){
        foreach(glob(self::$target_dir.'*.mp3') as $file) {
            if (filemtime($file) < (time()-86400)) {  // 86400 = 60*60*24
                unlink($file);
            }
        }
    }

    private function doesExsist($fileName){
        foreach(glob(self::$target_dir.'*.mp3') as $file) {
            if($fileName == rtrim(trim($file, self::$target_dir), ".mp3")){
                return true;
            }
        }
        return false;
    }

    private function getFilePath($fileName){
        $path = glob(self::$target_dir.=$fileName.".mp3");
        return $path[0];
    }

    public function makeFilePath($fileName){
        return self::$target_dir . basename($fileName);
    }

    public function isSame($fileName){
        return $this->doesExsist($fileName);
    }

    public function getFileName($fileName){
        if($this->doesExsist($fileName)){
            return $this->getFilePath($fileName);
        }
        throw new FileDontExsistException();
    }

    public function getTargetDir(){
        return $this->target_dir;
    }

    public function uploadFile($file, $path){
        return move_uploaded_file($file, $path);
    }
}
