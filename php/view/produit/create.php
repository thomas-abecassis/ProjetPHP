
      <form method="get" action="index.php?action=created">
        <fieldset>
          <legend>Mon formulaire :</legend>
          <p>
            <label for="immat_id">Immatriculation</label> :
            <input type="text" placeholder="Ex : 256AB34" name="immatriculation" id="immat_id" required/>
          </p>

          <p>
            <label for="couleur_id">couleur</label> :
            <input type="text" placeholder="Ex : bleu" name="couleur" id="couleur_id" required/>
          </p>

          <p>
            <label for="marque_id">marque</label> :
            <input type="text" placeholder="Ex : Renault" name="marque" id="marque_id" required/>
          </p>
          <input type='hidden' name='action' value='created'>

          <p>
            <input type="submit" value="Envoyer" />
          </p>
        </fieldset> 
      </form>


