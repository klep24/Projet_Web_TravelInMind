<!doctype html>
<html>
<head>
<title>Modification</title>
<?php include('static/header.php'); ?>

</head>
<body>
<div class="corps">
  <?php include('static/navbar.php'); ?>
  <div>
  <h1>Modification</h1>
    <div class="enregistrement">
      <form id="myform" >
          <label class="enregistrement" ><span class="obligatoire">* </span>Nom</label>
          <input type="text" name="nom" class="typeahead">
          <br/>
          <label class="enregistrement"><span class="obligatoire">* </span>Prénom</label>
          <input type="text" name="prenom" class="typeahead">
          <br/>
          <label class="enregistrement"><span class="obligatoire">* </span>Adresse Mail</label>
          <input type="text" name="mail" class="typeahead" >
          <br/>
          <label class="enregistrement"><span class="obligatoire">* </span>Mot de passe</label>
          <input type="password" id="password" name="mdp" class="typeahead" >
          <br/>
          <label class="enregistrement"><span class="obligatoire">* </span>Confirmer mot de passe</label>
          <input type="password" name="confirmermdp" class="typeahead">
          <br/>
          <label class="enregistrement">  Gare favorite</label>
          <div id="scrollable-menu-dep">
            <input type="text" name="gare" class="typeahead" ></input>
          </div>
          <label class="enregistrement">  N° de téléphone</label>
          <input type="text" name="telephone" class="typeahead">
          <br/>
          <br/>
          <input type="submit" class="btn btn-lg btn-success" id="ValidModif" value="Valider">
        </form>
      </div>
    </div>
    </div>
</body>
</html>
