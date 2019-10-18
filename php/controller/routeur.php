<?php
require_once 'controllerProduit.php';


$action='readAll';
if(isset($_GET['action'])){
	$action = $_GET['action'];
}

ControllerProduit::$action();


?>
