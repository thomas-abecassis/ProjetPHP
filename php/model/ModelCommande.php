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

public function getDate(){
  return $this->date;
}

public function getPrix(){
  return $this->prix;
}

public function getStatus(){
  $dateNow=new DateTime("now");
  $date=new DateTime($this->date);
  $diff=$date->diff($dateNow)->format("%a");
  if(strcmp($diff,"0")==0){
    return "en préparation";
  }
  if(strcmp($diff,"1")==0){
    return "Chez notre transporteur";
  }
  if(strcmp($diff,"2")==0){
    return "En cours de livraison";
  }
  return "livré"; 
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

      return $autoI;
  }

public static function getCommandesByLogin($login){
    $sql = "SELECT * from commande WHERE idUtilisateur=:nom_tag";
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);

    $values = array(
        "nom_tag" => $login,
        //nomdutag => valeur, ...
    );
    // On donne les valeurs et on exécute la requête   
    $req_prep->execute($values);

    // On récupère les résultats comme précédemment
    $req_prep->setFetchMode(PDO::FETCH_OBJ);
    $tab_commande_obj = $req_prep->fetchAll();
    $tab_commande = array();
    $commandeM=null;
    foreach($tab_commande_obj as $commande){
      $commandeM=new ModelCommande($commande->idUtilisateur,$commande->id,0,$commande->prix,$commande->dateCommande);
      array_push($tab_commande,$commandeM);
    }
    // Attention, si il n'y a pas de résultats, on renvoie false
    if (empty($tab_commande))
      return false;
    return $tab_commande;
  }


public static function getProduitsByCommandeId($id){
    require_once File::build_path('model/ModelProduit.php');
    $sql = "SELECT * from commandeProduit WHERE idCommande=:nom_tag";
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);

    $values = array(
        "nom_tag" => $id,
        //nomdutag => valeur, ...
    );
    // On donne les valeurs et on exécute la requête   
    $req_prep->execute($values);

    // On récupère les résultats comme précédemment
    $req_prep->setFetchMode(PDO::FETCH_OBJ);
    $tab_produit_obj = $req_prep->fetchAll();
    $tab_produit = array();
    foreach($tab_produit_obj as $produit){
      array_push($tab_produit,ModelProduit::select($produit->idProduit));
    }
    // Attention, si il n'y a pas de résultats, on renvoie false
    if (empty($tab_produit))
      return false;
    return $tab_produit;
}



}
?>

