<?php
require_once 'fractal_set.php';
require_once 'Math/Complex.php';

class GlynnFractal extends FractalSet{

  public function getTypeName(){
    return "Glynn";
  }

  private function F($z,$c){
    return Math_ComplexOp::sub(Math_ComplexOp::powReal($z,1.5), $c);
  }

  public function getValue($const_re, $const_im, $depth){
    $z = new Math_Complex($const_re,$const_im);
    $c = new Math_Complex(0.1948,0);
    $i = 0;
    while($i < $depth){
      $z = $this->F($z,$c);
      if($z->abs2() >= 4) return $i;
      $i += 1;
    }
    return $depth;
  }
}
?>
