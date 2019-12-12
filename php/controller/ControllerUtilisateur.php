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
    	$login=myGet('login');
    	$nom=myGet('nom');
    	$prenom=myGet('prenom');
        $mdp=myGet('mdp');
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
        $login=myGet('id');
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
        $id=myGet("id");

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
        if(Session::is_user(myGet('login')) || Session::is_admin()){
            $admin=0;
            if(!is_null(myGet("admin")) && Session::is_admin()){
                $admin=1;
            }
            $controller='utilisateur'; $view='updated'; $pagetitle='mise à jour de utilisateur';     //appel au modèle pour gerer la BD
            $data=array(
            "login"=>myGet('login'),
            "nom"=>myGet('nom'),
            "prenom"=>myGet('prenom'),
            "mdp"=>Security::chiffrer(myGet('mdp')),
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
        if(ModelUtilisateur::checkPassword(myGet("login"),myGet("mdp"))){
            $v = ModelUtilisateur::select(myGet("login"));
            if(is_null($v->getNonce())){
                $_SESSION["login"] = myGet("login");
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
        $u=ModelUtilisateur::select(myGet("login"));
        if($u!=false){
            $u->setNonce();
            ModelUtilisateur::update($u->getTab());
        }
    }
}
?>

