<?php
/**
 *
 */
class Api_SNCF
{
  private $url_base = null;
  private $key = null;

  private function __construct( $_url_base, $_key ){
    $this->url_base = $_url_base;
    $this->key = $_key;
  }

  public function getUrlBase(){
    return $this->url_base;
  }

  public function getKey(){
    return $this->key;
  }

  public function query( $url ){
    $cl = curl_init();
    $options = array( CURLOPT_URL => $url,
                      CURLOPT_HEADER => TRUE
                    );
    curl_setopt_array($cl, $options);
    $output = curl_exec($cl);
    curl_close($cl);

    print_r($cl);
  }

  private static $instance = null;
  public static function get( $config_apisncf = array() ){
    if(self::$instance == null){
      if( empty($config_apisncf['key']) ||
          empty($config_apisncf['url_base'])
      ){
        header('HTTP/1.0 500 Internal Server Error');
        echo "Les données de configuration de l'API SNCF ne sont pas complet";
    		exit();
      }
      self::$instance = new Api_SNCF( $config_apisncf['url_base'], $config_apisncf['key'] );
    }
    return self::$instance;
  }
}

 ?>
