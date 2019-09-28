
<?php
include 'grammar.php';
include 'lsystem.php';

$grammar = get_grammar('fern');
$depth = 22;
$step = 101; // px

// $grammar = get_grammar('laminaria');
// $depth = 5;
// $step = 10;

$width = 1;
$color = 'green';

(new LSystem($grammar, $depth, $step, $width, $color))->fullscreen();
 Gtk::main();
?>
