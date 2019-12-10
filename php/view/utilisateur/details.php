
    		<?php
    			echo htmlspecialchars($v->getLogin());
    			echo "<br>";
    			echo htmlspecialchars($v->getNom());
    			echo "<br>";
    			echo htmlspecialchars($v->getPrenom());
   				echo "<br>";
    			echo '<br>';
                if(Session::is_user($v->getLogin())||Session::is_admin()){
                echo '<a href=index.php?action=delete&controller=utilisateur&id='.htmlspecialchars($v->getLogin()).'>supprimer le produit</a>';
                echo "<br>";
                echo '<a href=index.php?action=update&controller=utilisateur&id='.htmlspecialchars($v->getLogin()).'>mettre à jour le produit </a>';
                }

			?>

