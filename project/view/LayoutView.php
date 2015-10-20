<?php

namespace view;

class LayoutView {

    private $navigationView;

    public function __construct(\view\NavigationView $nav){
        $this->navigationView = $nav;
    }

    public function renderHTMLPage($body){
        echo '<!DOCTYPE html>
          <html>
            <head>
              <meta charset="utf-8">
               <link rel="stylesheet" type="text/css" href="view/css/style.css">
              <title>Project</title>
            </head>
            <body>
                <a href="?'.$this->navigationView->getLoginURL().'">Login</a>
                <main>
                    <div class="wrap">
                        '.$body.'
                    </div>
                </main>
             </body>
          </html>
        ';
    }
}
