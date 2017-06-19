<!doctype html>
<html>

  <head>

    <title>Recherche</title>
    <?php include('static/header.php'); ?>

  </head>

  <body> 

    <div class="corps">
    <div class="chargeSearch">
      <?php include('static/navbar.php'); ?>

<!-----------------------RESUME---------------------->
      <div class="RechercheResume">
        <h1>Votre <span id="h1">Recherche</span></h1>

        <label>Depart: <?php echo $_GET['nom_dep']; ?> </label><br>
        <label>Arrivée: <?php echo $_GET['nom_arr']; ?> </label><br>
        <label>Date et heure de circulation: <?php echo $_GET['datetime']; ?></label><br>

        <button type="button" class="btn btn-success" onclick="document.location.href='index.php';">Modifier la recherche</button>
      </div>
<!-----------------------FIN-RESUME---------------------->

<hr>


<!-----------------------DEBUT-RESULT---------------------->
      <div class="RechercheResult">

          <?php
      require __DIR__."/../app/vendor/autoload.php";

      $m = new Mustache_Engine(array(
         'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/../app/template'),
       ));

      $arr_context = array('journeys' => array( array('date_start'    => '8 juin',
                                                      'time_start'    => '13h45',
                                                      'time_stop'     => '16h45',
                                                      'duration'      => '3h',
                                                      'station_start' => 'Paris',
                                                      'station_stop'  => 'Bourges',
                                                      'sections'      => array( array(  'num' => 1,
                                                                                        'num_train' => '04325',
                                                                                        'type_train' => 'Intercité',
                                                                                        'time_start' => '13h45',
                                                                                        'time_stop' => '16h15',
                                                                                        'duration' => '2h30mn',
                                                                                        'station_start' => 'Paris',
                                                                                        'station_stop' => 'Vierzon',
                                                                                        'station_direction' => 'Toulouse'
                                                                                     ),
                                                                                array( 'num' => 2,
                                                                                       'num_train' => '12325',
                                                                                       'type_train' => 'TER',
                                                                                       'time_start' => '16h25',
                                                                                       'time_stop' => '16h45',
                                                                                       'duration' => '0h20mn',
                                                                                       'station_start' => 'Vierzon',
                                                                                       'station_stop' => 'Bourges',
                                                                                       'station_direction' => 'Bourges'
                                                                                    )
                                                                           )
                                                    )
                                              )
                          );


      echo $m->render('result_journeys', $arr_context);

     ?>
     <br><br><br>

      </div>








<!-----------------------FIN-RESULT---------------------->













    </div>
  </div>

  </body>

</html>
