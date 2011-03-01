<?php

require "class.html.php";

$table_data = array(
  "foo" => "bar",
  "hello" => "world",
  "123" => "456",
  "abc" => "xyz"
);

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
          h::li(function() use($x){
            h::a("Link {$x}", "#{$x}");
          });
      });
      
      h::comment("let's see some text");
      h::p("Lorem ipsum dolor sit amet, consectetur adipisicing elit...");
      
      h::comment("now for a table");
      h::table(function(){
        
        # sadly, i'm not sure how to get around this at the moment :(  help me make this awesome
        global $table_data;
        
        h::tr(array("class"=>"header"), function(){
          h::th("key");
          h::th("value");
        });
        foreach($table_data as $k => $v){
          h::tr(array("class"=>h::cycle(array("odd", "even"))), function() use($k,$v){
            h::td($k);
            h::td($v);
          });
        }
      });
      
    });
  });
});

?>
