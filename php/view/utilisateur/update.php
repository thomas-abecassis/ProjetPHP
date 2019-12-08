    <?php 

    $controller=static::$object;

    if($isUpdate){
      echo "<form method=\"get\" action=\"index.php\">";
    }
    else{
      echo "<form method=\"get\" action=\"index.php\">";
    }
    ?>

        <fieldset>
          <legend>Mon formulaire :</legend>
          <p>
            <label for="immat_id">Id</label> :
            <?php
            if($isUpdate){
            echo ("<input value= \"" . $v->getLogin()."\" type=\"text\" placeholder=\"Ex : 256AB34\" name=\"login\" id=\"immat_id\" required readonly />");
            }
            else{
              echo ("<input value= \"" . $v->getLogin()."\" type=\"text\" placeholder=\"Ex : 256AB34\" name=\"login\" id=\"immat_id\" required  />");
            }
          
            ?>
          </p>

          <p>
            <label for="Nom_id">Nom</label> :
          <?php
            echo "<input value = \"" . $v->getNom() . "\" type=\"text\" placeholder=\"Ex : bleu\" name=\"nom\" id=\"Nom_id\" required />"
          ?>
          </p>

          <p>
            <label for="prix_id">prenom</label> :
            <?php 
            echo "<input value= \"" . $v->getPrenom() . "\" type=\"text\" placeholder=\"Ex : Renault\" name=\"prenom\" id=\"prenom_id\" required/>"
            ?>
          </p>
          <p>
            <label for="mdp_id">Mot de passe</label> :
            <?php 
            echo "<input value= \"" . $v->getMdp() . "\" type=\"password\" placeholder=\"azerty123\" name=\"mdp\" id=\"mdp_id\" required/>"
            ?>
          </p>
          <p>
            <label for="mdp_id">confirmez votre mot de passe</label> :
            <?php 
            echo "<input value= \"" . $v->getMdp() . "\" type=\"password\" placeholder=\"azerty123\"  id=\"prenom_id\" required/>"
            ?>
          </p><?php
          echo "<input type='hidden' name='controller' value='utilisateur'>";
          if($isUpdate){
            echo "<input type='hidden' name='action' value='updated'>";
          }else{
            echo "<input type='hidden' name='action' value='created'>";
          }
          ?>
          <p>
            <input type="submit" value="Envoyer" />
          </p>
        </fieldset> 
      </form>


