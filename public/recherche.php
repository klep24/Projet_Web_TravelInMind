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
          'logger' => new Mustache_Logger_StreamLogger(dirname(__FILE__).'/../app/template/log/log.txt', Mustache_Logger::DEBUG)
        ));
       $arr_context = array();
       $arr_context = json_decode(file_get_contents( "http://".$_SERVER['SERVER_NAME'].'/api.php?type=journey&station_start='.$_REQUEST['station_start'].'&station_stop='.$_REQUEST['station_stop'].'&time_start='.$_REQUEST['time_start']), true);


       echo $m->render('result_journeys', $arr_context);
     ?>
     <br><br><br>

      </div>








<!-----------------------FIN-RESULT---------------------->













    </div>
  </div>

  </body>

</html>
