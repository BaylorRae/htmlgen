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
  
  static public $self_closing_tags = array(
    "base", "basefont", "br", "col", "frame", "hr", "input", "link", "meta", "param"
  );
  
  static private $indent_level = -1;
  static private $indent_pattern = "\t";
  
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
    
    # indent
    echo self::indent();
    
    # self-closing tag
    if(in_array($tag, self::$self_closing_tags)){
      echo "<{$tag}", self::attributes($html_attributes), " />\n";
    }
    
    # standard tag
    else {
      echo "<{$tag}", self::attributes($html_attributes), ">";
      
      # block
      if($callback instanceof Closure) echo "\n", Utility::capture($callback), self::indent(false);
      
      # single line
      else echo $text;
        
      echo "</{$tag}>\n";
    }
    
    # outdent
    self::outdent();
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
  
  # comment tag
  static public function comment($comment){
    echo "\n", self::indent(), "<!-- {$comment} -->\n";
    self::outdent();
  }
  
  # set indent level
  static public function set_indent_level($level){
    if(is_numeric($level)) self::$indent_level = $level-1;
  }
  
  # set indent pattern
  static public function set_indent_pattern($pattern){
    self::$indent_pattern = $pattern;
  }
  
  # increase indent level
  static private function indent($increment=true){
    if($increment) self::$indent_level++;
    $tabs = "";
    for($i=0; $i<self::$indent_level; $i++) $tabs .= self::$indent_pattern;
    return $tabs;
  }
  
  # decrease indent level
  static private function outdent(){
    self::$indent_level--;
  }
  
}

?>
