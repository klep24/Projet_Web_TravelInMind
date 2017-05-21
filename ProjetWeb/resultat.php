<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css">
    <script language="javascript" type="text/javascript" src="jquery-1.9.1.min.js"></script>
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
                 
                 var buttom='<input type="button" name="select" class="select" value="Selectionner ce train">';
                 var thead='<thead><tr><th>ID</th><th>Départ</th><th>Arrivé</th><th>Changement</th><th>Heure</th><th>Durée</th></tr></thead>';

                 $('#result').append("<table>"+thead+"<tbody><tr><td>"+ID+"</td><td>"+D+"</td><td>"+A+"</td><td>"+Chg+"</td><td>"+H+"</td><td>"+Duree+"</td></tr></tbody></table>"+buttom)
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
 