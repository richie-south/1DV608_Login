<?php

namespace model;

class FileDontExsistException extends \Exception {};

class DAL {

    private static $target_dir = "files/";

    public function __construct(){

    }

    // TODO: update this 

    private function files($fileName){
        foreach(glob(self::$target_dir.'*.mp3') as $file) {
            if($fileName == rtrim(trim($file, self::$target_dir), ".mp3")){
                return true;
            }

        }
        return false;
    }

    public function isSame($fileName){
        return $this->files($fileName);
    }

    public function getFileName($fileName){
        if($this->files($fileName)){
            return $fileName;
        }

        throw new FileDontExsistException();
    }
}
