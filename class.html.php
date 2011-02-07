<?php

class Utility {
  # php doesn't have this function; ftfy
  static public function array_kmap(Closure $callback, Array $input){
    $output = array();
    foreach($input as $key => $value){
      array_push($output, $callback($key, $value));
    }
    return $output;
  }
}

class Html {
  
  # the magic
  static public function __callStatic($tag, $args){
    array_unshift($args, $tag);
    call_user_func_array(array("Html", "content_tag"), $args);
  }
  
  # the two basic tags
  static public function content_for($tag, $html_attributes=array(), $callback=null){
    echo "<{$tag}" . self::attributes($html_attributes) . ">\n", is_null($callback) ? null : $callback() , "</{$tag}>\n";
  }
  
  static public function content_tag($tag, $text, $html_attributes=array()){
    echo "<{$tag}", self::attributes($html_attributes), ">{$text}</{$tag}>\n";
  }
  
  # html attribute generator
  static public function attributes(Array $attributes){
    if(count($attributes) < 1){
      return null;
    }
    return " ".implode(" ", Utility::array_kmap(function($k, $v){
      return "{$k}=\"".htmlspecialchars($v)."\"";
    }, $attributes));
  }
  
}

?>