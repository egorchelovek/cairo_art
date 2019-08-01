<?php

// Fibonachi recursive algorithm
// with Bottom-Up Dynamic Programming feature

function F_recursive($n, $K){
	if($n<=1) {
		return 1;
	} elseif ($K[$n] == 0) {
		$K[$n]=F_recursive($n-1,$K) + F_recursive($n-2,$K);
	}
	return $K[$n];
}

function F($n){
	$K=array_fill(0,$n+1,0);
	return F_recursive($n,$K);
}

// Test
$start = microtime(true);
echo F(30);
echo "\n";
echo microtime(true)-$start;
echo "\n";
?>
