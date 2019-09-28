<?php

const colorset = array(
  'black' => array(0.0,0.0,0.0),
  'white' => array(1.0,1.0,1.0),
  'red' => array(1.0,0.0,0.0),
  'green' => array(0.0,1.0,0.0),
  'blue' => array(0.0,0.0,1.0),
  'cyan' => array(0.0,1.0,1.0),
  'magenta' => array(1.0,0.0,1.0),
  'yellow' => array(1.0,1.0,0.0),
);

function get_color($name){
  if(array_key_exists($name, colorset)){
    return colorset[$name];
  }
  return colorset['black'];
};

?>
