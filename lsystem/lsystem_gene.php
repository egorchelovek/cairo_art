<?php
/*
 * Additional class of Generator of L-System
 */
class LSystemGenerator {
  private $axiom = '';
  private $rules = NULL;
  private $depth = 0;
  private $G = '';

  public function LSystemGenerator($axiom, $rules, $depth){
    $this->setAxiom($axiom);
    $this->setRules($rules);
    $this->setDepth($depth);
  }

  public function setAxiom($axiom){
    $this->axiom = $axiom;
  }

  public function setRules($rules){
    $this->rules = $rules;
  }

  public function setDepth($depth){
    $this->depth = $depth;
  }

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

  private function rule($alpha){
    if (array_key_exists($alpha, $this->rules)){
      return $this->rules[$alpha];
    }
    return $alpha;
  }
}

// Test
// $axiom = 'X';
// $rules = array(
//   'X' => 'F-[[X]+X]+F[+FX]-X',
//   'F' => 'FF',
// );
// $depth = 5;
//
// $lsys_gene = new LSystemGenerator($axiom, $rules, $depth);
// $model = $lsys_gene->gen();
// echo $model;
?>
