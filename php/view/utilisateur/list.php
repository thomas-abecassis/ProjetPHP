
        <?php
        if(Session::is_admin()){
        foreach ($tab_v as $v)
            echo '<p> utilisateur de login <a href=index.php?action=Read&controller=utilisateur&id='.rawurlencode($v->getLogin()).">" . htmlspecialchars($v->getLogin()) . '</a>.</p>';
   		}else{
   			echo "vous devez etre admin ";
   		}
        ?>
