<?php

namespace model;

class FileModel {

    private static $target_dir = "files/";
    private static $fileEnding = "mp3";
    private static $tmpName = "tmp_name";

    public function __construct(){

    }

    public function generateFileName(){
        $result = '';
        $length = 5;
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for($i = $length; $i > 0; --$i)
        {
            $val = round(rand(1, (strlen($chars) -1)));
            $result .= $chars[intval($val)];
        }
        return $result.=".".self::$fileEnding;
    }

    public function isTempUploaded(){
        return is_uploaded_file($_FILES[self::$fileEnding][self::$tmpName]);
    }

    public function getFileToUpload(){
        return $_FILES[self::$fileEnding][self::$tmpName];
    }

    public function trimFilePath($path){
        return rtrim(trim($path, self::$target_dir), ".mp3");
    }

}
