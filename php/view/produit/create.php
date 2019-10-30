<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> Mon premier php </title>
    </head>
   
    <body>
      <form method="get" action="routeur.php?action=created">
        <fieldset>
          <legend>Mon formulaire :</legend>
          <p>
            <label for="nom">nom</label> :
            <input type="text" placeholder="Ex : bleu" name="nom" id="nom" required/>
          </p>

          <p>
            <label for="image">image</label> :
            <input type="text" placeholder="Ex : Renault" name="image" id="image" required/>
          </p>
          <p>
            <label for="prix">prix</label> :
            <input type="number" placeholder="prix" name="prix" id="prix" required/>
          </p>
          <input type='hidden' name='action' value='created'>

          <p>
            <input type="submit" value="Envoyer" />
          </p>
        </fieldset> 
      </form>
    </body>
</html> 

