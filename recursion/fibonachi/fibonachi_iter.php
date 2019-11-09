<?php

// Fibonachi iterative algorithm

function F($n){
  $i=1; $r=1; $l=1; $s=1;
  while($i++<$n){
    $s=$l+$r;
    $l=$r;
    $r=$s;
  }
  return $s;
}

// Test
$start = microtime(true);
echo F(30);
echo "\n";
echo microtime(true)-$start;
echo "\n";
?>
