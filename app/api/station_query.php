<?php
require_once __DIR__.'/station.php';
include __DIR__."/../init.php";

$arr_to_return = array();

if ($_REQUEST['q'] && preg_match('#^[a-zA-Z0-9 ]+$#',$_REQUEST['q'])) {
  $result = Api_SNCF::get()->query($_REQUEST['type'], array('query' => $_REQUEST['q']));
  if( $result['pt_objects'] ){
    foreach ($result['pt_objects'] as $id => $one_stop_area) {
      $processed_stop_area = array();
      $processed_stop_area['name'] = $one_stop_area['stop_area']['name'];
      $processed_stop_area['id'] = $one_stop_area['stop_area']['id'];
      array_push($arr_to_return, $processed_stop_area);
    }
  }
}
  header('Content-type: application/json; charset=utf-8');
  echo json_encode( $arr_to_return, JSON_FORCE_OBJECT );
?>
