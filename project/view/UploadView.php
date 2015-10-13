<?php

namespace view;

class UploadView {
    private static $upload = "UploadView::submit";
    private static $maxFileSize = 900000;
    private $uploadetFileURL = '';

    public function __construct(){
    }

    public function render($isUpload){
        if($isUpload){
            return $this->linkRender();
        }else{
            return $this->fileUploadRender();
        }
    }

    public function fileUploadRender(){
        return '<form method="post" name="mp3upload" enctype="multipart/form-data">
            <label for="mp3">mp3 File:</label>
            <input type="hidden" name="'.self::$maxFileSize.'" value="9000000000" />
            <input type="file" id="mp3" name="mp3" />
            <br/>
            <input type="submit" name="'.self::$upload.'" value="Upload" />
        </form>';
    }

    public function linkRender(){
        return '
            <p>Share this link!</p>
            <a href="'.$this->uploadetFileURL.'">'.$this->uploadetFileURL.'</a>';
    }

    public function isFileUploaded(){
        return isset($_POST[self::$upload]);
    }

    public function setUploadetFileURL($fileName){
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?f=$fileName";
        $this->uploadetFileURL = $actual_link;
    }

}
