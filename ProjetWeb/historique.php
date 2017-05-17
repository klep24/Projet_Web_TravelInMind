<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css">
    <title>Mon Compte</title>
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
            <li class="active"><a href="monitineraire.php">Mon itinéraire</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Déconnexion</a></li>
          </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
    </nav>

    <h1>Mon Compte</h1>

    <div>
      <ul class="nav nav-tabs">
        <li id="tab1"><a href="moncompte.php">Mes informations</a></li>
        <li class="active"><a href="historique.php">Mon historique d'itinéraire</a></li>
    </ul>
  </div>



  </body>
</html>
