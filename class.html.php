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
  
  # reverse merge arrays
  static public function reverse_merge(Array &$overrides, Array $options){
    $overrides = array_merge($options, $overrides);
  }
  
  # captures the output of a Closure
  static public function capture(Closure $call){
    ob_start(); $call(); return ob_get_clean();
  }
  
}

class Html {
  
  # the magic
  static public function __callStatic($tag, $args){
    $params = array(null, array(), null);
    foreach($args as $a){
      if    (is_string($a))         $params[0] = $a;
      elseif(is_array($a))          $params[1] = $a;
      elseif($a instanceof Closure) $params[2] = $a;
    }
    array_unshift($params, $tag);
    call_user_func_array(array("Html", "content_for"), $params);
  }
  
  # tag generator
  static private function content_for($tag, $text=null, $html_attributes=array(), $callback=null){
    echo "<{$tag}", self::attributes($html_attributes), ">", $callback instanceof Closure ? "\n".Utility::capture($callback) : $text, "</{$tag}>\n";
  }
  
  # html attribute generator
  static private function attributes(Array $attributes){
    if(count($attributes) < 1){
      return null;
    }
    return " ".implode(" ", Utility::array_kmap(function($k, $v){
      return "{$k}=\"".htmlspecialchars($v)."\"";
    }, $attributes));
  }
  
  # example convenience method override
  static public function a($text, $href, $html_attributes=array()){
    Utility::reverse_merge($html_attributes, array('href' => $href));
    self::__callStatic("a", array($text, $html_attributes));
  }
  
}

?>
