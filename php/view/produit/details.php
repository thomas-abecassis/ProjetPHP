
    		<?php
    			echo htmlspecialchars($v->getId())."<br>".htmlspecialchars($v->getNom()) ."<br>" . htmlspecialchars($v->getPrix()) . "€ <br> <br>" ;

    			if(Session::is_admin()){
    			echo '<a href=index.php?action=delete&id='.rawurlencode($v->getId()).'>supprimer le produit</a> <br>';

    			echo '<a href=index.php?action=update&id='.rawurlencode($v->getId()).'>mettre à jour le produit </a> <br>';

                echo "<a href=index.php?action=panier&id=".rawurlencode($v->getId())."> ajouter panier </a> <br>";}

			?>

