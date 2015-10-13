<?php

namespace view;

class ShowFileView {

    private $DAL;
    private $message;

    public function __construct(\model\DAL $dal){
        $this->DAL = $dal;
        $this->message = "";
    }

    public function getFile($fileName){
        try {
            $name = $this->DAL->getFileName($fileName);
            return $name;
        } catch(\model\FileDontExsistException $e){
            $this->message = "File Dont exist";
        } catch (Exception $e) {
            $this->message = "Unspecified error";
        }
        return null;
    }

    public function generateFile($name){
        return '<p>'.$this->message.'</p>
            <audio controls>
                <source src="'.$name.'" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>';
    }

    public function undefinedName(){
        return '<p>'.$this->message.'</p>';
    }
}
