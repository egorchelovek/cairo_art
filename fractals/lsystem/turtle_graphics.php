<?php

include 'colors.php';

/*
Sea ASCII Turtle looks very pretty

                _,.---.---.---.--.._
            _.-' `--.`---.`---'-. _,`--.._
           /`--._ .'.     `.     `,`-.`-._\
          ||   \  `.`---.__`__..-`. ,'`-._/
     _  ,`\ `-._\   \    `.    `_.-`-._,``-.
  ,`   `-_ \/ `-.`--.\    _\_.-'\__.-`-.`-._`.
 (_.o> ,--. `._/'--.-`,--`  \_.-'       \`-._ \
  `---'    `._ `---._/__,----`           `-. `-\
            /_, ,  _..-'                    `-._\
            \_, \/ ._(
             \_, \/ ._\
              `._,\/ ._\
                `._// ./`-._
                  `-._-_-_.-'

taked from source: http://turtle.ascii.uk/
*/

// Declare
interface TurtleInterface {
  public function forward($distance); // move forward
  public function backward($distance); // move backward
  public function right($angle); // turn right
  public function left($angle); // turn left
  public function setposition($x,$y); // set turtle postion
  public function setheading($angle); // set turtle orientation angle
  public function home(); // return turle to home (0,0)

  public function penup(); // after that turtle moves don't track on canvas
  public function pendown(); // after that turtle moves StarTrack on canvas
  public function pensize($width); // set turtle drawing size
  public function color($name); // set turtle drawing color

  public function position(); // get turtle follow position
  public function heading(); // get turtle follow orientation

  // unusual fun (absent in python turtle common lib)
  public function setcolor($rgb); // set color by rgb values
  public function getpensize(); // get turtle follow drawing size
  public function getcolor(); // get turtle follow drawing color
}

// Simple Cairo-context wrapping class
class Turtle implements TurtleInterface {

  private $context = NULL; // our Cairo-context for drawing
  private $angle = M_PI; // follow angle
  private $x = 0; // follow x-coordinate
  private $y = 0; // follow  y-coordinate
  private $size = 0; // drawing line width
  private $c = NULL; // drawing color

  // init function (doesn't work without it)
  public function setContext($context){
    $this->context = $context;
  }

  /*
   *  Main drawing functions
   */
  // turn turtle by degree in radians
  private function turnRightLeft($angle){
    $this->angle += $angle;
  }

  // turtle forward, turtle backward
  private function moveForwardBackward($distance){
    $this->x += $distance * sin($this->angle);
    $this->y += $distance * cos($this->angle);

    $this->context->lineTo($this->x,$this->y);
    $this->context->stroke();
    $this->context->moveTo($this->x,$this->y);
  }

  // turtle up, turtle down
  private function moveUpDown($direction){
    if ($direction == 'Up') {
      $this->context->setLineWidth(0);
    } else {
      $this->context->setLineWidth($this->size);
    }
  }

  // place turtle to position
  private function moveToPostion($x, $y){
    $this->x = $x;
    $this->y = $y;

    $this->context->moveTo($this->x, $this->y);
  }

  // set drawing line width
  private function setSize($width){
    $this->size = $width;

    $this->context->setLineWidth($this->size);
  }

  /*
   * Interface functions links (look up interace to understanding)
   */
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
?>
