    <?php 

    $controller=static::$object;
    ?>

     <form method="get" action="index.php">
        <fieldset>
          <legend>Mon formulaire :</legend>
          <p>
            <label for="login_id">login</label> :
            <input value= "" type="text" placeholder="Ex : 256AB34" name="login" id="immat_id" required />
          </p>
          <p>
            <label for="mdp_id">Mot de passe</label> :
            <input value= "" type="text" placeholder="Ex : 256AB34" name="mdp" id="mdp_id" required />
          </p>
          <p>
            <input type="submit" value="Envoyer" />
          </p>
          <input type='hidden' name='action' value='connected'>
          <input type='hidden' name='controller' value='utilisateur'>
        </fieldset> 
      </form>

