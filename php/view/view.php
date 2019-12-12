<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
    	<nav style= "width:100%; background-color:grey; color : white">
    		<ol>
        		<li ><a href="index.php?action=readAll">liste des voitures</a></li>
        		<li ><a href=" index.php?action=readAll&controller=utilisateur">liste des utilisateurs</a></li>
        		<li><a href="index.php?action=readAll&controller=trajet">acceuil</a></li>
                <?php 
                if(isset($_SESSION["login"])){
                    echo ("<li><a href=\"index.php?action=disconnect&controller=utilisateur\">deconnexion</a></li>");
                }else{
                   echo ("<li><a href=\"index.php?action=connect&controller=utilisateur\">connexion</a></li>"); 
                }
                ?>
    		</ol>
    	</nav>
<?php

if(isset($_SESSION["panier"])){
    echo "<br>-----------------------panier--------------------<br>";
    $prix=0;
    foreach ($_SESSION["panier"] as $value) {
        echo $value->getNom()."<br>";
        $prix+=$value->getPrix();
    }
    echo strval($prix)."€";
    echo '<a href=index.php?controller=commande&action=commander&id='.htmlspecialchars($v->getId()).'>commander</a>';
    echo "<br>-----------------------panier--------------------<br>";
}

// Si $controleur='voiture' et $view='list',
// alors $filepath="/chemin_du_site/view/voiture/list.php"
$filepath = File::build_path("view/".static::$object.'/'.$view.".php");

require $filepath;
?>
<footer style="border: 2px solid grey;text-align:right;">Ceci est un footer incroyable</footer>
    </body>
</html>

