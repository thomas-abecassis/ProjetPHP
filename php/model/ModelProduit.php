<?php

require_once 'Model.php';

class ModelProduit {
   
  private $idProduit;
  private $nom;
  private $image;
  private $prix;
      
  // un getter
  public function getId(){
  	return $this->idProduit;
  }


  public function getNom() {
       return $this->nom;  
  }
     
  // un setter 
  public function setNom($nom) {
       $this->nom = $nom;
  }

  public function getImage(){
    return $this->image;
  }

  public function setImage($image){
    $this->image=$image;
  }

  public function getPrix(){
    return $this->prix;
  }

  public function setPrix($prix){
    if($prix>0){
    $this->prix=$prix; 
    }
    else{
      echo"oupsi"; 
    }
  }
      
public function __construct($n = NULL, $i = NULL, $p = NULL, $id = NULL) {
  if (!is_null($n) && !is_null($i) && !is_null($p) && !is_null($id)) {
    // Si aucun de $m, $c et $i sont nuls,
    // c'est forcement qu'on les a fournis
    // donc on retombe sur le constructeur à 3 arguments
    $this->id=$id;
    $this->nom = $n;
    $this->image = $i;
    $this->prix = $p;
  }
}

public static function getAllProduits(){
  $rep=Model::$pdo->query('select * from Produit');
  return $rep->fetchAll(PDO::FETCH_CLASS, 'ModelProduit');
}


           
  /* une methode d'affichage.
  public function afficher() {
    echo "Voiture $this->immatriculation de marque $this->marque (couleur $this->couleur)";
  }*/
  
  public function save(){
      $sql="INSERT INTO Produit  VALUES ( '$this->nom' , '$this->image' , '$this->prix' )";
      Model::$pdo->exec($sql);
  }
  
  public static function getProduitById($id) {
    $sql = "SELECT * from Produit WHERE idProduit=:nom_tag";
    // Préparation de la requête
    $req_prep = Model::$pdo->prepare($sql);

    $values = array(
        "nom_tag" => $id,
        //nomdutag => valeur, ...
    );
    // On donne les valeurs et on exécute la requête	 
    $req_prep->execute($values);

    // On récupère les résultats comme précédemment
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
    $tab_voit = $req_prep->fetchAll();
    // Attention, si il n'y a pas de résultats, on renvoie false
    if (empty($tab_voit))
        return false;
    return $tab_voit[0];
}

}
?>

