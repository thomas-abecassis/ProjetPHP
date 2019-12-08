
    		<?php
    			echo htmlspecialchars($v->getId());
    			echo "<br>";
    			echo htmlspecialchars($v->getNom());
    			echo "<br>";
    			echo htmlspecialchars($v->getPrix());
                echo "€";
   				echo "<br>";
    			echo '<br>';
    			echo '<a href=index.php?action=delete&id='.htmlspecialchars($v->getId()).'>supprimer le produit</a>';
    			echo "<br>";
    			echo '<a href=index.php?action=update&id='.htmlspecialchars($v->getId()).'>mettre à jour le produit </a>';
                echo "<br>";
                echo "<a href=index.php?action=panier&id=".htmlspecialchars($v->getId())."> ajouter panier </a>";
			?>

