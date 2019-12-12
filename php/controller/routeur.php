<?php
require_once File::build_path('controller/ControllerProduit.php');
require_once File::build_path('controller/ControllerUtilisateur.php');


 function myGet($nomvar){
 	if(isset($_GET[$nomvar])){
 		return $_GET[$nomvar];
 	}
 	if(isset($_POST[$nomvar])){
 		return $_POST[$nomvar];
 	}
 	return NULL;
 }

$action='readAll';
if(!is_null(myGet('action'))){
	$action = myGet('action');
}

$controller='produit';
if(!is_null(myGet('controller'))){
	$controller = myGet('controller');
}
$controller_classe="Controller".ucfirst($controller);

if(class_exists($controller_classe,false)){
	$controller_classe::$action();
}else{
	ControllerProduit::error();
}


?>



	