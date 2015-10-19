<?php

namespace model;

class WrongFileTypeException extends \Exception {};
class ToLargeFileException extends \Exception {};
class NoFileException extends \Exception {};

class FileModel {

    private $DAL;
    private $file;
    private static $type = "type";
    private static $size = "size";

    /**
     * @param [$_FILES]   $file []
     * @param [object]   $dal [an instanse of the dal class]
     */
    public function __construct($file, \model\DAL $dal){
        $this->DAL = $dal;
        $error = $file[$this->DAL->getFileType()]["error"];

        //  Error 3 = file was only partially uploaded | Errpr 4 = no file was uploaded
        if($error == 3 || $error == 4){
            throw new NoFileException();
        }
        // Error 1 = file larger than server max upload | Error 2 = max sise och html form
        if($error == 1 || $error == 2){
            throw new ToLargeFileException();
        }
        if($this->getFileTyp($file[$this->DAL->getFileType()][self::$type]) != $this->DAL->getFileType()){
            throw new WrongFileTypeException();
        }

        $this->file = $file;
    }

    /**
     * @param  [string] $file [full file name]
     * @return [string]       [exstensition of file name]
     */
    private function getFileTyp($file){
        $type = explode("/",$file);
        return is_array($type) ? $type[1] : "";
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
        return $result;
    }


    public function generateFileName(){
        $randomString = $this->randomString(5);
        return $randomString.=".".$this->DAL->getFileType();
    }
    public function getFile(){
        return $this->file;
    }

}
