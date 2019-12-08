<?php
require_once File::build_path('controller/ControllerProduit.php');
require_once File::build_path('controller/ControllerUtilisateur.php');


$action='readAll';
if(isset($_GET['action'])){
	$action = $_GET['action'];
}

$controller='produit';
if(isset($_GET['controller'])){
	$controller = $_GET['controller'];
}
$controller_classe="Controller".ucfirst($controller);

if(class_exists($controller_classe,false)){
	$controller_classe::$action();
}else{
	ControllerProduit::error();
}


?>



	