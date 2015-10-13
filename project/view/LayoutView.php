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
              <title>$title</title>
            </head>
            <body>
                $body
             </body>
          </html>
        ";
    }
}
