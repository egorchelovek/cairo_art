<?php
include 'drawing_window.php';

class PythagorianTree extends FractalDrawingWindow {

  public function getName() {
    return "Pythagorian tree fractal";
  }

  protected function onDraw($context){
    $width = $this->get_size()[0];
    $height = $this->get_size()[1];

    $context->setSourceRgba(1.0,1.0,1.0,1.0);
    $context->rectangle(0,0,$width,$height);
    $context->fill();
    $this->draw($context, $this->recursionDepth, $width/2 - 50, $height, $width/2 +50, $height);

  }
  public function draw($context, $depth, $x1, $y1, $x2, $y2){
    if($depth == 0) {
      return;
    }

    $dx = $x2-$x1;
    $dy = $y1-$y2;

    $x3 = $x2 - $dy;
    $y3 = $y2 - $dx;
    $x4 = $x1 - $dy;
    $y4 = $y1 - $dx;
    $x5 = $x4 + floatval(($dx - $dy))*0.5;
    $y5 = $y4 - floatval(($dx + $dy))*0.5;

    // draw rectangle
    $context->setSourceRgb(1.0 - floatval($this->recursionDepth-$depth)/$this->recursionDepth, floatval($this->recursionDepth-$depth)/$this->recursionDepth, 0.0);
    $context->MoveTo($x1, $y1);
    $context->LineTo($x2, $y2);
    $context->LineTo($x3, $y3);
    $context->LineTo($x4, $y4);
    $context->closePath();
    $context->fill();

    $depth--;
    $this->draw($context, $depth, $x4, $y4, $x5, $y5);
    $this->draw($context, $depth, $x5, $y5, $x3, $y3);
  }
}

$fractal = new PythagorianTree();
$fractal->setRecursionDepth(10);
Gtk::main();
?>
