
        <?php
        foreach ($tab_v as $v)
            echo '<p> Produit d\'id <a href=index.php?action=Read&id='.rawurlencode($v->getId()).">" . htmlspecialchars($v->getId()) . '</a>.</p>';
        ?>
