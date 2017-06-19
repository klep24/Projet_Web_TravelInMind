<?php
    require_once("APIInterface.php");
    session_start();
    if(isset($_COOKIE["user_token"])){
        if(isset($_SESSION["user_id"])){
            if(check_logged($_SESSION["user_id"], $_COOKIE["user_token"])){
                register();
            }
        }
        else{
            header("Location:login.php");
        }
    }
 ?>
<!doctype html>
<html>
<head>
<title>Modification</title>
<?php include('static/header.php'); ?>
</head>
<body>
<div class="corps">
  <?php include('static/navbar.php');
        $user =  json_decode(find_users($_SESSION["user_id"], "%", "%", "%", "%", "%", "%", "%", "%"), true)[0];
  ?>
  <div>
  <h1>Modification</h1>
    <div class="enregistrement">
          <label class="enregistrement" ><span class="obligatoire">* </span>Nom</label>
          <input type="text" id="user_lastname" name="nom" class="typeahead2" value="<?php echo($user["user_lastname"]); ?>">
          <br/>
          <label class="enregistrement"><span class="obligatoire">* </span>Prénom</label>
          <input type="text" id="user_firstname" name="prenom" class="typeahead2" value="<?php echo($user["user_firstname"]); ?>">
          <br/>
          <label class="enregistrement"><span class="obligatoire">* </span>Adresse Mail</label>
          <input type="text" id="user_mail" name="mail" class="typeahead2">
          <br/>
          <label class="enregistrement"><span class="obligatoire">* </span>Mot de passe</label>
          <input type="password" id="user_password" name="mdp" class="typeahead2" value="<?php echo($user["user_password"]); ?>" >
          <br/>
          <label class="enregistrement"><span class="obligatoire">* </span>Confirmer mot de passe</label>
          <input type="password" name="confirmermdp" class="typeahead2">
          <br/>
          <label class="enregistrement">  Gare favorite</label>
          <div id="scrollable-menu-dep">
            <input type="text" name="gare" class="typeahead" ></input>
          </div>
          <label class="enregistrement">  N° de téléphone</label>
          <input type="text" id="user_phone" name="telephone" class="typeahead2" value="<?php echo($user["user_phone"]); ?>">
          <br/>
          <br/>
          <input id="valid_modif" class="btn btn-lg btn-success" type="button" name="valid" value="Valider" />
      </div>
    </div>
    </div>
</body>
</html>
