    <?php 

    $controller=static::$object;
    
    if(Conf::getDebug()){
      echo("<form method=\"get\" ");
    }
    else{
      echo("<form method=\"post\" ");
    }

    if($isUpdate){
      echo  ("action=\"index.php\">");
    }
    else{
      echo ("action=\"index.php\">");
    }
    ?>

        <fieldset>
          <legend>Mon formulaire :</legend>
          <p>
            <label for="immat_id">Id</label> :
            <?php
            if($isUpdate){
            echo ("<input value= \"" . $v->getId()."\" type=\"text\" placeholder=\"Ex : 256AB34\" name=\"id\" id=\"immat_id\" required readonly />");
            }
            else{
              echo ("<input value= \"" . $v->getId()."\" type=\"text\" placeholder=\"Ex : 256AB34\" name=\"id\" id=\"immat_id\" required  />");
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
            <label for="prix_id">prix</label> :
            <?php 
            echo "<input value= \"" . $v->getprix() . "\" type=\"number\" placeholder=\"Ex : Renault\" name=\"prix\" id=\"prix_id\" required/>"
            ?>
          </p><?php
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


