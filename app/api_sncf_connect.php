<?php
/**
 *
 */
class Api_SNCF
{
  private $url_base = null;
  private $key = null;
  private $url_type = array ( 'station' => 'coverage/sncf/pt_objects?type%5B%5D=stop_area&q=%query%&',
                              'journey' => 'coverage/sncf/journeys?from=%station_start%&to=%station_stop%&datetime=%time_start%&count=5',
                              'disruptions' => 'coverage/sncf/disruptions/%disruptions_id%/?'
                            );


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


  private function  _query( $url ){
    $cl = curl_init();
    $options = array( CURLOPT_URL => $url,
                      CURLOPT_HEADER => FALSE,
                      CURLOPT_USERPWD => $this->key,
                      CURLOPT_RETURNTRANSFER => TRUE
                    );
    curl_setopt_array($cl, $options);
    $output = curl_exec($cl);
    curl_close($cl);
    return json_decode($output, TRUE);
  }

  public function query( $type, $values )
  {
    if( $this->url_type[$type] ){
      $url = $this->url_base.$this->url_type[$type];
      foreach ($values as $key => $value) {
        $url = str_replace('%'.$key.'%',$value,$url);
      }
      return $this->_query($url);
    }
  }

  private static $instance = null;
  public static function get( $config_apisncf = array() ){
    if(self::$instance == null){
      if( !$config_apisncf['key'] ||
          !$config_apisncf['url_base'] ||
          empty($config_apisncf['key']) ||
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
