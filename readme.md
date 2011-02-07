# htmlgen

A lightweight DSP for HTML generation in PHP

## Requirements

PHP >= 5.3

## Code example

    <?php

    require "class.html.php";

    Html::content_for("div", array("id" => "wrapper"), function(){
      Html::h1("Hello, World", array("class" => "title"));
      Html::content_for("ul", array("class" => "numbers"), function(){
        foreach(array(1,2,3) as $x)
          Html::content_for("li", array(), function() use ($x) {
            Html::a("Link {$x}", "#{$x}");
          });
      });
    });
    
    ?>

## output

    <div id="wrapper">
    <h1 class="title">Hello, World</h1>
    <ul class="numbers">
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
    </div>
