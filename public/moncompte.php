<!DOCTYPE html>
<html>
  <head>
    <?php include('static/header.php'); ?>
    <title>Mon Compte</title>
  </head>

  <body>
  <div class="corps">
  <?php include('static/navbar.php'); ?>

    <h1>Mon Compte</h1>

    <div>
      <ul class="nav nav-tabs">
        <li id="tab1" class="active"><a href="#">Mes informations</a></li>
        <li><a href="historique.php">Mon historique d'itinéraire</a></li>
    </ul>
  </div>

  <div class="compte">
    <label>Nom : </label><p >............</p>
    <label>Prénom : </label><p>............</p>
    <label>Adresse mail : </label><p>............</p>
    <label>Mot de passe: </label><p>............</p>
    <label>Gare favorite : </label><p>............</p>
    <label>N° de téléphone : </label><p>............</p>
    <br/>
    <br/>
    <input type="button" name="modif" id="modif" class="btn btn-lg btn-warning" value="Modifier mes informations"  onclick="document.location.href='modifInfos.php';">
  </div>
</div>
  </body>
</html>
