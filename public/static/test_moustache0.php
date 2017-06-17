<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tests Résultats</title>
  </head>
  <body>
    <?php

      require __DIR__."/../../app/vendor/autoload.php";

      $m = new Mustache_Engine(array(
         'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/../../app/template'),
         'logger' => new Mustache_Logger_StreamLogger(dirname(__FILE__).'/../../app/template/log/log.txt', Mustache_Logger::DEBUG)
       ));
      //http://172.24.0.2/api.php?type=journey&station_start=stop_area:OCE:SA:87611004&station_stop=stop_area:OCE:SA:87581009&time_start=20170617T140000
      $arr_context = array();
      $arr_context = json_decode(file_get_contents( "http://".$_SERVER['SERVER_NAME'].'/api.php?type=journey&station_start='.$_REQUEST['station_start'].'&station_stop='.$_REQUEST['station_stop'].'&time_start='.$_REQUEST['time_start']), true);
      //print_r($arr_context);
      //exit(0);
      echo $m->render('result_journeys', $arr_context);

     ?>
  </body>
</html>
