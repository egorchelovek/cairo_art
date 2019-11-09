<?php
include 'drawing_window.php';

require_once 'mandelbrot_set.php';
require_once 'julia_set.php';
require_once 'newton_fractal.php';
require_once 'nova_fractal.php';
require_once 'rational_map.php';
require_once 'glynn_fractal.php';

class FractalDrawer extends FractalDrawingWindow {

  private static $types = array();
  private static $progress = 0.0;

  public function FractalDrawer(){
    $this->registerFractals();
    parent::__construct();
  }

  public function registerFractals(){
    self::$types = array(
      new MandelbrotSet(),
      new JuliaSet(),
      new NewtonFractal(),
      new NovaFractal(),
      new RationalMap(),
      new GlynnFractal()
    );
  }

  public function getRegisteredFractals(){
    if(self::$types == null){
      $this->registerFractals();
    }
    return self::$types;
  }

  public function getFractal(){
    return $this->getRegisteredFractals()[$this->ftype];
  }

  public function getName() {
    return $this->getFractal()->getTypeName()." fractal";
  }

  public function getState(){
    return $this->progress;
  }

  protected function onDraw($context){
    $this->progress = 0.0;

    $width = floatval($this->get_size()[0]);
    $height = floatval($this->get_size()[1]);
    $div = $width;
    if($height < $width) $div = $height;
    $div = 1./($div*$this->scale);
    $scale = 1./$this->scale;
    $depth = 128;
    $maxin = 255;
    $coef = floatval($maxin + 1)/ $depth;


    $bytes = array($height*$width*4);
    for($y = 0.; $y < $height; $y++){
      $this->progress = $y / $height;
      for($x = 0.; $x < $width; $x++){
        $val = $this->getFractal()->getValue($x*$div + $this->centerX*$scale,$y*$div + $this->centerY*$scale, $depth);
        if($val != $depth) $val *= $coef;
        else $val = $maxin;
        for($k = 0; $k < 4; $k++){
          $bytes[$y*$width*4+$x*4+$k] =  $val;
        }
      }
    }
    $str_surface=implode(array_map("chr",$bytes));
    $surface = cairo_image_surface_create_for_data($str_surface, CAIRO_FORMAT_RGB24  , $width, $height);
    $context->setSourceSurface($surface);
    $context->paint();

    $this->progress = 1.0;
  }
}

$fractalDrawer = new FractalDrawer();
Gtk::main();
?>
