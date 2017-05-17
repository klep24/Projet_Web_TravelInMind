<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
  </head>

  <body>
    <div>
      <img src="image/TGV-SNCF.jpg">
    </div>

    <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Accueil</a></li>
          </ul>
          <ul class="nav navbar-nav">
            <li class="active"><a href="Monitineraire.php">Mon itinéraire</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Connexion</a></li>
          </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
    </nav>

    <h1>Connexion</h1>
    <div class="connexion">
      <p class="connexion">Adresse Mail</p>
      <input type="text" name="Mail" class="connexion">
      <p class="connexion">Mot de passe</p>
      <input type="text" name="mdp" class="connexion">
      <input type="button" name="co" class="connexion" value="Se connecter">
      <p id="mdp"><a href='#'>Mot de passe oublié ?</a></p>
      <p id="senregistrer">Pas encore de compte ? <a href='enregistrement.php'>S'enregistrer</a><p>
    </div>



  </body>
</html>
