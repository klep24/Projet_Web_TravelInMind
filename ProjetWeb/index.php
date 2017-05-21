<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css">
    <title>Accueil</title>
  </head>

  <body>
    <div>
      <img  src="image/TGV-SNCF.jpg">
      <nav id="menu"class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                  </button>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Accueil</a></li>
                  </ul>
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="Monitineraire.php">Mon itinéraire</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Connexion</a></li>
                  </ul>


                  <!-- <?php
                  if ($connecter == false) {
                    echo '<ul class="nav navbar-nav navbar-right">
                            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Connexion</a></li>
                          </ul>';
                  }
                  else {
                    echo '<ul class="nav navbar-nav navbar-right">
                            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Déconnexion</a></li>
                          </ul>';
                  }
                  ?> -->

                </div>
          </div>
        </nav>
      </div>

    <h1>Travel in Mind</h1>
    <p>N'oubliez plus vos trajet avec Travel in Mind! Inscrivez vous et recevez par mail ou par sms les trajets et les horaires qui vous interresse.
	</p>
    <div class="recherche">
      <p class="recherche">Départ</p>
      <input type="text" name="depart" class="recherche">
      <p class="recherche">Arrivée</p>
      <input type="text" name="arrivee" class="recherche">
      <input type="button" class="recherche" value="Rechercher" onclick="self.location.href='resultat.php'">
      <br/>
    </div>
    <br/>

  </body>
</html>
