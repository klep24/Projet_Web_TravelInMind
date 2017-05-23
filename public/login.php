<!doctype html>
<html>
<head>
<title>Connexion</title>
<?php include('static/header.php'); ?>

</head>
<body>
  <?php include('static/navbar.php'); ?>
  <div>
  <h1>Connexion</h1>
    <div class="connexion">
      <form id="myform" >
          <label class="connexion">Adresse Mail</label>
          <input type="text" name="mail" class="typeahead" >
          <br/>
          <label class="connexion">Mot de passe</label>
          <input type="password" id="password" name="mdp" class="typeahead" >
          <br/>
          <br/>
          <input type="submit" class="btn btn-lg btn-success" id="Register" value="Connexion">
        </form>
      </div>
      <p id="mdp"><a href='#'>Mot de passe oublié ?</a></p>
      <p id="senregistrer">Pas encore de compte ? <a href='enregistrement.php'>S'enregistrer</a><p>
    </div>

</body>
</html>
