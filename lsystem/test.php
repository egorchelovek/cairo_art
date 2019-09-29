
<?php
include 'grammars.php';
include 'lsystem.php';

$name = 'island';
$grammar = get_grammar('islands&lakes');
$depth =2;
$step = 5; // px

// $name = 'yarrow';
// $grammar = get_grammar($name);
// $depth = 5;
// $step = 7;

$width = 1;
$color = 'blue';

$ls = new LSystem($grammar, $depth, $step, $width, $color);
$ls->setName($name);
 Gtk::main();
?>
