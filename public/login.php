<!doctype html>
<html>
<head>
<title>Connexion</title>
<?php include('static/header.php'); ?>

</head>
<body>
<div class="corps">
  <?php include('static/navbar.php'); ?>
  <div>
  <h1>Connexion</h1>
    <div class="connexion">
      <form id="myform" >
          <label class="connexion">Adresse Mail</label>
          <input type="text" name="mail" class="typeahead2" >
          <br/>
          <label class="connexion">Mot de passe</label>
          <input type="password" id="password" name="mdp" class="typeahead2" >
          <br/>
          <br/>
          <input type="submit" class="btn btn-lg btn-success" id="Register" value="Connexion">
        </form>
      </div>
      <p id="mdp"><a href='#myModal' data-toggle="modal" >Mot de passe oublié ?</a></p>
      <p id="senregistrer">Pas encore de compte ? <a href='enregistrement.php'>S'enregistrer</a></p>
    </div>
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
                    Mot de passe oublié
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form class="form-horizontal" role="form" method="POST">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control"
                        id="inputEmail3" placeholder="Email" name="mdpoublie"/>
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
                <input type="submit" class="btn btn-lg btn-success" id="Envoyer" value="Envoyer">
            </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>
