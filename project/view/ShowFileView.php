<?php

namespace view;

class ShowFileView {

    private $DAL;
    private $message;

    public function __construct(\model\fileDAL $dal){
        $this->DAL = $dal;
        $this->message = "";
    }

    /**
     * @return [string] [file if no error ecours]
     */
    public function getFile($fileName){
        try {
            return $this->DAL->getFileName($fileName);
        } catch(\model\FileDontExsistException $e){
            $this->message = "File Dont exist";
        } catch (Exception $e) {
            $this->message = "Unspecified error";
        }
        return null;
    }

    public function generateAudioControlls($name){
        return '
            <section>
               <div class="dialog whide">

                   <div class="content">
                       <div class="title">Enjoy</div><br>
                       <p>'.$this->message.'</p>
                       <audio controls>
                           <source src="'.$name.'" type="audio/mpeg">
                           Your browser does not support the audio element.
                       </audio>
                   </div>

                   <div class="button label-blue">
                       <div class="center" fit><a href="?">Back</a></div>
                   </div>

               </div>
            </section>
            ';
    }

    public function undefinedName(){
        return '<p>'.$this->message.'</p>';
    }
}
