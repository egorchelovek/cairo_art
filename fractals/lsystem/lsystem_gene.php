<?php
/*
 * Generator of L-System
 */
class LSystemGenerator {
  private $axiom = ''; // initial string (initiator)
  private $rules = NULL; // some kind of symbos replacing rules
  private $depth = 0; // recursion depth equivalent
  private $G = ''; // output grammar string

  // simple constructor
  public function LSystemGenerator($axiom, $rules, $depth){
    $this->setAxiom($axiom);
    $this->setRules($rules);
    $this->setDepth($depth);
  }

  // set start axiom
  public function setAxiom($axiom){
    $this->axiom = $axiom;
  }

  // just set rules array
  public function setRules($rules){
    $this->rules = $rules;
  }

  // recursion depth equivalent
  public function setDepth($depth){
    $this->depth = $depth;
  }

  // main function
  public function gen(){
    $this->G = $this->axiom;
    for($i = 0; $i < $this->depth; $i++){
      $NG = '';
      foreach (str_split($this->G) as $alpha){
        $NG .= $this->rule($alpha);
      }
      $this->G = $NG;
    }
    return $this->G;
  }

  // get the rule the from follow symbol
  private function rule($alpha){
    if (array_key_exists($alpha, $this->rules)){
      return $this->rules[$alpha];
    }
    return $alpha;
  }
}

// Test (uncomment)
// some kind of bush
// $axiom = 'X';
// $rules = array(
//   'X' => 'F-[[X]+X]+F[+FX]-X',
//   'F' => 'FF',
// );
// $depth = 5;
// $lsys_gene = new LSystemGenerator($axiom, $rules, $depth);
// $model = $lsys_gene->gen();
// echo $model;
?>
