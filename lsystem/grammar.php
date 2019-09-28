<?php

const grammar = array(
  // plants
  // algae...
  'macrocystis' => array(
    'axiom' => 'F',
    'rules' => array(
      'F' => 'F[+F]F[-F]F',
    ),
    'angle' => 25.7,
  ),

  'laminaria' => array(
    'axiom' => 'F',
    'rules' => array(
      'F' => 'F[+F]F[-F][F]',
    ),
    'angle' => 20.0,
  ),

  'sargassum' => array(
    'axiom' => 'F',
    'rules' => array(
      'F' => 'FF-[-F+F+F]+[+F-F-F]',
    ),
    'angle' => 22.5,
  ),

  // grass..
  'poa' => array(
    'axiom' => 'X',
    'rules' => array(
      'X' => 'F[+X][-X]FX',
      'F' => 'FF',
    ),
    'angle' => 25.7,
  ),

  // sweetgrass
  'hierochole' => array(
    'axiom' => 'X',
    'rules' => array(
      'X' => 'F+[[X]-X]-F[-FX]+X',
      'F' => 'FF',
    ),
    'angle' => 25.0,
  ),

  // yarrow
  'millefolium' => array(
    'axiom' => 'X',
    'rules' => array(
      'X' => 'F[+X]F[-X]+X',
      'F' => 'FF',
    ),
    'angle' => 20.0,
  ),

  // 地獄の花
  // Barnsley
  'fern' => array(
    'axiom' => 'FD',
    'rules' => array(
      'D' => 'C+@FD',
      'C' => 'B',
      'B' => '[6+#FD][7-#FD]',
    ),
    'angle' => 5.4,
  ),

  // curves
  'island' => array(
    'axiom' => 'F-F-F-F',
    'rules' => array(
      'F+FF-FF-F-F+F+FF-F-F+F+FF+FF-F',
    ),
    'angle' => 90.0,
  ),

  'islands&lakes' => array(
    'axiom' => 'F+F+F+F',
    'rules' => array(
      'F' => 'F+f-FF+F+FF+Ff+FF-f+FF-F-FF-Ff-FFF',
      'f' => 'ffffff',
    ),
    'angle' => 90.0,
  ),

  'dragon' => array(
    'axiom' => 'L',
    'rules' => array(
      'L' => 'L+R+',
      'R' => '-L-R',
    ),
    'angle' => 90.0,
  ),

  'tree' => array(
    'axiom' => 'f',
    'rules' => array(
      'F' => 'FF',
      'f' => '-F[+F][---f]+F-F[++++f]-f',
    ),
    'angle' => 12.0,
  ),

  // Canary Islands dragon tree
  'drago' => array(
    'axiom' => 'F',
    'rules' => array(
      'F' => 'F[-F][+F]',
    ),
    'angle' => 25.0,
  ),
);

function get_grammar($name){
  if(array_key_exists($name, grammar)){
    return grammar[$name];
  }
  return grammar['laminaria'];
}
 ?>
