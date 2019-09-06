<?php
include 'drawing_window.php';

class DragonCurve extends FractalDrawingWindow {

  public function getName() {
    return "Dragon curve fractal";
  }

  protected function onDraw($context){
    $width = $this->get_size()[0];
    $height = $this->get_size()[1];

    $turns = $this->getSequence($this->recursionDepth);
    $startAngle = -$this->recursionDepth * 3.14 / 4;
    $side = 400 / pow(2, $this->recursionDepth / 2.);
    $this->draw($context, $turns, $startAngle, $side, 230, 350);

  }

  public function getSequence($depth){
    $seq = array();
    for($i =0; $i < $depth; $i++) {
      $copy = $seq;
      $copy = array_reverse($copy);
      array_push($seq,1);
      foreach($copy as $val){
        array_push($seq,-$val);
      }
    }
    var_dump($seq);
    return $seq;
  }

  public function draw($context, $turns, $startAngle, $side, $x1, $y1){
    $angle = $startAngle;
    $x2 = $x1 + intval(cos($angle)*$side);
    $y2 = $y1 + intval(sin($angle)*$side);
    $context->setSourceRgb(0.0, 0.0, 0.0);
    $context->moveTo($x1,$y1);
    $context->lineTo($x2,$y2);
    $context->stroke();
    $x1 = $x2;
    $y1 = $y2;
    foreach($turns as $turn){
      $angle += $turn * 3.14 / 2;
      $x2 = $x1 + intval(cos($angle)*$side);
      $y2 = $y1 + intval(sin($angle)*$side);
      $context->moveTo($x1,$y1);
      $context->lineTo($x2,$y2);
      $context->stroke();
      $x1 = $x2;
      $y1 = $y2;
    }
  }
}

$fractal = new DragonCurve();
$fractal->setRecursionDepth(15);
Gtk::main();
?>
