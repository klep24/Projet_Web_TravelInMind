<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css">
    <title>Modification</title>
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
            <li class="active"><a href="minitineraire.php">Mon itinéraire</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Connexion</a></li>
          </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
    </nav>

    <div>
      <h1>Modification des informations</h1>
      <div class="enregistrement">
        <p class="enregistrement">Nom</p>
        <input type="text" name="nom" class="enregistrement">
        <p class="enregistrement">Prénom</p>
        <input type="text" name="prenom" class="enregistrement">
        <p class="enregistrement">Adresse Mail</p>
        <input type="text" name="Mail" class="enregistrement">
        <p class="enregistrement">Mot de passe</p>
        <input type="password" name="mdp" class="enregistrement">
        <p class="enregistrement">Confirmer mot de passe</p>
        <input type="password" name="confirmermdp" class="enregistrement">
        <p class="enregistrement">Gare favorite</p>
        <input type="text" name="gare" class="enregistrement">
        <p class="enregistrement">N° de téléphone</p>
        <input type="text" name="telephone" class="enregistrement">
        <input type="button" name="co" class="enregistrement" value="Modifier les informations">
      </div>
    </div>

  </body>
</html>
