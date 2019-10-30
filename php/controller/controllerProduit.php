<?php
require_once '../model/ModelProduit.php'; // chargement du modèle
class ControllerProduit {
    public static function readAll() {
        $tab_v = ModelProduit::getAllProduits();
        $controller='produit'; $view='list'; $pagetitle='Liste des produits';     //appel au modèle pour gerer la BD
        require '../view/view.php';  //"redirige" vers la vue
    }

    public static function Read(){
    	$v=ModelProduit::getProduitById($_GET['id']);
    	if($v==false){
        $controller='produit'; $view='error'; $pagetitle='erreur';     //appel au modèle pour gerer la BD
        require '../view/view.php';  //"redirige" vers la vue
    	}else{      
        $controller='produit'; $view='details'; $pagetitle='les d\'etails';     //appel au modèle pour gerer la BD
        require '../view/view.php';  //"redirige" vers la vue
	    }
    }

    public static function create(){
    	$controller='produit'; $view='create'; $pagetitle='creation de produit';     //appel au modèle pour gerer la BD
        require '../view/view.php';  //"redirige" vers la vue
    }

    public static function created(){
    	$image=$_GET['image'];
    	$prix=(int)$_GET['prix'];
        $nom=$_GET['nom'];
 		$v=new ModelProduit($nom,$image,$prix,0);
 		$v->save();
        $controller='produit'; $view='list'; $pagetitle='cree';     //appel au modèle pour gerer la BD
        $tab_v = ModelProduit::getAllProduits();
        require '../view/view.php';  
    }
}
?>