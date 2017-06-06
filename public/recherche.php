<!doctype html>
<html>
<head>
<title>Recherche</title>
<?php include('static/header.php'); ?>


</head>
<body>
  <?php include('static/navbar.php'); ?>
<div class="recherche">
  <div class="row">
    <div class="col-sm-4">
		<!-- <div class="recherche">
		  <p class="recherche">Départ</p>
		  <input type="text" name="depart" class="recherche">
		  <p class="recherche">Arrivée</p>
		  <input type="text" name="arrivee" class="recherche">
		  <input type="button" name="search" class="recherche" value="Rechercher">
		  <br/>
		</div> -->
    <div id="select_train2">
      <table class="table">
        <tr>
          <td class="label_table"><label for="gare_dep">Gare de départ :</label></td>
          <td>
            <div id="scrollable-menu-dep">
              <input id="gare_dep" class="typeahead"></input>
            </div>
          </td>
        </tr>
        <tr>
          <td class="label_table"><label for="gare_arr">Gare d'arrivée :</label></td>
          <td>
            <div id="scrollable-menu-arr">
              <input id="gare_arr" class="typeahead"></input>
            </div>
          </td>
        </tr>
        <tr>
          <td class="label_table"><label for="heure_dep">Heure de départ :</label></td>
          <td>
            <div id="select_hdep">
              <form>
                <select id="heure_dep" class="typeahead" size="1">
                  <?php
                    for ($h = 00; $h <= 24; $h++) {
                      for($m = 00; $m <= 30; $m = $m + 30) {
                        echo '<option value="'.$h.'h'.$m.'">'.$h.'h'.$m.'</option>';
                      }
                    }
                  ?>
                </select>
              </form>
            </div>
          </td>
        </tr>
        <tr>
          <td class="label_table"><label for="jour_dep">Jour de départ :</label></td>
          <td>
            <div id="calendar">
              <input type="text" id="jour_dep" class="typeahead"></p>
            </div>
          </td>
        </tr>

      </table>
      <input id="reset_train" class="btn btn-lg btn-warning" type="button" name="reset" value="Réinitialiser"></input>
      <input id="valid_train" class="disabled btn btn-lg btn-success" type="button" name="valid" value="Valider" onclick="document.location.href='recherche.php';"></input>
    </div>
      <br/>


    </div>
    <div class="col-sm-8">
      <h3>Resultats</h3>
	  <br>

      

	 


    </div>
  </div>
</div>

  </body>

 </html>
