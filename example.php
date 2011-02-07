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
