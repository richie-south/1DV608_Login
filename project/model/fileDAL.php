<?php

namespace model;

class FileDontExsistException extends \Exception {};

class fileDAL {

    private static $target_dir = "files/";
    private static $removeFileTime = 86400; // 86400 = 60*60*25 = 24h
    private static $fileType = "mp3";
    private static $tmpName = "tmp_name";

    public function __construct(){
        $this->removeOldFiles();
    }

    /**
     * [Removes files older than specified time]
     */
    private function removeOldFiles(){
        foreach(glob(self::$target_dir.'*.'.self::$fileType) as $file) {
            if (filemtime($file) < (time()-self::$removeFileTime)) {
                $this->removeFile($file);
            }
        }
    }
    /**
     * [checks is file exsists in directory]
     * @param  [string] $fileName [name of a file]
     * @return [bool]   [true if file exsists]
     */
    private function doesExsist($filename){
        foreach(glob(self::$target_dir.'*.'.self::$fileType) as $file) {
            if($filename == $this->trimFilePath($file)){
                return true;
            }
        }
        return false;
    }

    /**
     * [get file path from file]
     * @param  [string] $filename [name of a file]
     * @return [string]           [path to a file]
     */
    public function getFilePath($filename){
        $path = glob(self::$target_dir.$filename.".".self::$fileType);
        return $path[0];
    }

    /**
     * [removes file ]
     * @param  [string] $pathToFile [path+filename]
     */
    public function removeFile($pathToFile){
        unlink($pathToFile);
    }

    /**
     * [remove file fomr file name]
     */
    private function removeFileFromName($filename){
        $path = $this->getFilePath($filename);
        $this->removeFile($path);
    }

    /**
     * [removes files from file names]
     */
    public function removeFilesFromName($filenames){
        foreach ($filenames as $filename) {
            $this->removeFileFromName($filename);
        }
    }

    /**
     * removes file ending form file
     */
    public function trimFilePath($file){
        return basename($file, '.'.self::$fileType);
    }

    /**
     * [add target_dir to file making full path to file]
     */
    public function makeFilePath($fileName){
        return self::$target_dir . basename($fileName);
    }

    /**
     * [checks if file exsists]
     * @param [string] [name of a file]
     * @return [bool] [true if file exsists]
     */
    public function isSame($filename){
        return $this->doesExsist($filename);
    }

    /**
     * @return [string] [path to file if it exsists]
     */
    public function getFileName($file){
        if($this->doesExsist($file)){
            return $this->getFilePath($file);
        }
        throw new FileDontExsistException();
    }

    /**
     * @return [string] [folder location to save files to]
     */
    public function getTargetDir(){
        return self::$target_dir;
    }

    /**
     * @return [array] [all filenames in target_dir]
     */
    public function getAllFiles(){
        $array = [];
        foreach (glob(self::$target_dir.'*.'.self::$fileType) as $file) {
            $array[] = $this->trimFilePath($file);
        }
        return $array;
    }

    /**
     * @param  [file] $file [file to move]
     * @param  [string] $path [place to move file]
     * @return [bool]       [true if sucsessful]
     */
    public function uploadFile($file, $path){
        return move_uploaded_file($file[self::$fileType][self::$tmpName], $path);
    }

    /**
     * @return [string] [file ending]
     */
    public function getFileType(){
        return self::$fileType;
    }

    /**
     * @return [string] [tmpName]
     */
    public function getTmpName(){
        return self::$tmpName;
    }
}
