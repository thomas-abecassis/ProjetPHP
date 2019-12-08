<?php

require_once File::build_path('model/Model.php');

class Modelproduit extends Model{
   
  private $id;
  private $nom;
  private $prix;
  protected static $object = "produit";
  protected static $primary='id';

      
  // un getter      
  public function getid() {
       return $this->id;  
  }
     
  // un setter 
  public function setid($id2) {
       $this->id = $id2;
  }

  public function getnom(){
    return $this->nom;
  }

  public function setnom($nom){
    $this->nom=$nom;
  }

  public function getprix(){
    return $this->prix;
  }

  public function setprix($prix){
    if(strlen($prix)==8){
    $this->prix=$prix; 
    }
    else{
      echo"oupsi"; 
    }
  }

  public function getTab(){
    $data=array(
      "id"=>$this->id,
     "nom"=>$this->nom,
      "prix"=>$this->prix
    );
    return $data;
  }
      
public function __construct($m = NULL, $c = NULL, $i = NULL) {
  if (!is_null($m) && !is_null($c) && !is_null($i)) {
    // Si aucun de $m, $c et $i sont nuls,
    // c'est forcement qu'on les a fournis
    // donc on retombe sur le constructeur à 3 arguments
    $this->id = $m;
    $this->nom = $c;
    $this->prix = $i;
  }
}

public static function getAllproduits(){
  $rep=Model::$pdo->query('select * from produit');
  return $rep->fetchAll(PDO::FETCH_CLASS, 'Modelproduit');
}


           
  /* une methode d'affichage.
  public function afficher() {
    echo "produit $this->prix de id $this->id (nom $this->nom)";
  }*/
  
  
  public static function getproduitByImmat($immat) {
    $sql = "SELECT * from produit WHERE prix=:nom_tag";
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);

    $values = array(
        "nom_tag" => $immat,
        //nomdutag => valeur, ...
    );
    // On donne les valeurs et on exécute la requête	 
    $req_prep->execute($values);

    // On récupère les résultats comme précédemment
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'produit');
    $tab_voit = $req_prep->fetchAll();
    // Attention, si il n'y a pas de résultats, on renvoie false
    if (empty($tab_voit))
        return false;
    return $tab_voit[0];
  }

  public static function deleteproduitByImmat($immat) {
    $sql = "DELETE from produit WHERE prix=:nom_tag";
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);

    $values = array(
        "nom_tag" => $immat,
        //nomdutag => valeur, ...
    );
    // On donne les valeurs et on exécute la requête   
    $req_prep->execute($values);

  }



}
?>

