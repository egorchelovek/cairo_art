<?php

// Fibonachi recursive algorithm
// with
// Bottom-Up Dynamic Programming and
// Object Oriented Programming features

class Fibonachi {
  private $K;

  private function F_recursive($n){
  if($n<=1) {
  	return 1;
  } elseif ($this->K[$n] == 0) {
  	$this->K[$n]=$this->F_recursive($n-1,$this->K) + $this->F_recursive($n-2,$this->K);
  }
  return $this->K[$n];
  }

  // Interface
  public function getNumberByIndex($n){
    $this->K=array_fill(0,$n+1,0);
    return $this->F_recursive($n);
  }
}

function F($n){
  $Fibonachi = new Fibonachi();
  return $Fibonachi->getNumberByIndex($n);
}

// Test
$start = microtime(true);
echo F(30);
echo "\n";
echo microtime(true)-$start;
echo "\n";
?>
