<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css">
    <title>Mon itinéraire</title>
  </head>

  <body>
    <div>
      <img src="image/TGV-SNCF.jpg">
    </div>

    <nav class="navbar navbar-default navbar-fixed-top">
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
            <li class="active"><a href="#">Mon itinéraire</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Connexion</a></li>
          </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
    </nav>

    <div>
      <h1>Mes itinéraires</h1>
	 
	<table>
		<thead>
			<tr>
			   <th>Numero</th>
			   <th>Départ</th>
			   <th>Arrivé</th>
			   <th>Etat</th>
			   <th>Gerer</th>
			</tr>
		</thead>
	   

	   <tbody>
			<tr>
				<td>1</td>
				<td>Nancy</td>
				<td>Bourges</td>
				<td>Active</td>
				<td>
					
					<a href="" >Modifier </a><br>
					<a href="">Supprimer</a><br>
					<a href="">Ne plus suivre</a><br>
				</td>
			</tr>
			
			<tr>
				<td>2</td>
				<td>Bourges</td>
				<td>Orleans</td>
				<td>Desactivé</td>
				<td>
					
					<a href="" >Modifier </a><br>
					<a href="">Supprimer</a><br>
					<a href="">Ne plus suivre</a><br>
				</td>
			</tr>
			
			<tr>
				<td>3</td>
				<td>Paris</td>
				<td>Nice</td>
				<td>Active</td>
				<td>
					
					<a href="" >Modifier </a><br>
					<a href="">Supprimer</a><br>
					<a href="">Ne plus suivre</a><br>
				</td>
			</tr>
		</tbody>
   
	</table>

    </div>

  </body>
</html>
