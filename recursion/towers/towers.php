<?php
  function towers($n, $a, $c, $b){
    if($n==1){
      echo $a,"->",$c," ";
    } else {
      towers($n-1,$a,$b,$c);
      echo $a,"->",$c," ";
      towers($n-1,$b,$c,$a);
    }
  }

  // Test
  $start = microtime(true);
  echo towers(4, "A","C","B");
  echo "\n";
  echo microtime(true)-$start;
  echo "\n"
 ?>
