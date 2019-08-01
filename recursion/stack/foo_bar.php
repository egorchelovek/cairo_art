<?php
// Complex infinite reqursion sample
function foo(){
  return bar();
}

function bar(){
  return foo();
}

foo();
?>
