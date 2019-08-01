<?php
  class TowersGen{
    private $s;

    function TowersGen(){
      $this->s = "";
    }

    private function towers($n, $a, $c, $b){
      if($n==1){
        $this->s .= $a."->".$c." ";
      } else {
        $this->towers($n-1,$a,$b,$c);
        $this->s .= $a."->" .$c." ";
        $this->towers($n-1,$b,$c,$a);
      }
    }

    function getSequence($n){
      $this->s = "";
      $this->towers($n, "A", "C", "B");
      return $this->s;
    }
  }
 ?>
