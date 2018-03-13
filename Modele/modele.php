  <?php

class Modele{
  //Logique
    
    private $bdd;
        
       public function getBillets(){

         $bdd = 'select BIL_ID as id, BIL_DATE as date,'
      . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
      . ' order by BIL_ID desc';

          $billets = $this->executerRequete($bdd);

          return $billets;
      }


     public function getBillet($idBillet){

         $bdd = 'select BIL_ID as id, BIL_DATE as date,'
      . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
      . ' where BIL_ID=?';

          $billetId =$this->executerRequete($bdd, array($idBillet));
          if ($billetId->rowCount() == 1)
            return $billetId->fetch();  // Accès à la première ligne de résultat
          else
            throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
         
      }



     private function connectBdd(){

             return new PDO('mysql:host=localhost;dbname=myblog;charset=utf8', 
            'Ludus', 'Ludus',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


      }
    
    private function executerRequete($bdd, $params = null) {
    if ($params == null) {
      $resultat = $this->connectBdd()->query($bdd);    // exécution directe
    }
    else {
      $resultat = $this->connectBdd()->prepare($bdd);  // requête préparée
      $resultat->execute($params);
    }
    return $resultat;
  }
}

?>