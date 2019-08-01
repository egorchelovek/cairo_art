<?php

include 'towers_gen.php';

class TowerState{
  public $S;
  public $top;

  function TowerState($n, $void){
    $this->S = array_fill(0,$n,0);
    $this->top = 0;
    if($void != true){
      for($i = 0; $i < $n; $i++){
        $this->S[$i]= $n - $i;
      }
      $this->top = $n;
    }
  }
}

class TowersStates{
  // states
  public $A;
  public $B;
  public $C;

  function TowersStates($n){
    $this->A = new TowerState($n, false);
    $this->B = new TowerState($n, true);
    $this->C = new TowerState($n, true);
  }

  public function __clone() {
    $this->A = clone $this->A;
    $this->B = clone $this->B;
    $this->C = clone $this->C;
  }
}

class TowersStatesParser{
  private $FollowState;
  private $StatesHistory;

  private function Move($s){
    // parse towers labels
    $arg1 = substr($s,0,1);
    $arg2 = substr($s,3,1);

    // make move
    $idx1 =& $this->FollowState->{$arg1}->top;
    $idx2 =& $this->FollowState->{$arg2}->top;
    $this->FollowState->{$arg2}->S[$idx2]=$this->FollowState->{$arg1}->S[$idx1 - 1]; $idx2++;
    $this->FollowState->{$arg1}->S[$idx1 - 1]=0; $idx1--;
  }

  public function getHistory($s,$n){
    // parse commands
    $s_arr = explode(" ", $s);
    $k = sizeof($s_arr) - 1;

    // allocate towers
    $this->FollowState = new TowersStates($n);
    $this->StatesHistory = array();
    array_push($this->StatesHistory,clone $this->FollowState);

    // doing operations
    for($i = 0; $i < $k; $i++){
      $this->Move($s_arr[$i]); // follow state changes
      // save state to history
      array_push($this->StatesHistory,clone $this->FollowState);
    }

    return $this->StatesHistory;
  }
}


// Test
$n = 4;
$tsp = new TowersStatesParser();
$gen = new TowersGen();
$sh = $tsp->getHistory($gen->getSequence($n),$n); // maybe to draw
print_r($sh);

 ?>
