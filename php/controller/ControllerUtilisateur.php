<?php
require_once File::build_path('model/ModelUtilisateur.php'); // chargement du modèle
require_once File::build_path('lib/Security.php');
class ControllerUtilisateur {

    protected static $object="utilisateur";

    public static function readAll() {
        $tab_v = ModelUtilisateur::selectAll();
        $controller='utilisateur'; $view='list'; $pagetitle='Liste des utilisateur';     //appel au modèle pour gerer la BD
        require File::build_path('view/view.php');  //"redirige" vers la vue
    }

    public static function Read(){
    	$v=ModelUtilisateur::select($_GET['id']);
    	if($v==false){
        $controller='utilisateur'; $view='error'; $pagetitle='erreur';     //appel au modèle pour gerer la BD
        require File::build_path('view/view.php');  //"redirige" vers la vue
    	}else{      
        $controller='utilisateur'; $view='details'; $pagetitle='les d\'etails';     //appel au modèle pour gerer la BD
        require File::build_path('view/view.php');  //"redirige" vers la vue
	    }
    }

    public static function create(){  
        $v=new ModelUtilisateur("","","","");
        $isUpdate=false;
        $controller='utilisateur'; $view='update'; $pagetitle='creation de utilisateur';
        require File::build_path('view/view.php');  //"redirige" vers la vue
    }

    public static function created(){
    	$login=$_GET['login'];
    	$nom=$_GET['nom'];
    	$prenom=$_GET['prenom'];
        $mdp=$_GET['mdp'];
 		$v=new Modelutilisateur($login,$nom,$prenom,Security::chiffrer($mdp));
 		$v->save();
        $controller='utilisateur'; $view='created'; $pagetitle='cree';     //appel au modèle pour gerer la BD
        $tab_v = Modelutilisateur::selectAll();
        require File::build_path('view/view.php');  
    }

    public static function delete(){
        $login=$_GET['id'];
        Modelutilisateur::delete($login);
        $tab_v=Modelutilisateur::selectAll();
        $controller='utilisateur'; $view='deleted'; $pagetitle='supprimé';     //appel au modèle pour gerer la BD
        require File::build_path('view/view.php');  
    }

    public static function update(){
        $id=$_GET["id"];
        $v=ModelUtilisateur::select($id);
        $isUpdate=true;
        $controller='utilisateur'; $view='update'; $pagetitle='mise à jour de utilisateur';     //appel au modèle pour gerer la BD
        require File::build_path("view/view.php");  //"redirige" vers la vue
    }


    public static function updated(){
        $controller='utilisateur'; $view='updated'; $pagetitle='mise à jour de utilisateur';     //appel au modèle pour gerer la BD
        $data=array(
        "login"=>$_GET['login'],
        "nom"=>$_GET['nom'],
        "prenom"=>$_GET['prenom'],
        "mdp"=>Security::chiffrer($_GET['mdp'])
        );
        ModelUtilisateur::update($data);
        $tab_v = ModelUtilisateur::selectAll();
        require File::build_path("view/view.php");  //"redirige" vers la vue
    }

    public static function error(){
        $controller='utilisateur'; $view='error'; $pagetitle='erreur';     //appel au modèle pour gerer la BD
        require File::build_path("view/view.php");  //"redirige" vers la vue        
    }

    public static function connect(){
        $controller="utilisateur"; $view="connect"; $pagetitle="connectez vous";
        require File::build_path("view/view.php");
    }

    static function connected(){
        if(ModelUtilisateur::checkPassword($_GET["login"],$_GET["mdp"])){
            $_SESSION["login"]=$_GET["login"];
            $v = ModelUtilisateur::select($_GET["login"]);
            $controller='utilisateur'; $view='details'; $pagetitle='Liste des utilisateur';     //appel au modèle pour gerer la BD
            require File::build_path('view/view.php');  //"redirige" vers la vue
        }
        else{
            echo ("MAUVAIS LOGIN OU MDP");
        }
    }

    static function disconnect(){
        session_unset();
        session_destroy();
        $tab_v = ModelUtilisateur::selectAll();
        $controller='utilisateur'; $view='list'; $pagetitle='Liste des utilisateur';     //appel au modèle pour gerer la BD
        require File::build_path('view/view.php');  //"redirige" vers la vue
    }
}
?>

