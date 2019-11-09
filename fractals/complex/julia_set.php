<?php
require_once 'fractal_set.php';

const JuliaConstants = array(
  'common'    => array(-0.7,0.2),
  'golden'    => array(-0.618, 0.0),
  'stars'     => array(-0.70176,0.3842),
  'lightning' => array(0.0,-0.8),
  'rabbit'    => array(-0.123,0.745),
);

class JuliaSet extends FractalSet{

  var $const_re;
  var $const_im;

  public function JuliaSet($name = 'common'){
    $this->const_re = JuliaConstants[$name][0];
    $this->const_im = JuliaConstants[$name][1];
  }

  public function getTypeName(){
    return "Julia";
  }

  public function getValue($re0, $im0, $depth){
    $z_re = $re0;
    $z_im = $im0;
    $i = 0;
    while($i < $depth){
      $re2 = $z_re*$z_re;
      $im2 = $z_im*$z_im;
      if ($re2 + $im2  >= 4.0) return $i;
      $z_im = 2.0*$z_re*$z_im + $this->const_im;
      $z_re = $re2 - $im2 + $this->const_re;
      $i += 1;
    }
    return $depth;
  }
}
?>
