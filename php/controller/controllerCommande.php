<?php
require_once File::build_path('model/ModelCommande.php'); // chargement du modèle
class ControllerCommande {

    protected static $object="commande";

    public static function created(){  
    	$login=$_SESSION["login"]; 
    	$date=date("Y-m-d H:i:s");
    	$prix=0;
    	$panier=$_SESSION["panier"];

    	foreach ( $panier as $value) {
        $prix+=$value->getPrix();
    	}

   		$v=new ModelCommande($login,0,$panier,$prix,$date);
   		$v->save();
   		$_SESSION["panier"]=NULL;
        $controller='commande'; $view='created'; $pagetitle='cree';     //appel au modèle pour gerer la BD
        $tab_v = ModelCommande::select($login);
        require File::build_path('view/view.php');  
        }
    }

?>

