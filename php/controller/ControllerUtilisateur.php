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
        $v=new ModelUtilisateur("","","","","","");
        $isUpdate=false;
        $controller='utilisateur'; $view='update'; $pagetitle='creation de utilisateur';
        require File::build_path('view/view.php');  //"redirige" vers la vue
    }

    public static function created(){
    	$login=$_GET['login'];
    	$nom=$_GET['nom'];
    	$prenom=$_GET['prenom'];
        $mdp=$_GET['mdp'];
        if(!filter_var($login, FILTER_VALIDATE_EMAIL)){
            $v=new ModelUtilisateur("","","","","","");
            $isUpdate=false;
            $controller='utilisateur'; $view='update'; $pagetitle='creation de utilisateur';
            require File::build_path('view/view.php');  //"redirige" vers la vue
        }else{
            $random=Security::generateRandomHex();
     		$v=new Modelutilisateur($login,$nom,$prenom,Security::chiffrer($mdp),0,$random);
     		$v->save();
            $mail="http://webinfo.iutmontp.univ-montp2.fr/~abecassist/PHP/TD8/index.php?action=validate&controller=utilisateur&nonce=".$random."&login=".$v->getLogin();
            mail($login,"activation de votre compte",$mail);
            $controller='utilisateur'; $view='created'; $pagetitle='cree';     //appel au modèle pour gerer la BD
            $tab_v = Modelutilisateur::selectAll();
            require File::build_path('view/view.php');  
        }
    }

    public static function delete(){
        $login=$_GET['id'];
        if(Session::is_user($login) || Session::is_admin()){
            Modelutilisateur::delete($login);
            $tab_v=Modelutilisateur::selectAll();
            $controller='utilisateur'; $view='deleted'; $pagetitle='supprimé';     //appel au modèle pour gerer la BD
            require File::build_path('view/view.php');   
        }
        else{
            $controller='utilisateur'; $view='connect'; $pagetitle='mise à jour de utilisateur';     //appel au modèle pour gerer la BD
            require File::build_path("view/view.php");  //"redirige" vers la vue  
        }

    }

    public static function update(){
        $id=$_GET["id"];

        if(Session::is_user($id) || Session::is_admin()){
            $v=ModelUtilisateur::select($id);
            $isUpdate=true;
            $controller='utilisateur'; $view='update'; $pagetitle='mise à jour de utilisateur';     //appel au modèle pour gerer la BD
            require File::build_path("view/view.php");  //"redirige" vers la vue
        }else{
            $controller='utilisateur'; $view='connect'; $pagetitle='mise à jour de utilisateur';     //appel au modèle pour gerer la BD
            require File::build_path("view/view.php");  //"redirige" vers la vue
        }

    }


    public static function updated(){
        if(Session::is_user($_GET['login']) || Session::is_admin()){
            $admin=0;
            if(isset($_GET["admin"]) && Session::is_admin()){
                $admin=1;
            }
            $controller='utilisateur'; $view='updated'; $pagetitle='mise à jour de utilisateur';     //appel au modèle pour gerer la BD
            $data=array(
            "login"=>$_GET['login'],
            "nom"=>$_GET['nom'],
            "prenom"=>$_GET['prenom'],
            "mdp"=>Security::chiffrer($_GET['mdp']),
            "admin"=>$admin
            );
            ModelUtilisateur::update($data);
            $tab_v = ModelUtilisateur::selectAll();
            require File::build_path("view/view.php");  //"redirige" vers la vue
        }
        else{
            $controller='utilisateur'; $view='connect'; $pagetitle='mise à jour de utilisateur';     //appel au modèle pour gerer la BD
            require File::build_path("view/view.php");  //"redirige" vers la vue
        }

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
            $v = ModelUtilisateur::select($_GET["login"]);
            if(is_null($v->getNonce())){
                $_SESSION["login"] = $_GET["login"];
                $_SESSION["admin"] = true;
            }
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

    static function validate(){
        $u=ModelUtilisateur::select($_GET["login"]);
        if($u!=false){
            $u->setNonce();
            ModelUtilisateur::update($u->getTab());
        }
    }
}
?>

