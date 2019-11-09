<?php
include 'drawing_window.php';
class HilbertCurve extends FractalDrawingWindow {

  private $start = False;

  public function getName() {
    return "Hilbert curve fractal";
  }

  protected function onDraw($context) {
    $height = $this->get_size()[0];
    $width = $this->get_size()[1];

    $context->setSourceRgb(1.0, 1.0, 1.0);
    $context->rectangle(0,0,$height, $width);
    $context->fill();

    $context->setSourceRgb(0.9, 0.4, 0.4);
    $context->setLineWidth(2);


    $this->draw($context, $this->recursionDepth, 0, 0, $height, 0.0, 0.0, $width, 0);
  }

  public function draw($context, $level, $x, $y, $xi, $xj, $yi, $yj, $pt){
    if($level <= 0){
      switch ($pt) {
        case 1:
          $context->setSourceRgb(0.4, 0.9, 0.4);
          break;

        case 2:
          $context->setSourceRgb(0.4, 0.4, 0.9);
          break;

        case 3:
          $context->setSourceRgb(0.9, 0.4, 0.9);
          break;

        default:
          $context->setSourceRgb(0.9, 0.4, 0.4);
          break;
      }

      // $context->arc($x + ($xi + $yi)/2,$y + ($xj + $yj)/2,2,0,6.28);

      if($this->start == False) {
        $context->MoveTo($x + ($xi + $yi)/2,$y + ($xj + $yj)/2);
        $this->start = True;
      } else {
        $context->LineTo($x + ($xi + $yi)/2,$y + ($xj + $yj)/2);
        $context->stroke();
        $context->MoveTo($x + ($xi + $yi)/2,$y + ($xj + $yj)/2);
      }

    } else {
      $this->draw($context, $level - 1, $x                , $y                ,  $yi/2,  $yj/2,  $xi/2,  $xj/2, 0);
      $this->draw($context, $level - 1, $x + $xi/2        , $y + $xj/2        ,  $xi/2,  $xj/2,  $yi/2,  $yj/2, 1);
      $this->draw($context, $level - 1, $x + $xi/2 + $yi/2, $y + $xj/2 + $yj/2,  $xi/2,  $xj/2,  $yi/2,  $yj/2, 2);
      $this->draw($context, $level - 1, $x + $xi/2 + $yi  , $y + $xj/2 + $yj  , -$yi/2, -$yj/2, -$xi/2, -$xj/2, 3);
    }
  }
}


$fractal = new HilbertCurve();
$fractal->setRecursionDepth(7);
Gtk::main();
?>
