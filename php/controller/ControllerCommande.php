<?php
require_once File::build_path('model/ModelCommande.php'); // chargement du modèle
class ControllerCommande {

    protected static $object="commande";

    public static function created(){
        if(isset($_SESSION["loginthsa"])){  
            if(isset($_SESSION["panier"])){
            	$login=$_SESSION["loginthsa"]; 
            	$date=date("Y-m-d H:i:s");
            	$prix=0;
            	$panier=$_SESSION["panier"];

            	foreach ( $panier as $value) {
                $prix+=$value->getPrix();
            	}

           		$v=new ModelCommande($login,0,$panier,$prix,$date);
           		$id=$v->save();
           		$_SESSION["panier"]=NULL;
                $tab_v=ModelCommande::getProduitsByCommandeId($id);
                $_SESSION['tab_produit']=$tab_v;
                $_SESSION['prix']=$prix;
                $_SESSION['date']=$date;

            }
                $controller='commande'; $view='details'; $pagetitle='cree';     //appel au modèle pour gerer la BD
                require File::build_path('view/view.php');  
            }
            else{
                $controller='commande'; $view='erreur'; $pagetitle='cree';     //appel au modèle pour gerer la BD
                require File::build_path('view/view.php');   
            }
        }

    public static function Read(){
            $tab_v=ModelCommande::getProduitsByCommandeId(myGet("id"));
            $_SESSION['tab_produit']=$tab_v;
            $_SESSION['prix']=myGet("prix");
            $_SESSION['date']=myGet("date");
            $controller='commande'; $view='details'; $pagetitle='cree';     //appel au modèle pour gerer la BD
            require File::build_path('view/view.php'); 
    }

    public static function readAll(){
        $login=$_SESSION["loginthsa"];

        $tabCommande=ModelCommande::getCommandesByLogin($login);



        $controller='commande'; $view='list'; $pagetitle='cree';     //appel au modèle pour gerer la BD
        require File::build_path('view/view.php');   

    }
    }

?>

