<?php

namespace view;

class UploadView {
    private static $upload = "UploadView::submit";
    private $uploadetFileURL = '';
    private $DAL;
    private $message = '';

    public function __construct(\model\fileDAL $dal){
        $this->DAL = $dal;
    }

    public function fileUploadRender(){
        return '

         <section>
            <div class="dialog">
                <form method="post" name="mp3upload" enctype="multipart/form-data">
                    <div class="content">
                        <div class="title">Upload mp3</div><br>
                        <div></div>
                    </div>

                    <div class="button label-blue">
                        <div class="center" fit>
                            <input type="hidden" name="MAX_FILE_SIZE" value="'.\Settings::MaxFileSize.'" />
                            <input type="file" id="mp3" name="mp3" />
                        </div>

                    </div>

                    <div class="button label-blue">
                        <div class="center" fit><input type="submit" name="'.self::$upload.'" value="Upload" /></div>
                    </div>
                </form>
            </div>
         </section>';
    }

    public function linkRender(){
        return '
            <section>
                <div class="dialog">

                    <div class="content">
                        <div class="title">Share this link!</div><br>
                        <div><a href="'.$this->uploadetFileURL.'">'.$this->uploadetFileURL.'</a></div>
                    </div>

                    <div class="button label-blue">
                        <div class="center" fit><a href="?">Back</a></div>
                    </div>

                </div>
            </section>
            ';
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

    /**
     * [checks if file i uploaded]
     */
    public function isTempUploaded(){
        return is_uploaded_file($_FILES[$this->DAL->getFileType()][$this->DAL->getTmpName()]);
    }

    /**
     * @return [filemodel] [returns instance of filemodel if file is correct format and size]
     */
    public function getFile(){
        try {
            return new \model\FileModel($_FILES, $this->DAL);
        } catch (\model\WrongFileTypeException $e) {
            $this->message = "Wrong file format";
        } catch (\model\ToLargeFileException $e) {
            $this->message = "To large file!";
        } catch (\model\NoFileException $e){
            $this->message = "No file uploaded!";
        } catch (Exception $e) {
            $this->message = "Unspecified error";
        }

        return null;
    }
}
