
        <?php
        foreach ($tab_v as $v)
            echo '<p> utilisateur de login <a href=index.php?action=Read&controller=utilisateur&id='.rawurlencode($v->getLogin()).">" . htmlspecialchars($v->getLogin()) . '</a>.</p>';
        ?>
