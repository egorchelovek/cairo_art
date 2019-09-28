<?php

include 'drawing_window.php';
include 'turtle_graphics.php';
include 'lsystem_gene.php';

/*
 * Main class
 */
class LSystem extends FractalDrawingWindow {

  private $turtle = NULL;
  private $generator = NULL;

  private $angle = 0;
  private $step = 0;
  private $width = 0;
  private $color = NULL;

 function __construct($grammar, $depth, $step, $width, $color){
   parent::__construct();

   $this->angle = deg2rad($grammar['angle']);
   $this->step = $step;
   $this->width = $width;
   $this->color = $color;

   $this->generator = new LSystemGenerator($grammar['axiom'], $grammar['rules'], $depth);
 }

 public function getName() {
   return "L-System fractal";
 }

 protected function onDraw($context){
   $width = $this->get_size()[0];
   $height = $this->get_size()[1];

   $this->turtle = new Turtle();
   $this->turtle->setContext($context);
   $this->turtle->setposition($width/2, 3*$height/4);
   $this->turtle->pensize($this->width);
   $this->turtle->color($this->color); // standart

   $this->draw($this->turtle, $this->generator->gen(), $this->angle, $this->step);
 }

 public function draw($turtle, $model, $angle, $step){
   $repeat = 1.0;
   $reduce0 = 0.85;
   $reduce1 = 0.33;
   $stack = array();
   foreach(str_split($model) as $alpha){
     switch($alpha){
       case 'F':
       case 'G':
       case 'R':
       case 'L':
        $turtle->forward($step);
        break;
       case 'f':
        $turtle->penup();
        $turtle->forward($step);
        break;
       case '+':
        $turtle->left($angle * $repeat);
        $repeat = 1.0;
        break;
       case '-':
        $turtle->right($angle * $repeat);
        $repeat = 1.0;
        break;
       case '[':
        array_push($stack,array($turtle->position(), $turtle->heading(), $step));
        break;
       case ']':
        $turtle->penup();
        $ph = array_pop($stack);
        $turtle->setposition($ph[0][0], $ph[0][1]);
        $turtle->setheading($ph[1]);
        $step = $ph[2];
        break;
       case '@':
        $step *= $reduce0;
        break;
       case '#':
        $step *= $reduce1;
        break;
       case '6':
       case '7':
        $repeat = deg2rad(intval($alpha,8) - 48) * 10;
        break;
     }
     $turtle->pendown();
   }
 }
}
?>
