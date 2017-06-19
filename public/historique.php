<?php
require_once("APIInterface.php");
session_start();
if(isset($_COOKIE["user_token"])){
    if(isset($_SESSION["user_id"])){
        if(check_logged($_SESSION["user_id"], $_COOKIE["user_token"])){

        }else{
            header("Location:login.php");
        }
    }
    else{
        header("Location:login.php");
    }
}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <?php include('static/header.php'); ?>
    <title>Historique</title>
  </head>

  <body>
    <div class="corps">
    <?php include('static/navbar.php'); ?>

    <h1>Mon Compte</h1>

    <div>
      <ul class="nav nav-tabs">
        <li id="tab1"><a href="moncompte.php">Mes informations</a></li>
        <li class="active"><a href="historique.php">Mon historique d'itinéraire</a></li>
    </ul>
  </div>
</div>

  </body>
</html>
