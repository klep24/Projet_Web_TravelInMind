<?php
    require_once("utils.php");

    try {
        $connection = new PDO('mysql:host=localhost;dbname=TravelInMind', 'root', '720153Mg7Jre');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        call_station_function($connection);
    } catch (Exception $i) {
        echo $i;
    } catch (PDOException $e) {
        echo $e;
    }

    function call_station_function($connection)
    {
        $method = $_SERVER[REQUEST_METHOD];
        if($method == "POST"){
            $station_id = check_station_exists($connection, $_REQUEST["station_id"]);
            $station_name = check_station_name_exists($connection, $_REQUEST["station_name"]);
            if($station_name&&$station_id){
                create_station($connection,$station_id, $station_name);
            }else{
                if(!$station_name)
                    echo "Ce nom de station existe déjà\n";
                if(!$station_id)
                    echo "Cet identifiant de station existe déjà\n";
            }
        }elseif($method == "DELETE"){
                $phpincluderegex="/[\w_]+=[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,\.0-9@\-':]*/";
                $data = file_get_contents("php://input");
                //echo $data;
                $datarray = array();
                $test = preg_match_all($phpincluderegex, $data, $datarray);
                foreach($datarray[0] as $key=>$value){
                    $temparray[explode("=", $value)[0]] = explode("=", $value)[1];
                }
                $station_id = check_station_exists($connection, $temparray["station_id"]);
                if(!$station_id){
                    $station_id = $temparray["station_id"];
                    delete_station($connection, $station_id);
                }else{
                    echo "Cette station n'existe pas\n";
                }
        }elseif($method == "PUT"){
            $phpincluderegex="/[\w_]+=[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,\.0-9@\-':]*/";
            $data = file_get_contents("php://input");
            //echo $data;
            $datarray = array();
            $test = preg_match_all($phpincluderegex, $data, $datarray);
            foreach($datarray[0] as $key=>$value){
                $temparray[explode("=", $value)[0]] = explode("=", $value)[1];
            }
            $station_id = check_station_exists($connection, $temparray["station_id"]);
            $station_name = check_station_name_exists($connection, $temparray["station_name"]);
            if(!$station_id&&$station_name){
                $station_id = $temparray["station_id"];
                $station_name = $temparray["station_name"];
                update_station($connection, $station_id, $station_name);
            }else{
                if(!$station_name)
                    echo "Ce nom de station existe déjà\n";
                if($station_id)
                    echo "Cette station n'existe pas";
            }
        }elseif($method == "GET"){
            $station_id = $_REQUEST["station_id"];
            $station_name = $_REQUEST["station_name"];
            find_station($connection, $station_id, $station_name);
        }else{
            echo "Méthode non reconnue";
        }
    }

    function create_station($connection, $station_id, $station_name)
    {
        $query = "INSERT INTO `station` (`station_id`, `station_name`) VALUES (:station_id, :station_name);";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':station_id', $station_id, PDO::PARAM_STR);
        $prepared_query->bindParam(':station_name', $station_name, PDO::PARAM_STR);

        $result = $prepared_query->execute();

        return $result;
    }

    function delete_station($connection, $station_id)
    {
        $query = "DELETE FROM `station` WHERE `station_id` = :station_id;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':station_id', $station_id, PDO::PARAM_STR);

        $executed = $prepared_query->execute();
    }

    function update_station($connection, $station_id, $station_name)
    {
        $query = "UPDATE `station` SET `station_name` = :station_name WHERE `station_id`=:station_id;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':station_id', $station_id, PDO::PARAM_STR);
        $prepared_query->bindParam(':station_name', $station_name, PDO::PARAM_STR);

        $result = $prepared_query->execute();

        return $result;
    }

    function get_stations($connection)
    {
        $query = "SELECT * FROM `station`;";

        $prepared_query = $connection->prepare($query);

        $executed = $prepared_query->execute();

        $result = $prepared_query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function check_station_exists($connection, $station_id)
    {
        if(is_null($station_id)){
            return null;
        }
        $query = "SELECT * FROM `station`  WHERE `station_id` = :station_id;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':station_id', $station_id, PDO::PARAM_STR);

        $executed = $prepared_query->execute();

        if($prepared_query->rowCount()==0)
        {
            return $station_id;
        }else{
            return false;
        }
    }

    function find_station($connection, $station_id, $station_name)
    {
        $query = "SELECT * FROM `station` WHERE `station_id`=:station_id OR `station_name`=:station_name;";

        $prepared_query = $connection->prepare($query);

        if (is_null($station_id) || empty($station_id)) {
            $station_id = "%";
        }
        if (is_null($station_name) || empty($station_name)) {
            $station_name = "%";
        }

        $prepared_query->bindParam(":station_id", $station_id, PDO::PARAM_STR);
        $prepared_query->bindParam(":station_name", $station_name, PDO::PARAM_STR);

        $executed = $prepared_query->execute();

        $result = $prepared_query->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);
        return $result;
    }

    function check_station_name_exists($connection, $station_name)
    {
        $query = "SELECT * FROM `station` WHERE `station_name`=:station_name;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(":station_name", $station_name, PDO::PARAM_STR);

        $executed = $prepared_query->execute();

        if($prepared_query->rowCount()==0)
        {
             return $station_name;
        }else{
            return false;
        }
    }
?>
