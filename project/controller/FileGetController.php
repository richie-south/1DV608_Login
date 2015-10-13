<?php

namespace controller;

// NOT IN USE RIGHT NOW
class FileGetController {

    private $showFileView;
    private $fileGetModel;
    private $view;

    public function __construct(\view\ShowFileView $sfv){
        $this->showFileView = $sfv;

    }

    public function getFile($fileName){

        $file = $this->showFileView->getFile($fileName);
        if($file != null){
            $this->view = $this->showFileView->generateFile($file);
        }else{
            $this->view = $this->showFileView->undefinedName();
        }
    }

    public function getHTML(){
        return $this->view;
    }
}
