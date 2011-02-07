<?php

require "class.html.php";

Html::content_for("div", array("id" => "wrapper"), function(){
  Html::h1("Hello, World", array("class" => "title"));
  Html::content_for("ul", array("class" => "numbers"), function(){
    foreach(array(1,2,3) as $x)
      Html::li($x);
  });
});

# ------------------------------
# output 
/*

<div id="wrapper">
<h1 class="title">Hello, World</h1>
<ul class="numbers">
<li>1</li>
<li>2</li>
<li>3</li>
</ul>
</div>

*/

?>
