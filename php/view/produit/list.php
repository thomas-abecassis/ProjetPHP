
<?php
foreach ($tab_v as $v)
    echo '<p> Produit d\'id <a href=../controller/routeur.php?action=Read&id='.rawurlencode($v->getId()).">" .htmlspecialchars($v->getNom()) . '</a></p>';
?>
