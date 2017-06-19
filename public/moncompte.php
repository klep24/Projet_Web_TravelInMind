<?php
require_once("APIInterface.php");
session_start();
if(isset($_COOKIE["user_token"])){
    if(isset($_SESSION["user_id"])){
        if(check_logged($_SESSION["user_id"], $_COOKIE["user_token"])){
            $user = json_decode(find_users($_SESSION["user_id"], "%", "%", "%", "%", "%", "%", "%", "%"), true)[0];
        }else{
            header("Location:login.php");
        }
    }
    else{
        header("Location:login.php");
    }
}else{
    header("Location:login.php");
}
?>
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
                <h3 class="panel-title"><?php echo ($user["user_firstname"]." ".$user["user_lastname"]) ; ?> </h3>
          </div>
          <div class="panel-body">
            <div class="rowInfos">
              <div class=" col-md-9 col-lg-9 ">
                <table class="table table-user-information">
                  <tbody>
                    <tr>
                      <tr>
                        <td>Email</td>
                        <td><?php echo($user["user_mail"])?></td>
                      </tr>
                      <tr>
                        <td>Mot de passe</td>
                        <td>********</td>
                      </tr>
                      <tr>
                        <td>Gare Favorite</td>
                        <td><?php $station = json_decode(find_station($user["user_favstation"], "%"), true)[0]; echo($station["station_name"]); ?></td>
                      </tr>
                        <td>N° de téléphone</td>
                        <td><?php echo($user["user_phone"]);?></td>
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
