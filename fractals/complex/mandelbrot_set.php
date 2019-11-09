<?php
require_once 'fractal_set.php';

class MandelbrotSet extends FractalSet{

  public function getTypeName(){
    return "Mandelbrot";
  }

  public function getValue($re0, $im0, $depth){
    $z_re = 0.0;
    $z_im = 0.0;
    $i = 0;
    while($i < $depth){
      $re2 = $z_re*$z_re;
      $im2 = $z_im*$z_im;
      if ($re2 + $im2  >= 4.0) return $i;
      $z_im = 2.0*$z_re*$z_im + $re0;
      $z_re = $re2 - $im2 + $im0;
      $i += 1;
    }
    return $depth;
  }
}
?>
