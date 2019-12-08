<?php

require_once File::build_path('model/Model.php');
require_once File::build_path('lib/Security.php');

class ModelUtilisateur extends Model{

  protected static $object = "utilisateur";
  protected static $primary='login';

public function __construct($l = NULL, $n = NULL, $p = NULL, $m = NULL) {
  if (!is_null($l) && !is_null($n) && !is_null($p) && !is_null($m)) {
    // Si aucun de $m, $c et $i sont nuls,
    // c'est forcement qu'on les a fournis
    // donc on retombe sur le constructeur à 3 arguments
    $this->login = $l;
    $this->nom = $n;
    $this->prenom = $p;
    $this->mdp = $m;
  }
}

public function getLogin(){
  return $this->login;
}

public function getNom(){
  return $this->nom;
}

public function getPrenom(){
  return $this->prenom;
}

public function getMdp(){
  return $this->mdp;
}

public function getTab(){
  $data=array(
    "login"=>$this->login,
   "nom"=>$this->nom,
    "prenom"=>$this->prenom,
    "mdp"=>$this->mdp
  );
  return $data;
}

static public function checkPassword($login,$mdp){
  $u=ModelUtilisateur::select($login);
  if($u==false){
    return $u;
  }
  if(strcmp($u->getMdp(),Security::chiffrer($mdp))==0){
    return true;
  }
  return false;
}


}
?>

