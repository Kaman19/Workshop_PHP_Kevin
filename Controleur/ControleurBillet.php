<?php

require_once 'Modele/modele.php';
require_once 'Vue/Vue.php';

class ControleurBillet {

  private $billet;
  private $commentaire;

  public function __construct() {
    $this->billet = new Modele();
  }

  // Affiche les détails sur un billet
  public function billet($idBillet) {
    $billet = $this->billet->getBillet($idBillet);
    $vue = new Vue("Billet");
    $vue->generer(array('billet' => $billet));
  }
}