<!DOCTYPE html>
<html>
  <head>
    <?php include('static/header.php'); ?>
    <title>Mon Compte</title>
  </head>
  <body>
  <div class="corps">
    <?php include('static/navbar.php'); ?>

      <h1>Mon <span id="h1">Compte</span></h1>

      <div>
        <ul class="nav nav-tabs">
          <li id="tab1" class="active"><a href="#">Mes informations</a></li>
          <li><a href="historique.php">Mon historique d'itinéraire</a></li>
      </ul>
    </div>
    <br/>
    <div class="container">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
        <div class="panel panel-info">
          <div class="panel-heading">
                <h3 class="panel-title">(nom et prénom)</h3>
          </div>
          <div class="panel-body">
            <div class="rowInfos">
              <div class=" col-md-9 col-lg-9 ">
                <table class="table table-user-information">
                  <tbody>
                    <tr>
                      <tr>
                        <td>Email</td>
                        <td>(adresse mail)</td>
                      </tr>
                      <tr>
                        <td>Mot de passe</td>
                        <td>(mot de passe)</td>
                      </tr>
                      <tr>
                        <td>Gare Favorite</td>
                        <td>(gare favorite)</td>
                      </tr>
                        <td>N° de téléphone</td>
                        <td>(N° de téléphone)</td>
                    </tr>
                  </tbody>
                </table>
                <a class="btn btn-btn-lg btn-success" onclick="document.location.href='modifInfos.php';">Modifier mes informations</a>
                <a href="#" class="btn btn-btn-lg btn-success">Supprimer mon compte</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br/>
  </div>
  </body>
</html>
