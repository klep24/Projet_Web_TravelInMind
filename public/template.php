<div class="journeys">
 {{# journeys}}

	<table class="journey">

	   <thead> <!-- En-tête du tableau -->
	       <tr class="entete">
	           <th>Durée</th>
	           <th>Correspondance</th>
	       </tr>

	       <tr class="colonnes">
	           <th>Horaires</th>
	           <th>Trajet</th>
	           <th>Type</th>
	           <th>Informations</th>
	       </tr>

	   </thead>

	   <tbody class="section"> <!-- Corps du tableau -->
	       {{# sections}}
	       <tr class="section">
	       	
	           <td class="horaires">
	           		<ul class="Liste_horaires">
		           		<li class="section_timesD">{{time_start}}</li>
		           		<li class="section_timesA">{{time_stop}}</li>
	           		</ul>
	           </td>


	           <td class="trajet">
	           		<ul class="Liste_trajet">
		           		<li class="section_stationD">{{station_start}}</li>
		           		<li class="section_stationA">{{station_stop}}</li>
	           		</ul>
	           	</td>

	           <td class="section_num_type_train">{{type_train}}<br>n°{{num_train}}</td>
	           <td class="infos">Départ à l'heure</td>
	       </tr>
	       {{/ sections}}
	   </tbody>
	</table>
	  {{/ journeys}}
	</div>