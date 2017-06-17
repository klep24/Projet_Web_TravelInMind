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
                      <tr>
                        <td>N° de téléphone</td>
                        <td>(N° de téléphone)</td>
                      </tr>
                  </tbody>
                </table>
                <a class="btn btn-btn-lg btn-success" onclick="document.location.href='modifInfos.php';">Modifier mes informations</a>
                <a href="#myModal" class="btn btn-btn-lg btn-success" data-toggle="modal">Supprimer mon compte</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br/>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
       aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                  <button type="button" class="close"
                     data-dismiss="modal">
                         <span aria-hidden="true">&times;</span>
                         <span class="sr-only">Close</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">
                      Suppression de compte
                  </h4>
              </div>

              <!-- Modal Body -->
              <div class="modal-body">

                  <form class="form-horizontal" role="form" method="POST">
                    <div class="form-group">
                      <div class="col-sm-10">
                      <br/>
                          <p> Êtes-vous sûr de vouloir supprimer votre compte ?</p>
                          <p> Cette action irréversible supprimera vos informations et votre historique</p>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                      </div>
                    </div>

              </div>
              <!-- Modal Footer -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-lg btn-default"
                          data-dismiss="modal">
                              Fermer
                  </button>
                  <input type="submit" class="btn btn-lg btn-success" id="Supprimer" value="Supprimer définitivement">
              </div>
              </form>
          </div>
      </div>
  </div>

  </body>
</html>
