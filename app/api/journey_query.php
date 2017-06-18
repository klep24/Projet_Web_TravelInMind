<?php
require_once __DIR__.'/station.php';
include __DIR__."/../init.php";

function sub_HHMMSS($time_stop, $time_start)
{
  if( preg_match('#^([01][0-9]|2[0-3])([0-5][0-9]){2}$#', $time_stop )  // Good format HHMMSS
      && preg_match('#^([01][0-9]|2[0-3])([0-5][0-9]){2}$#', $time_start )
    ){
      $HH_stop = intval(substr( $time_stop, 0, 2 ));
      $MM_stop = intval(substr( $time_stop, 2, 2 ));
      $SS_stop = intval(substr( $time_stop, 4, 2 ));
      $timestamp_stop = $HH_stop * 3600 + $MM_stop * 60 + $SS_stop;


      $HH_start = intval(substr( $time_start, 0, 2 ));
      $MM_start = intval(substr( $time_start, 2, 2 ));
      $SS_start = intval(substr( $time_start, 4, 2 ));
      $timestamp_start = $HH_start * 3600 + $MM_start * 60 + $SS_start;

      $timestamp_diff = $timestamp_stop - $timestamp_start;

      if( $timestamp_diff < 0 )
        $timestamp_diff += 24*3600;


      $HH_diff = (int)($timestamp_diff/3600);

      $timestamp_diff = $timestamp_diff % 3600;
      $MM_diff = (int)($timestamp_diff/60);

      $SS_diff = $timestamp_diff % 60;

      $str_to_return = strval($HH_diff)."h".($MM_diff<=9?'0':'').strval($MM_diff);

      return $str_to_return; //output format HHhMM
    }else{
      return "Format date invalide ...";
    }
}

static $map_mouth = [ '1' => "janvier", '2' => "février", '3' => "mars", '4' => "avril",
                      '5' => "mai", '6' => "juin", '7' => "juillet", '8' => "août",
                      '9' => "septembre", '10' => "octobre", '11' => "novembre", '12' => "décembre"
                    ];

