<?php

require_once File::build_path('model/Model.php');
require_once File::build_path('lib/Security.php');

class ModelCommande extends Model{

  protected static $object = "commande";
  protected static $primary='id';

public function __construct($l = NULL, $i = NULL, $pr = NULL,$p = NULL,$d = NULL) {
  if (!is_null($l) && !is_null($i) && !is_null($pr) && !is_null($p) && !is_null($d)) {
    // Si aucun de $m, $c et $i sont nuls,
    // c'est forcement qu'on les a fournis
    // donc on retombe sur le constructeur à 3 arguments
    $this->id = $i;
    $this->loginUtilisateur = $l;
    $this->produits = $pr;
    $this->prix= $p;
    $this->date=$d;
  }
}

public function getLoginUtilisateur(){
  return $this->loginUtilisateur;
}

public function getId(){
  return $this->id;
}


 public function save(){

     $data=array(
      "idUtilisateur"=>$this->loginUtilisateur, 
      "dateCommande"=>$this->date,
      "prix"=>$this->prix
     );

      $sql = "INSERT INTO commande(idUtilisateur, prix, dateCommande) VALUES (:idUtilisateur, :prix,:dateCommande  )";

      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);

      $req_prep->execute($data);

      $sql="SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'abecassist' AND TABLE_NAME = 'commande'";
      
      $rep=Model::$pdo->query($sql);
      $autoI=$rep->fetchAll(PDO::FETCH_OBJ);
      $autoI=$autoI[0]->AUTO_INCREMENT-1;

      foreach($this->produits as $produit){
        $sql = "INSERT INTO commandeProduit VALUES (".$autoI.",\"".$produit->getId()."\")";
        $req_prep = Model::$pdo->exec($sql);
      }
  }



}
?>

