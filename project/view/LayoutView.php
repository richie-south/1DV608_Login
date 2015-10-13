<?php

namespace view;

class LayoutView {

    public function __construct(){

    }

    public function renderHTMLPage($title, $body){
        echo "<!DOCTYPE html>
          <html>
            <head>
              <meta charset='utf-8'>
               <link rel='stylesheet' type='text/css' href='view/css/style.css'>
              <title>$title</title>
            </head>
            <body>
                <main>
                    <div class='wrap'>
                        $body
                    </div>
                </main>
             </body>
          </html>
        ";
    }
}
