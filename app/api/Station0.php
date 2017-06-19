<?php
    // function call_station_function($connection)
    // {
    //     $method = $_SERVER[REQUEST_METHOD];
    //     if($method == "POST"){
    //         $station_id = check_station_exists($connection, $_REQUEST["station_id"]);
    //         $station_name = check_station_name_exists($connection, $_REQUEST["station_name"]);
    //         if($station_name&&$station_id){
    //             create_station($connection,$station_id, $station_name);
    //         }else{
    //             if(!$station_name)
    //                 echo "Ce nom de station existe déjà\n";
    //             if(!$station_id)
    //                 echo "Cet identifiant de station existe déjà\n";
    //         }
    //     }elseif($method == "DELETE"){
    //             $phpincluderegex="/[\w_]+=[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,\.0-9@\-':]*/";
    //             $data = file_get_contents("php://input");
    //             //echo $data;
    //             $datarray = array();
    //             $test = preg_match_all($phpincluderegex, $data, $datarray);
    //             foreach($datarray[0] as $key=>$value){
    //                 $temparray[explode("=", $value)[0]] = explode("=", $value)[1];
    //             }
    //             $station_id = check_station_exists($connection, $temparray["station_id"]);
    //             if(!$station_id){
    //                 $station_id = $temparray["station_id"];
    //                 delete_station($connection, $station_id);
    //             }else{
    //                 echo "Cette station n'existe pas\n";
    //             }
    //     }elseif($method == "PUT"){
    //         $phpincluderegex="/[\w_]+=[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,\.0-9@\-':]*/";
    //         $data = file_get_contents("php://input");
    //         //echo $data;
    //         $datarray = array();
    //         $test = preg_match_all($phpincluderegex, $data, $datarray);
    //         foreach($datarray[0] as $key=>$value){
    //             $temparray[explode("=", $value)[0]] = explode("=", $value)[1];
    //         }
    //         $station_id = check_station_exists($connection, $temparray["station_id"]);
    //         $station_name = check_station_name_exists($connection, $temparray["station_name"]);
    //         if(!$station_id&&$station_name){
    //             $station_id = $temparray["station_id"];
    //             $station_name = $temparray["station_name"];
    //             update_station($connection, $station_id, $station_name);
    //         }else{
    //             if(!$station_name)
    //                 echo "Ce nom de station existe déjà\n";
    //             if($station_id)
    //                 echo "Cette station n'existe pas";
    //         }
    //     }elseif($method == "GET"){
    //         $station_id = $_REQUEST["station_id"];
    //         $station_name = $_REQUEST["station_name"];
    //         find_station($connection, $station_id, $station_name);
    //     }else{
    //         echo "Méthode non reconnue";
    //     }
    // }

    function create_station($station_id, $station_name)
    {
        $connection = new PDO('mysql:host=localhost;dbname=TrainAssist_db', 'root', '720153Mg7Jre');
        $query = "INSERT INTO `station` (`station_id`, `station_name`) VALUES (:station_id, :station_name);";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':station_id', $station_id, PDO::PARAM_STR);
        $prepared_query->bindParam(':station_name', $station_name, PDO::PARAM_STR);

        $result = $prepared_query->execute();
    }

    function delete_station($station_id)
    {
        $connection = new PDO('mysql:host=localhost;dbname=TrainAssist_db', 'root', '720153Mg7Jre');
        $query = "DELETE FROM `station` WHERE `station_id` = :station_id;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':station_id', $station_id, PDO::PARAM_STR);

        $executed = $prepared_query->execute();
    }

    function update_station($station_id, $station_name)
    {
        $connection = new PDO('mysql:host=localhost;dbname=TrainAssist_db', 'root', '720153Mg7Jre');
        $query = "INSERT INTO `station` (`station_id`, `station_name`) VALUES (:station_id, :station_name) ON DUPLICATE KEY UPDATE `station_name`=:station_name WHERE `station_id` = :station_id;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':station_id', $station_id, PDO::PARAM_STR);
        $prepared_query->bindParam(':station_name', $station_name, PDO::PARAM_STR);

        $executed = $prepared_query->execute();
    }

    function get_stations()
    {
        $connection = new PDO('mysql:host=localhost;dbname=TrainAssist_db', 'root', '720153Mg7Jre');
        $query = "SELECT * FROM `station`;";

        $prepared_query = $connection->prepare($query);

        $executed = $prepared_query->execute();

        $result = $prepared_query->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($result);
    }



    function find_station($station_id, $station_name)
    {
        $connection = new PDO('mysql:host=localhost;dbname=TrainAssist_db', 'root', '720153Mg7Jre');
        $query = "SELECT * FROM `station` WHERE `station_id`=:station_id OR `station_name`=:station_name;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(":station_id", $station_id, PDO::PARAM_STR);
        $prepared_query->bindParam(":station_name", $station_name, PDO::PARAM_STR);

        $executed = $prepared_query->execute();

        $result = $prepared_query->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($result);
    }




?>
