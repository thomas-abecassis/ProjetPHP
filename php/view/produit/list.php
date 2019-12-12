
        <?php
        foreach ($tab_v as $v)
            echo '<div class="col s12 m6 xl4"> <p class="produit '.htmlspecialchars($v->getId()).'"> Produit d\'id <a  href=index.php?action=Read&id='.rawurlencode($v->getId()).">" . htmlspecialchars($v->getId()) . '</a></p></div>';       