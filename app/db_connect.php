<?php
/**
 *
 */
class DB
{
  private static $instance = null;
  public static function get( $config_db = array() ){
    if(self::$instance == null){
      if( empty($config_db['driver']) ||
          empty($config_db['host']) ||
          empty($config_db['dbname']) ||
          empty($config_db['username']) ||
          empty($config_db['passwd'])
      ){
        header('HTTP/1.0 500 Internal Server Error');
        echo "Les données de configuration de la base de données ne sont pas complet";
    		exit();
      }
      try {
        self::$instance = new PDO( $config_db['driver'].':host='.$config_db['host'].';dbname='.$config_db['dbname'], $config_db['username'], $config_db['passwd'] );
      } catch (PDOException $e) {
        header('HTTP/1.0 500 Internal Server Error');
        echo "Configuration de la base de données n'est pas valide";
    		exit();
      }
    }
    return self::$instance;
  }
}

 ?>
