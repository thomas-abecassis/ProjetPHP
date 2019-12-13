<!DOCTYPE html>
<html>
<head>
   
  <meta charset="utf-8">
  <title><?php echo $pagetitle; ?></title>
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <!-- Social media Font -->
  <link rel="stylesheet" href="https://d1azc1qln24ryf.cloudfront.net/114779/Socicon/style-cf.css?9ukd8d">
</head>

<body class=" grey lighten-3">
    <div id="contenu">
        <header>
        	 <nav   id="menu" class="nav-wraper">
          
                
                <img href="#index.html" id="logo" src="https://www.logolynx.com/images/logolynx/0a/0a541bcbcef40a7c1058c0d02db88762.png"alt="Le logo.">
                <ul id="nav-mobile" class="right hide-on-med-and-down">
            		
                		<li><a href="index.php?action=readAll&controller=trajet">Acceuil</a></li>
                        <li ><a href="index.php?action=readAll">Produits</a></li>
                		<li ><a href=" index.php?action=readAll&controller=utilisateur">Utilisateurs</a></li>
                		
                        <?php 
                        if(isset($_SESSION["login"])){
                            echo ("<li><a href=\"index.php?action=disconnect&controller=utilisateur\">Deconnexion</a></li>");
                        }else{
                           echo ("<li><a href=\"index.php?action=connect&controller=utilisateur\">Connexion</a></li>"); 
                        }
                        ?>
            		
            	</nav>

        </header>
        <div class="container">
            <div class="row">
            <?php 
            $filepath = File::build_path("view/".static::$object.'/'.$view.".php");

            require $filepath;
            ?>
            </div>
        </div>
        <div class="container panier">
          
            <?php
            if(isset($_SESSION["panier"])){
                echo "<center>Panier</center>";
                $prix=0;
                foreach ($_SESSION["panier"] as $value) {
                    echo $value->getNom()."<br>";
                    $prix+=$value->getPrix();
                }
                echo "<center>Total : " .strval($prix)."€ </center>";
                if(isset($_SESSION["login"])){
                  echo '<a href=index.php?controller=commande&action=created>commander</a>';
                }
            }
            ?>
          
         </div>


    </div>
    <div class="pad1">
        <footer >
        <!-- Footer social -->
          <section class="ft-social">
            <ul class="ft-social-list">
              <li><a href="#" class="pure-button button-socicon"><span class="socicon socicon-facebook grey-text text-darken-1"></span></a></li>
              <li><a href="#" class="pure-button button-socicon"><span class="socicon socicon-twitter grey-text text-darken-1"></span></a></li>
              <li><a href="#" class="pure-button button-socicon"><span class="socicon socicon-linkedin grey-text text-darken-1"></span></a></li>
              <li><a href="#" class="pure-button button-socicon"><span class="socicon socicon-instagram grey-text text-darken-1"></span></a></li>
            </ul>
          </section>

          <!-- Footer legal -->
          <section class="ft-legal">
            <ul class="ft-legal-list">
              <li><a href="#">Termes &amp; Conditions</a></li>
              <li><a href="#">Mentions légales &amp; CGU</a></li>
              <li><a href="#">Données personnelles</a></li>
              <li>&copy; 2019 Copyright Sofuto Inc.</li>
            </ul>
          </section>

        </footer>
    </div>
    
    
</body>


</html>

