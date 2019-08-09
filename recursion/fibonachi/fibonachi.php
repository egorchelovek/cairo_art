<?php

// Fibonachi recursive algorithm

function F($n){
	if($n<=1){
		return 1;
	}
	return F($n-1)+F($n-2);
}

// Test
$start = microtime(true);
echo F(5);
echo "\n";
echo microtime(true)-$start;
echo "\n"
?>
