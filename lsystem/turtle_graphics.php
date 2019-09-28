<?php

include 'colors.php';

// make python-like turtle interface
interface TurtleInterface {
  public function forward($distance);
  public function backward($distance);
  public function right($angle);
  public function left($angle);
  public function setposition($x,$y);
  public function setheading($angle);
  public function home();

  public function penup();
  public function pendown();
  public function pensize($width);
  public function color($name);

  public function position();
  public function heading();

  // unusual fun
  public function setcolor($rgb);
  public function getpensize();
  public function getcolor();
}

class Turtle implements TurtleInterface {
  private $context = NULL;
  private $angle = 3.14;
  private $x = 0;
  private $y = 0;
  private $size = 0;
  private $c = NULL;

  // main drawing functions
  private function turnRightLeft($angle){
    $this->angle += $angle;
  }

  private function moveForwardBackward($distance){
    $this->x += $distance * sin($this->angle);
    $this->y += $distance * cos($this->angle);

    $this->context->lineTo($this->x,$this->y);
    $this->context->stroke();
    $this->context->moveTo($this->x,$this->y);
  }

  private function moveUpDown($direction){
    if ($direction == 'Up') {
      $this->context->setLineWidth(0);
    } else {
      $this->context->setLineWidth($this->size);
    }
  }

  private function moveToPostion($x, $y){
    $this->x = $x;
    $this->y = $y;

    $this->context->moveTo($this->x, $this->y);
  }

  private function setSize($width){
    $this->size = $width;

    $this->context->setLineWidth($this->size);
  }

  // init function (doesn't work without it)
  public function setContext($context){
    $this->context = $context;
  }

  // interface functions links
  public function forward($distance){
    $this->moveForwardBackward($distance);
  }
  public function backward($distance){
    $this->moveForwardBackward(-$distance);
  }
  public function right($angle){
    $this->turnRightLeft($angle);
  }
  public function left($angle){
    $this->turnRightLeft(-$angle);
  }
  public function setposition($x,$y){
    $this->moveToPostion($x,$y);
  }
  public function setheading($angle){
    $this->angle = $angle;
  }
  public function home(){
    $this->moveToPostion(0,0);
  }

  public function penup(){
    $this->moveUpDown('Up');
  }
  public function pendown(){
    $this->moveUpDown('Down');
  }
  public function pensize($width){
    $this->setSize($width);
  }
  public function color($name){
    $this->c = get_color($name);
    $this->context->setSourceRgb($this->c[0], $this->c[1], $this->c[2]);
  }

  public function position(){
    return array($this->x,$this->y);
  }
  public function heading(){
    return $this->angle;
  }

  public function setcolor($rgb){
    $this->c = $rgb;
    $this->context->setSourceRgb($this->c[0], $this->c[1], $this->c[2]);
  }
  public function getpensize(){
    return $this->size;
  }
  public function getcolor(){
    return $this->c;
  }
}
