<?php
require_once __DIR__."/../api_sncf_connect.php";

$arr_to_return = array();

if ($_REQUEST['q'] && preg_match('#^[a-zA-Z0-9 ]+$#',$_REQUEST['q'])) {
  //https://api.sncf.com/v1/coverage/sncf/pt_objects?type%5B%5D=stop_area&q=Beauvais&
  $url_api = Api_SNCF::get()->getUrlBase;
  Api_SNCF::get()->query("https://api.sncf.com/v1/coverage/sncf/pt_objects?type%5B%5D=stop_area&q=Beauvais&");
}
  return json_encode( $arr_to_return, JSON_FORCE_OBJECT );
?>
