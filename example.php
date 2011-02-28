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
