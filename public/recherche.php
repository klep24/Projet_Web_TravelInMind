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
        <label>Date et heure de circulation: <?php /* echo $_GET['time_start'];*/ ?>
            <?php 

           $time_start=$_GET['time_start'];
           $day=substr($time_start,6,2);
           $month=substr($time_start,4,2);
           $year=substr($time_start,0,4);
           $heure=substr($time_start,9,2);
           $minute=substr($time_start,11,2);
           
           echo("Le ");
           echo ($day);
           echo ("-");
           echo $month;
           echo ("-");
           echo ($year);
           echo (" ");
           echo ("à ");
           echo ($heure);
           echo ("h");
           echo ($minute);        
          ?>
        </label><br>
        <button type="button" class="btn btn-success" onclick="document.location.href='index.php';">Modifier la recherche</button>
     </div>
<!-----------------------FIN-RESUME---------------------->

<hr>


<!-----------------------DEBUT-RESULT---------------------->
      <div class="RechercheResult">

          <?php
       require __DIR__."/../app/init.php";
       require __DIR__."/../app/vendor/autoload.php";

       $m = new Mustache_Engine(array(
          'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/../app/template'),
          'logger' => new Mustache_Logger_StreamLogger(dirname(__FILE__).'/../app/template/log/log.txt', Mustache_Logger::DEBUG)
        ));
       $arr_context = array();

       $url_base = $_GLOBALS['config_app']['general']['url_base'].$_SERVER['REQUEST_URI'];
       $url_base = substr($url_base, 0,  strrpos( $url_base, '/' )+1);
       $url = $url_base . 'api.php?type=journey&station_start='.$_REQUEST['station_start'].'&station_stop='.$_REQUEST['station_stop'].'&time_start='.$_REQUEST['time_start'];
//       echo $url;
       $cl = curl_init();
       $options = array( CURLOPT_URL => $url,
                         CURLOPT_HEADER => FALSE,
                         CURLOPT_RETURNTRANSFER => TRUE
                       );
       curl_setopt_array($cl, $options);
       $output = curl_exec($cl);
       curl_close($cl);


       $arr_context = json_decode($output, true);


       echo $m->render('result_journeys', $arr_context);
     ?>
     <br><br><br>

      </div>








<!-----------------------FIN-RESULT---------------------->













    </div>
  </div>

  </body>

</html>
