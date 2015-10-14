<?php

namespace model;

class WrongFileTypeException extends \Exception {};
class ToLargeFileException extends \Exception {};

class FileModel {

    private $target_dir;
    private $fileType;
    private static $tmpName = "tmp_name";

    public function __construct($fileType, $targetDir){
        $this->fileType = $fileType;
        $this->target_dir = $targetDir;
    }

    /**
     * [creates a random string och numbers and letters]
     * @param  [int] $length [length of returnd string]
     * @return [string] [random string]
     */
    private function randomString($length){
        if(!is_int($length)){
            throw new \Exception();
        }

        $result = '';
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for($i = $length; $i > 0; --$i)
        {
            $val = round(rand(1, (strlen($chars) -1)));
            $result .= $chars[intval($val)];
        }
        return $result.=".".$this->fileType;
    }

    public function generateFileName(){
        return $this->randomString(5);
    }

    // move view
    public function isTempUploaded(){
        return is_uploaded_file($_FILES[$this->fileType][self::$tmpName]);
    }

    /*public function getFileToUpload(){
        return $_FILES[$this->fileType][self::$tmpName];
    }*/

    public function trimFilePath($path){
        return rtrim(trim($path, $this->target_dir), ".".$this->fileType);
    }

    public function getUploadedFileTyp(){
        $type = explode("/",$_FILES[$this->fileType]["type"]);
        return $type[1];
    }


    public function checkFileType($fileType){
        if($fileType == $this->fileType){
            return true;
        }
        throw new WrongFileTypeException();
    }

}
