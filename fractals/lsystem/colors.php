<?php
// my little happy colorset
// (huh, you're never watched Bob Ross??)
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

// return color rgb array by name
function get_color($name){
  if(array_key_exists($name, colorset)){
    return colorset[$name];
  }
  return colorset['black'];
};
?>
