<?php

// Finite recursion sample
function foo($n){
  if($n < 1)
    return;
  return foo($n-1);
}

foo(100000);

?>
