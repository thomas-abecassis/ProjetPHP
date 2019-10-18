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
    		</ol>
    	</nav>
<?php
// Si $controleur='voiture' et $view='list',
// alors $filepath="/chemin_du_site/view/voiture/list.php"
$filepath = "../view/".$controller.'/'.$view.".php";

require $filepath;
?>
<footer style="border: 2px solid grey;text-align:right;">Ceci est un footer incroyable</footer>
    </body>
</html>

