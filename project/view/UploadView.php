<?php

namespace view;

class UploadView {
    private static $upload = "UploadView::submit";
    private static $maxFileSize = 900000;
    private $uploadetFileURL = '';
    private $DAL;
    private $message = '';

    public function __construct(\model\DAL $dal){
        $this->DAL = $dal;
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

    public function errorPageRender(){
        return '
        <p>'.$this->message.'</p>
        <a href="?">Back to start</a>
        ';
    }

    public function isFileUploaded(){
        return isset($_POST[self::$upload]);
    }

    public function setUploadetFileURL($fileName){
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?f=$fileName";
        $this->uploadetFileURL = $actual_link;
    }

    public function getFile(){
        try {
            return new \model\FileModel($_FILES, $this->DAL);
        } catch (\model\WrongFileTypeException $e) {
            $this->message = "Wrong file format";
        } catch (\model\ToLargeFileException $e) {
            $this->message = "To large file!";
        } catch (\model\NoFileException $e){
            $this->message = "No file uploaded!";
        }

        return null;
    }
}
