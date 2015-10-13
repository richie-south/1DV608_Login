<?php

namespace view;

class UploadView {
    private static $upload = "UploadView::submit";
    private static $maxFileSize = 900000;

    public function __construct(){

    }

    public function render($isUpload){
        if($isUpload){
            return $this->linkRender();
        }else{
            return $this->fileUploadRender();
        }
    }

    // move file uploadRender and is FileUploaded to new view class
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
        return '<p>
            hej hej hej
        </p>';
    }

    public function isFileUploaded(){
        return isset($_POST[self::$upload]);
    }
    
}
