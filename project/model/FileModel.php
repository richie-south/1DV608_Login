<?php

namespace model;

class WrongFileTypeException extends \Exception {};
class ToLargeFileException extends \Exception {};

class FileModel {

    private $DAL;
    private $file;

    public function __construct($file, \model\DAL $dal){
        $this->DAL = $dal;
        if($this->getFileTyp($file[$this->DAL->getFileType()]["type"]) != $this->DAL->getFileType()){
            throw new WrongFileTypeException();
        }
        if($this->compareSize($file[$this->DAL->getFileType()]["size"])){
            throw new ToLargeFileException();
        }
        $this->file = $file;
    }

    private function getFileTyp($file){
        $type = explode("/",$file);
        return $type[1];
    }

    private function compareSize($size){
        return $size < 0 || $size > 9000000;
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
        return $result.=".".$this->DAL->getFileType();
    }
//is_numeric
    public function generateFileName(){
        return $this->randomString(5);
    }
    public function getFile(){
        return $this->file;
    }

}
