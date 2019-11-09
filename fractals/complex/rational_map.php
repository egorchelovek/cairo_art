<?php
require_once 'fractal_set.php';
require_once 'Math/Complex.php';

class RationalMap extends FractalSet{

  public function getTypeName(){
    return "Rational map";
  }

  public function getValue($const_re, $const_im, $depth){

    $roots = array(
      new Math_Complex(-0.769161,0),
      new Math_Complex(0,-0.769161),
      new Math_Complex(0,0.769161),
      new Math_Complex(0.769161,0)
    );

    $a = $const_re;
    $b = $const_im;

    $tolerance = 0.1;

    $i = 0;
    while($i < $depth){

      $a2 = $a*$a;
      $b2 = $b*$b;
      $inv = $a2 - $b2;
      $div = $a2 + $b2;
      $div = $div*$div;
      $ab = $a*$b;

      $a = (-0.35/$div + 1)*$inv;
      $b = (0.7/$div + 2)*$ab;

      foreach($roots as $root){
        if(abs($root->getReal() - $a) <= $tolerance && abs($root->getIm() - $b) <= $tolerance) return $i;
      }

      $i += 1;
    }
    return $depth;
  }
}
?>
