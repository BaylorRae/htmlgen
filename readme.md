# htmlgen

A lightweight DSL for HTML generation in PHP

## Requirements

PHP >= 5.3

## Code example

    <?php

    require "class.html.php";

    h::set_indent_pattern("  ");

    h::html(function(){
      h::head(function(){
        h::meta(array("http-equiv"=>"Content-Type", "content"=>"text/html; charset=UTF-8"));
        h::link(array("rel"=>"stylesheet", "type"=>"text/css", "href"=>"global.css"));
      });
      h::body(function(){
        h::div(array("id"=>"wrapper"), function(){
          h::h1("Hello, World", array("class"=>"title"));

          h::comment("navigation");
          h::ul(array("class"=>"links"), function(){
            foreach(array(1,2,3) as $x)
              h::li(function() use($x) {
                h::a("Link {$x}", "#{$x}");
              });
          });

          h::comment("let's see some text");
          h::p("Lorem ipsum dolor sit amet, consectetur adipisicing elit...");

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
