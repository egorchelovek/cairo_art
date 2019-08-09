<?php
  class Tower{
    private $S; // tower state (which rings tower have)
    private $top; // index of void element above last
    public $name; // name of the tower

    function Tower($name, $n, $void){
      $this->S = array_fill(0,$n,0);
      $this->top = 0;
      $this->name = $name;

      // push rings different sizes
      if($void != true){
        for($i = 0; $i < $n; $i++){
          $this->S[$i]= $n - $i;
        }
        $this->top = $n;
      }
    }

    // function for introversion
    // function getState(){
    //   return $this->S;
    // }

    function getTop(){
      if($this->top == 0)
        return 0;
      return $this->S[$this->top - 1];
    }

    function isEmpty(){
      return $this->S[0] == 0;
    }

    function isFull(){
      return $this->S[sizeof($this->S) - 1] != 0;
    }

    // take ring in to the air
    function pop(){
      if(!$this->isEmpty()){
        $ring = $this->S[$this->top - 1];
        $this->S[$this->top - 1] = 0;
        $this->top--;
        return $ring;
      }
      return 0;
    }

    // put ring to the tower
    function push($ring){
      if(!$this->isFull()){
        $this->S[$this->top] = $ring;
        $this->top++;
      }
    }

    function toString(){
      print_r($this->S);
    }
  }

  function move($tower1, $tower2){
    if($tower1->isEmpty()){
      $tower1->push($tower2->pop());
      echo $tower2->name,"->",$tower1->name," ";

    } elseif($tower2->isEmpty()) {
      $tower2->push($tower1->pop());
      echo $tower1->name,"->",$tower2->name," ";

    } elseif($tower1->getTop() > $tower2->getTop()) {
      $tower1->push($tower2->pop());
      echo $tower2->name,"->",$tower1->name," ";

    } else {
      $tower2->push($tower1->pop());
      echo $tower1->name,"->",$tower2->name," ";
    }
  }

  function towers($n, $a, $c, $b){

    $towerA = new Tower($a, $n, false);
    $towerB = new Tower($b, $n, true);
    $towerC = new Tower($c, $n, true);

    $totalMoves = pow(2,$n) - 1;

    if($n % 2 == 0){
      $name = $towerB->name;
      $towerB->name = $towerC->name;
      $towerC->name = $name;
    }

    for($i = 1; $i <= $totalMoves; $i++){
      $j = $i % 3;
      switch ($j) {
        case 1:
          //echo $a,"<>",$c," ";
          move($towerA, $towerC);
          break;
        case 2:
          //echo $a,"<>",$b," ";
          move($towerA, $towerB);
          break;
        case 0:
          //echo $b,"<>",$c," ";
          move($towerB, $towerC);
          break;
      }
    }
  }

  // Test
  $start = microtime(true);
  echo towers(15, "A","C","B");
  echo "\n";
  echo microtime(true)-$start;
  echo "\n"
?>
