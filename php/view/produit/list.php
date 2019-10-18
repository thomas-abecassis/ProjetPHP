
<?php
foreach ($tab_v as $v)
    echo '<p> Produit d\'id <a href=index.php?action=Read&imma='.rawurlencode($v->getNom()).">" . htmlspecialchars($v->getNom()) . '</a></p>';
?>
