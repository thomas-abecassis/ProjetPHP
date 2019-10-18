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
    	$id=$_GET['id'];
    	$image=$_GET['image'];
    	$prix=$_GET['prix'];
 		$v=new ModelVoiture($id,$image,$prix);
 		$v->save();
        $controller='produit'; $view='created'; $pagetitle='cree';     //appel au modèle pour gerer la BD
        $tab_v = ModelProduit::getAllProduit();
        require '../view/view.php';  
    }
}
?>