<?php
require_once 'fractal_set.php';
require_once 'Math/ComplexOp.php';

class NewtonFractal extends FractalSet{

  public function getTypeName(){
    return "Newtonian";
  }

  private function F($z){
    return Math_ComplexOp::sub(Math_ComplexOp::powReal($z,3), new Math_Complex(1,0));
  }

  private function Fder($z){
    return Math_ComplexOp::mult(Math_ComplexOp::mult($z,$z),new Math_Complex(3,0));
  }

  public function getValue($re0, $im0, $depth){
    $z = new Math_Complex($re0,$im0);

    $roots = array(new Math_Complex(1,0),new Math_Complex(-0.5,sqrt(3)/2), new Math_Complex(-0.5,-sqrt(3)/2));
    $tolerance = 0.0001;

    $i = 0;
    while($i < $depth){

      $z = Math_ComplexOp::sub($z, Math_ComplexOp::div($this->F($z),$this->Fder($z)));
      foreach($roots as $root){
        $diff = Math_ComplexOp::sub($z,$root);
        if($diff->abs()<=$tolerance) return $i;
      }

      $i += 1;
    }

    return $depth;
  }
}
?>
