# htmlgen

A lightweight DSL for HTML generation in PHP

## Requirements

PHP >= 5.3

## Code example

    <?php

    require "class.html.php";

    Html::set_indent_pattern("  ");

    Html::html(function(){
      Html::head(function(){
        Html::meta(array("http-equiv"=>"Content-Type", "content"=>"text/html; charset=UTF-8"));
        Html::link(array("rel"=>"stylesheet", "type"=>"text/css", "href"=>"global.css"));
      });
      Html::body(function(){
        Html::div(array("id"=>"wrapper"), function(){
          Html::h1("Hello, World", array("class"=>"title"));

          Html::comment("navigation");
          Html::ul(array("class"=>"links"), function(){
            foreach(array(1,2,3) as $x)
              Html::li(function() use($x) {
                Html::a("Link {$x}", "#{$x}");
              });
          });

          Html::comment("let's see some text");
          Html::p("Lorem ipsum dolor sit amet, consectetur adipisicing elit...");

        });
      });
    });

    ?>

## Output

    <html>
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="global.css" />
      </head>
      <body>
        <div id="wrapper">
          <h1 class="title">Hello, World</h1>

          <!-- navigation -->
          <ul class="links">
            <li>
              <a href="#1">Link 1</a>
            </li>
            <li>
              <a href="#2">Link 2</a>
            </li>
            <li>
              <a href="#3">Link 3</a>
            </li>
          </ul>

          <!-- let's see some text -->
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
        </div>
      </body>
    </html>
    

## Try it and see!

    $ cd htmlgen
    $ php example.php
