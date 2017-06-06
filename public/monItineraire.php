<!DOCTYPE html>
<html>
  <head>
    <?php include('static/header.php'); ?>
    <title>Mon itinéraire</title>
  </head>

  <body>
    <?php include('static/navbar.php'); ?>

    <div>
      <h1>Mon itinéraire</h1>

	<table class="itineraire">
		<thead class="itineraire">
			<tr>
			   <th class="itineraire">Numero</th>
			   <th class="itineraire">Départ</th>
			   <th class="itineraire">Arrivé</th>
			   <th class="itineraire">Etat</th>
			   <th class="itineraire">Gerer</th>
			</tr>
		</thead>


	   <tbody class="itineraire">
			<tr>
				<td class="itineraire">1</td>
				<td class="itineraire">Nancy</td>
				<td class="itineraire">Bourges</td>
				<td class="itineraire">Active</td>
				<td class="itineraire">

					<a href="" >Modifier </a><br>
					<a href="">Supprimer</a><br>
					<a href="">Ne plus suivre</a><br>
				</td>
			</tr>

			<tr>
				<td class="itineraire">2</td>
				<td class="itineraire">Bourges</td>
				<td class="itineraire">Orleans</td>
				<td class="itineraire">Desactivé</td>
				<td class="itineraire">

					<a href="" >Modifier </a><br>
					<a href="">Supprimer</a><br>
					<a href="">Ne plus suivre</a><br>
				</td>
			</tr>

			<tr>
				<td class="itineraire">3</td>
				<td class="itineraire">Paris</td>
				<td class="itineraire">Nice</td>
				<td class="itineraire">Active</td>
				<td class="itineraire">

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
