<?php

namespace view;

class UploadView {
    private static $upload = "UploadView::submit";
    private $uploadetFileURL = '';
    private $DAL;
    private $message = '';

    public function __construct(\model\DAL $dal){
        $this->DAL = $dal;
    }

    public function fileUploadRender(){
        return '
        <form method="post" name="mp3upload" enctype="multipart/form-data">
            <label for="mp3">mp3 File:</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="'.\Settings::MaxFileSize.'" />
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
        return '<p>'.$this->message.'</p>'. $this->fileUploadRender();
    }

    public function isFileUploaded(){
        return isset($_POST[self::$upload]);
    }

    public function setUploadetFileURL($URL){
        $this->uploadetFileURL = $URL;
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
