<!doctype html>
<html>
<head>
<title>S'enregistrer</title>
<?php include('static/header.php'); ?>

</head>
<body>
<div class="corps">
  <?php include('static/navbar.php'); ?>
  <div>
  <h1>S'enregistrer</h1>
    <div class="enregistrement">
          <label class="enregistrement" ><span class="obligatoire">* </span>Nom</label>
          <input type="text" id="user_firstname" name="nom" class="typeahead2">
          <br/>
          <label class="enregistrement"><span class="obligatoire">* </span>Prénom</label>
          <input type="text" id="user_lastname" name="prenom" class="typeahead2">
          <br/>
          <label class="enregistrement"><span class="obligatoire">* </span>Adresse Mail</label>
          <input type="text" id="user_mail" name="mail" class="typeahead2" >
          <br/>
          <label class="enregistrement"><span class="obligatoire">* </span>Mot de passe</label>
          <input type="password" id="user_password" name="mdp" class="typeahead2" >
          <br/>
          <label class="enregistrement"><span class="obligatoire">* </span>Confirmer mot de passe</label>
          <input type="password" name="confirmermdp" class="typeahead2">
          <br/>
          <label class="enregistrement">  Gare favorite</label>
          <div id="scrollable-menu-dep">
            <input type="text" name="gare" class="typeahead2" ></input>
          </div>
          <label class="enregistrement">  N° de téléphone</label>
          <input type="text" id="user_phone" name="telephone" class="typeahead2">
          <br/>
          <br/>
          <input id="valid_register" class="btn btn-lg btn-success" type="button" name="valid" value="S'enregistrer" />
      </div>
    </div>
    </div>
</body>
</html>
