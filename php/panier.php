
<?php
$panier=array();
if(isset($_COOKIE["panier"])){
	$panier=unserialize($_COOKIE["panier"]);
}
$produit= ModelProduit::select($_GET['id']);
array_push($panier,$produit);

setcookie("panier",serialize($panier),time()+10);

require File::build_path('/view/produit/list.php');
?>
