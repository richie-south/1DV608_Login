<?php

namespace model;

class FileDontExsistException extends \Exception {};

class fileDAL {

    private static $target_dir = "files/";
    private static $removeFileTime = 86400; // 86400 = 60*60*25 = 24h
    private static $fileType = "mp3";
    private static $tmpName = "tmp_name";

    public function __construct(){
        $this->fileRemoval();
    }

    /**
     * [Removes files older than specific time]
     */
    private function fileRemoval(){
        foreach(glob(self::$target_dir.'*.'.self::$fileType) as $file) {
            if (filemtime($file) < (time()-self::$removeFileTime)) {
                unlink($file);
            }
        }
    }

    /**
     * [checks is file exsists in directory]
     * @param  [string] $fileName [name of a file]
     * @return [bool]   [true if file exsists]
     */
    private function doesExsist($fileName){
        foreach(glob(self::$target_dir.'*.'.self::$fileType) as $file) {
            if($fileName == $this->trimFilePath($file)){
                return true;
            }
        }
        return false;
    }

    private function getFilePath($fileName){
        $path = glob(self::$target_dir.=$fileName.".".self::$fileType);
        return $path[0];
    }

    // TODO: trimFilePath and makeFilePath should maybe  not be in fileDAL
    public function trimFilePath($file){
        return basename($file, '.'.self::$fileType);
    }
    public function makeFilePath($fileName){
        return self::$target_dir . basename($fileName);
    }

    public function isSame($file){
        return $this->doesExsist($file);
    }

    public function getFileName($file){
        if($this->doesExsist($file)){
            return $this->getFilePath($file);
        }
        throw new FileDontExsistException();
    }

    public function getTargetDir(){
        return self::$target_dir;
    }

    public function getAllFiles(){
        $array = [];
        foreach (glob(self::$target_dir.'*.'.self::$fileType) as $file) {
            $array[] = $this->trimFilePath($file);
        }
        return $array;
        //return glob(self::$target_dir.'*.'.self::$fileType);
    }

    public function isTempUploaded($file){
        return is_uploaded_file($file[self::$fileType][self::$tmpName]);
    }

    public function uploadFile($file, $path){
        return move_uploaded_file($file[self::$fileType][self::$tmpName], $path);
    }

    public function getFileType(){
        return self::$fileType;
    }
}
