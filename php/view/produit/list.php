
        <?php
        foreach ($tab_v as $v)
            echo '<div class="col s12 m6 l4"> <p class="centrer">Produit ' . htmlspecialchars($v->getnom()) . ' </p><a href=index.php?action=Read&id='.rawurlencode($v->getId()).'><img class="produit" src="../image/'.htmlspecialchars($v->getId()).'.jpg"></a></div>';       



       