<?php

require "class.html.php";

Html::div(array("id" => "wrapper"), function(){
  Html::h1("Hello, World", array("class" => "title"));
  Html::ul(array("class" => "links"), function(){
    foreach(array(1,2,3) as $x)
      Html::li(function() use($x) {
        Html::a("Link {$x}", "#{$x}");
      });
  });
});

?>
