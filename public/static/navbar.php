<div>
  <img  src="img/TGV-SNCF.jpg">
  <nav id="menu" class="navbar navbar-default navbar-fixed-top">
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
                <li class="active"><a href="apropos.php">A propos</a></li>
              </ul>
              <?php
              ?>
              <ul class="nav navbar-nav">
                <li class="active"><a href="moncompte.php"> Mon Compte</a></a></li>
              </ul>
              <!-- <ul class="nav navbar-nav navbar-right">
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Connexion</a></li>
              </ul> -->


              <?php

              if (!isset($_COOKIE["user_token"])) {
                echo '<ul class="nav navbar-nav navbar-right">
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Connexion</a></li>
                      </ul>';
              }else {
                echo '<ul class="nav navbar-nav navbar-right">
                        <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Déconnexion</a></li>
                      </ul>';
              }
              ?>

            </div>
          </div>
  </nav>
</div>
