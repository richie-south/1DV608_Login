<?php

namespace controller;

class FileGetController {

    private $showFileView;
    private $view;

    public function __construct(\view\ShowFileView $sfv){
        $this->showFileView = $sfv;
    }

    public function getFile($fileName){

        $file = $this->showFileView->getFile($fileName);
        if($file != null){
            $this->view = $this->showFileView->generateAudioControlls($file);
        }else{
            $this->view = $this->showFileView->undefinedName();
        }
    }

    public function getHTML(){
        return $this->view;
    }


}
