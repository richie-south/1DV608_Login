<?php

namespace model;

class WrongFileTypeException extends \Exception {};
class ToLargeFileException extends \Exception {};
class NoFileException extends \Exception {};

class FileModel {

    private $DAL;
    private $file;

    public function __construct($file, \model\DAL $dal){
        $this->DAL = $dal;
        $error = $file[$this->DAL->getFileType()]["error"];

        if($error == 3 || $error == 4){
            throw new NoFileException();
        }
        if($this->getFileTyp($file[$this->DAL->getFileType()]["type"]) != $this->DAL->getFileType()){
            throw new WrongFileTypeException();
        }
        if($this->compareSize($file[$this->DAL->getFileType()]["size"]) || $error == 1 || $error == 2){
            throw new ToLargeFileException();
        }


        $this->file = $file;
    }

    /**
     * @param  [string] $file [full file name]
     * @return [string]       [exstensition of file name]
     */
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

    public function generateFileName(){
        return $this->randomString(5);
    }
    public function getFile(){
        return $this->file;
    }

}
