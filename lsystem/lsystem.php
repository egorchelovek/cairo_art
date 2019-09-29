<?php

include 'drawing_window.php';
include 'turtle_graphics.php';
include 'lsystem_gene.php';

/*
 * Main class
 */
class LSystem extends FractalDrawingWindow {

  // two main objects
  private $turtle = NULL;
  private $generator = NULL;

  // and four simple drawing parameters
  private $angle = 0;
  private $step = 0;
  private $width = 0;
  private $color = NULL;

 // override the constructor
 function __construct($grammar, $depth, $step, $width, $color){
   parent::__construct();

   // simple transfer parameters
   $this->angle = deg2rad($grammar['angle']);
   $this->step = $step;
   $this->width = $width;
   $this->color = $color;

   // create generator
   $this->generator = new LSystemGenerator($grammar['axiom'], $grammar['rules'], $depth);
 }

 // simple return window name
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

 // here we have class for interpret l-system grammar
 public function draw($turtle, $model, $angle, $step){

   // init constants
   $repeat = 1.0;
   $reduce0 = 0.85;
   $reduce1 = 0.33;

   // init stack
   $stack = array();

   // run interpreter
   foreach(str_split($model) as $alpha){ // loop for symbols
     switch($alpha){ // take symbol
       case 'F': // compare and run command
       case 'G':
       case 'R':
       case 'L':
        // make move
        $turtle->forward($step);
        break;

       case 'f':
        // make leap
        $turtle->penup();
        $turtle->forward($step);
        break;

       case '+':
        // turn left
        $turtle->left($angle * $repeat);
        $repeat = 1.0;
        break;

       case '-':
        // turn right
        $turtle->right($angle * $repeat);
        $repeat = 1.0;
        break;

       case '[':
        // push state to the stack (run brackets)
        array_push($stack,array($turtle->position(), $turtle->heading(), $step));
        break;

       case ']':
        // pop state from the stack (terminate brackets)
        $turtle->penup();
        $ph = array_pop($stack);
        $turtle->setposition($ph[0][0], $ph[0][1]);
        $turtle->setheading($ph[1]);
        $step = $ph[2];
        break;

       case '@':
        // reduce turtle moving step
        $step *= $reduce0;
        break;

       case '#':
        // the same thing above with other coef.
        $step *= $reduce1;
        break;

       case '6':
       case '7':
        // just calc another yet rotation coefficient
        $repeat = deg2rad(intval($alpha,8) - 48) * 10;
        break;
     }

     // and don't forget put turtle to the ground in the end of the turn
     $turtle->pendown();
   }
 }
}
?>
