<?php

switch ($_REQUEST['type']) {
  case 'station':
    require __DIR__."/../app/api/station_query.php";
    exit(0);

  case 'journey':
    require __DIR__."/../app/api/journey_query.php";
    exit(0);

  default:
    break;
}

?>
