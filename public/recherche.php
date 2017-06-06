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

      <div id="result">Je suis la div à remplacer</div>

	  <script id="source" language="javascript" type="text/javascript">

                  $(document).ready(function () 
          {
             $('#result').empty();
            //-----------------------------------------------------------------------
            // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
            //-----------------------------------------------------------------------
            $.ajax({                                      
              url: 'api.php',                  //the script to call to get data          
              data: "",                        //you can insert url argumnets here to pass to api.php
                                               //for example "id=5&parent=6"
              dataType: 'json',                //data format      
              success: function(rows)          //on recieve of reply
              {
      
            
               for (var i in rows)
               {

                 var row = rows[i];          

         var ID=row["ID"];
                 var D=row["Depart"];
                 var A=row["Arrive"];
                 var H=row["Heure"];
                 var Duree=row["Duree"];
                 var Chg=row["Changement"];
                 
                 var buttom='<input type="button" name="select" class="select" value="Selectionner">';
                 var thead='<thead><tr><th>ID</th><th>Départ</th><th>Arrivé</th><th>Changement</th><th>Heure</th><th>Durée</th></tr></thead>';

                 var collapse_head = '<div class="panel-group" id="accordion"><div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse'
        var id_collapse_head=i+'">'
                 var fin_collapse_head='</a></h4></div>'
                
                var collapse_body = '<div id="collapse'+i+'" class="panel-collapse collapse in"><div class="panel-body">'
                var fin_collapse_body =' </div></div></div></div>'
                
          
                 //$('#result').append("
                 var tableau= "<table>"+thead+"<tbody><tr><td>"+ID+"</td><td>"+D+"</td><td>"+A+"</td><td>"+Chg+"</td><td>"+H+"</td><td>"+Duree+"</td></tr></tbody></table>"
                 
                 $('#result').append(collapse_head+id_collapse_head+tableau+fin_collapse_head+collapse_body+"je suis une description de trajet"+buttom+fin_collapse_body)
                          .append("");
               } 
             } 
            });
          }); 
      </script>


    </div>
  </div>
</div>

  </body>

 </html>
