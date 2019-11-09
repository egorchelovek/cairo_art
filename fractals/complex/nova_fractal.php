<?php
require_once 'fractal_set.php';

class NovaFractal extends FractalSet{

  public function getTypeName(){
    return "Nova";
  }

  public function getValue($re0, $im0, $depth){

    $a = $re0;
    $b = $im0;

    $ra = 1;
    $rb = 1;
    $ca = 2;
    $cb = 1;

    $tolerance = 0.001;

    $a_old = $a + $tolerance;
    $b_old = $b + $tolerance;

    $i = 0;
    while($i < $depth){

      $a2 = $a*$a;
      $b2 = $b*$b;
      $b4 = $b2*$b2;
      $a4 = $a2*$a2;

      $div= $a2+$b2;
      $div = 3*$div*$div;
      if($div==0) return $i;

      $ab2 = $a2*$b2;


      $a -= $ra * ($a2 - $b2 + $a*$b4 + $a4*$a + 2*$a*$ab2)/$div - $ca;
      $b -= $rb * (-2*$a*$b + $b4*$b + 2*$ab2*$b+$a4*$b)/$div - $cb;

      if(abs($a-$a_old) <= $tolerance && abs($b-$b_old) <= $tolerance) return $i;

      $a_old = $a;
      $b_old = $b;

      $i += 1;
    }
    return $depth;
  }
}
?>
