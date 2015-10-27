<?php

namespace view;

class LayoutView {

    public function __construct(){
    }

    public function renderHTMLPage($body, $navigation){
        echo '<!DOCTYPE html>
          <html>
            <head>
              <meta charset="utf-8">
               <link rel="stylesheet" type="text/css" href="view/css/style.css">
              <title>Project</title>
              <link rel="import" href="https://www.polymer-project.org/0.5/components/paper-ripple/paper-ripple.html">
               <link rel="import" href="http://www.polymer-project.org/components/core-icons/core-icons.html">
               <link rel="import" href="http://www.polymer-project.org/components/font-roboto/roboto.html">
            </head>
            <div class="link">
                '.$navigation.'
            </div>

            <body>

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
