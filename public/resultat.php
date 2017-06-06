<!DOCTYPE html>
<html>
  <head>
    <!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
    <title>Recherche</title>
  </head>

  <body>
  
  <div class="top">
      <img  src="image/TGV-SNCF.jpg">
      <nav id="menu"class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                  </button>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Accueil</a></li>
                  </ul>
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="Monitineraire.php">Mon itinéraire</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Connexion</a></li>
                  </ul>


                  <!-- <?php
                  if ($connecter == false) {
                    echo '<ul class="nav navbar-nav navbar-right">
                            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Connexion</a></li>
                          </ul>';
                  }
                  else {
                    echo '<ul class="nav navbar-nav navbar-right">
                            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Déconnexion</a></li>
                          </ul>';
                  }
                  ?> -->

                </div>
          </div>
        </nav>
    </div>
  


<div class="container">
  <div class="row">
    <div class="col-sm-4">
    <div class="recherche">
      <p class="recherche">Départ</p>
      <input type="text" name="depart" class="recherche">
      <p class="recherche">Arrivée</p>
      <input type="text" name="arrivee" class="recherche">
      <input type="button" name="search" class="recherche" value="Rechercher">
      <br/>
    </div>
   
      
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
 