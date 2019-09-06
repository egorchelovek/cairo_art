<?php
include 'drawing_window.php';

class CantorDust extends FractalDrawingWindow {

  public function getName() {
    return "Cantor dust fractal";
  }

  protected function onDraw($context){
    $context->setSourceRgb(0.8118, 0.7137, 0.2275);
    $this->draw($context,$this->recursionDepth, 0, 0, $this->get_size()[0], floatval($this->get_size()[1]) / $this->recursionDepth);
  }

  public function draw($context,$level, $posX, $posY, $sizeX, $sizeY){

    if($level == 0){
      return;
    }

    // calc new sizes and pos
    $newSizeX = $sizeX / 3;
    $newPosX = $posX + 2 * $newSizeX;

    // draw first line
    $context->rectangle($posX,$posY,$newSizeX,$sizeY);
    $context->fill();

    // draw second line
    $context->rectangle($newPosX,$posY,$newSizeX,$sizeY);
    $context->fill();

    // next calls
    $this->draw($context, $level - 1, $posX, $posY + $sizeY, $newSizeX, $sizeY);
    $this->draw($context, $level - 1, $newPosX, $posY + $sizeY, $newSizeX, $sizeY);
  }
}

$fractal = new CantorDust();
$fractal->setRecursionDepth(15);
Gtk::main();
?>
