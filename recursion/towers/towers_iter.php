<?php
  function towers($n, $a, $c, $b){

    $totalMoves = pow(2,$n) - 1;

    // if($n % 2 == 0){
    //   $d = $b;
    //   $b = $c;
    //   $c = $d;
    // }

    for($i = 1; $i <= $totalMoves; $i++){
      $j = $i % 3;
      switch ($j) {
        case 1:
          echo $a,"<>",$c," ";
          break;
        case 2:
          echo $a,"<>",$b," ";
          break;
        case 0:
          echo $b,"<>",$c," ";
          break;
      }
    }

  }

  towers(4, "A","C","B");
 ?>
