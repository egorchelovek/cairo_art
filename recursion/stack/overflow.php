<?php

// Infinite recursion sample
function foo(){
  return foo();
}

foo();

?>
