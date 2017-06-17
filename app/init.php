<?php
	require_once __DIR__.'/db_connect.php';
  require_once __DIR__.'/api_sncf_connect.php';

	$file_config = __DIR__.'/../config/app.ini';
	if( !file_exists($file_config) ){
		header('HTTP/1.0 500 Internal Server Error');
    echo "Le fichier de configuration n'est pas accessible";
		exit();
	}

	$app_config = parse_ini_file($file_config, true);
	$_GLOBALS['config_app'] = $app_config;

	$db_instance = DB::get($app_config['db_section']);
  $apiSNCF_instance = Api_SNCF::get($app_config['api_sncf']);

?>
