
        <?php
        foreach ($tab_v as $v)
            echo '<div class="col s6 m4 6 boite"> 
        			<p class="centrer">Produit ' . htmlspecialchars($v->getnom()) . ' </p>
        			<a href=index.php?action=Read&id='.rawurlencode($v->getId()).'>
        				<img class="produit" src="../image/'.htmlspecialchars($v->getId()).'.jpg">
        				<div class="espace"></div>
        				<div class="bouton">Plus d\'informations </div>
        			</a>
        			<div class="prix"></div>
        				<p>Prix : '.htmlspecialchars($v->getprix()).' € </p>
        		  </div>';       



       