if (  $_REQUEST['station_start'] &&
      $_REQUEST['station_stop'] &&
      $_REQUEST['time_start'] &&
      preg_match('#^[0-9]{8}T[0-9]{6}$#',$_REQUEST['time_start'])
   ) {
  $result = Api_SNCF::get()->query('journey', array(  'station_start' => $_REQUEST['station_start'],
                                                      'station_stop'  => $_REQUEST['station_stop'],
                                                      'time_start'    => $_REQUEST['time_start']
                                                    )
                                  );

  $arr_disruptions = array();
  foreach ($result['disruptions'] as $one_disruptions) {
    if( $one_disruptions['status'] == 'active' ){
      $arr_disruptions[$one_disruptions['id']] = array(
                                                        'cause' => $one_disruptions['cause'],
                                                        'status' => $one_disruptions['status'],
                                                        'name' => $one_disruptions['severity']['name'],
                                                        'updated_at' => $one_disruptions['updated_at'],
                                                        'impacted_trips' => array()
                                                      );
      foreach ($one_disruptions['impacted_objects'] as $one_impacted_object) {
        $arr_impacted_stops = array();
        foreach ($one_impacted_object['impacted_stops'] as $one_impacted_stops) {
          $arr_impacted_stops[$one_impacted_stops['stop_point']['name']] = $one_impacted_stops;
        }

        $arr_disruptions[$one_disruptions['id']]['impacted_trips'][$one_impacted_object['pt_object']['id']] = $arr_impacted_stops;
      }
    }
  }

  $arr_to_return = array( journeys => array() );

  if( $result['journeys'] ){
    foreach ($result['journeys'] as $id_journey => $one_journey) {

      if( isset($one_journey['departure_date_time'])
          && isset($one_journey['arrival_date_time'])
          && isset($one_journey['sections'])
          && ($nb_sections = count($one_journey['sections']))
          && isset($one_journey['sections']['0']['to']['stop_point']['name'])
          && isset($one_journey['sections'][$nb_sections-1]['from']['stop_point']['name'])
        )
      {
        $date_start = new DateTime($one_journey['departure_date_time']);
        $date_stop  = new DateTime($one_journey['arrival_date_time']);
        $duration   = $date_stop->diff( $date_start );

        $processed_journey = array( 'date_start'    => $date_start->format('j').' '.$map_mouth[$date_start->format('n')],
                                    'time_start'    => $date_start->format('G\hi'),
                                    'time_stop'     => $date_stop->format('G\hi'),
                                    'duration'      => $duration->format('%hh%imn'),
                                    'station_start' => $one_journey['sections']['0']['to']['stop_point']['name'],
                                    'station_stop'  => $one_journey['sections'][$nb_sections-1]['from']['stop_point']['name'],
                                    'nb_connections'=> -1,
                                    'sections'      => array()
                                  );
        foreach ($one_journey['sections'] as $id_section => $one_section) {
          if( isset( $one_section['from']['embedded_type'] )
              && $one_section['from']['embedded_type'] == "stop_point"
              && isset( $one_section['display_informations']['headsign'] )
            ){
              $flag_terminus = $one_section['to']['name'] == $one_section['display_informations']['direction'];

              $flag_delay = false;
              $current_disurption = null;
              foreach ($one_section['display_informations']['links'] as $one_section_disruption) {
                if( !$flag_delay ){
                  if(isset($arr_disruptions[$one_section_disruption['id']])){
                    $flag_delay = true;
                    $current_disurption = $arr_disruptions[$one_section_disruption['id']];
                  }
                }
              }

              $delay_value = '';
              $cause_value = '';
              if( $flag_delay ){
                $RT_station_stop = current($current_disurption['impacted_trips'])[$one_section['to']['stop_point']['name']];

                switch ($RT_station_stop['arrival_status']) {
                  case 'delayed':
                    $RT_time_stop = $RT_station_stop['amended_arrival_time'];
                    $time_stop = $RT_station_stop['base_arrival_time'];
                    $delay_value = sub_HHMMSS($RT_time_stop, $time_stop);
                    $cause_value = $RT_station_stop['cause'];
                    break;

                  case 'deleted':
                    $delay_value = '\x404';
                    $cause_value = $RT_station_stop['cause'];
                    break;

                  case 'unchanged':
                  case 'added':
                    $flag_delay = false;
                    break;

                  default:
                    $delay_value = 'Erreur';
                    break;
                }
              }

              $date_start = new DateTime($one_section['departure_date_time']);
              $date_stop  = new DateTime($one_section['arrival_date_time']);
              $duration   = $date_stop->diff( $date_start );

              $processed_section = array( 'num_train' => $one_section['display_informations']['headsign'],
                                          'type_train' => $one_section['display_informations']['commercial_mode'],
                                          'time_start' => $date_start->format('G\hi'),
                                          'time_stop' => $date_stop->format('G\hi'),
                                          'duration' => $duration->format('%hh%imn'),
                                          'station_start' => $one_section['from']['stop_point']['name'],
                                          'station_stop' => $one_section['to']['stop_point']['name'],
                                          'station_direction' => $flag_terminus?'(terminus)':'(dir. '.trim(explode('(',$one_section['display_informations']['direction'])[0]).')',
                                          'delays' => $flag_delay?($delay_value=='\x404'?"Supprimé":"Retard de ".$delay_value):'A l\'heure',
                                          'cause_delay' => $flag_delay?$cause_value:'',
                                          'issue' => $flag_delay
                                        );
              array_push( $processed_journey['sections'], $processed_section );
              $processed_journey['nb_connections']++;
            }
        }
      }
      array_push($arr_to_return['journeys'], $processed_journey);
    }
  }
}else{
  $arr_to_return = array('error' => 'Le format des paramètres n\'est pas correcte' );
}
header('Content-type: application/json; charset=utf-8');
echo json_encode( $arr_to_return, JSON_FORCE_OBJECT );
?>
