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
