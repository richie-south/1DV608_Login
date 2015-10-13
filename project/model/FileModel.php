<?php

namespace model;

class FileModel {

    private static $target_dir = "files/";
    private static $fileEnding = "mp3";
    public function __construct(){

    }

    // move this to DAL
    /*public function isSame($fileName){
        foreach(glob(self::$target_dir.'*.mp3') as $file) {
            if($fileName == rtrim(trim($file, self::$target_dir), ".mp3")){
                return true;
            }
            return false;
        }
    }*/

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

    public function isUploaded(){
        return is_uploaded_file($_FILES['mp3']['tmp_name']);
    }

    public function getFilePath($fileName){
        return self::$target_dir . basename($fileName);
    }

    public function moveUploadeFile($path){
        return move_uploaded_file($_FILES['mp3']['tmp_name'], $path);

    }

}
