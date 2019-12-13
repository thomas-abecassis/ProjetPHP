
        <?php

        $tab_v=$_SESSION['tab_produit'];
        $prix=$_SESSION['prix'];
        $date=$_SESSION['date'];


    	echo "votre commande du ". $date ." : ";
        foreach ($tab_v as $v){
            echo ('<div class="col s12 m6 l4 boite"> 
        			<p class="centrer">Produit ' . htmlspecialchars($v->getnom()) . ' </p>
        			<a href=index.php?action=Read&id='.rawurlencode($v->getId()).'>
        				<img class="produit" src="../image/'.htmlspecialchars($v->getId()).'.jpg">
        				<div class="espace"></div>
        				<div class="bouton">Plus dinformations </div>
        			</a>
        			<div class="prix"></div>
        				<p>Prix : '.htmlspecialchars($v->getprix()).' € </p>
        		  </div>');
        		  }
        echo "total : " . $prix . "€";       

       ?>