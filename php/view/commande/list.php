
        <?php

        foreach ($tabCommande as $commande){
            echo "<a href=index.php?controller=commande&action=Read&id=".rawurlencode($commande->getId())."&prix=".rawurlencode($commande->getPrix())."&date=".$commande->getDate()."> commande du ".$commande->getDate() ." au prix de : ".rawurlencode($commande->getPrix()). " status : ".$commande->getStatus()."</a> <br>";

               //echo(
                //"<a href=index.php?controller=commande&action=Read&id=".rawurlencode($commande->getId()).">"
               //);
            }
   

       ?>