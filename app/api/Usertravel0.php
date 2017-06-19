<?php
    require_once("utils.php");

    try {
        $connection = new PDO('mysql:host=localhost;dbname=TravelInMind', 'root', '720153Mg7Jre');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        call_user_function($connection);
    } catch (Exception $i) {
        echo $i;
    } catch (PDOException $e) {
        echo $e;
    }

    function call_user_function($connection)
    {
        $method = $_SERVER[REQUEST_METHOD];
        if ($method == "POST") {
            print_r($_REQUEST);
            $usertravel_user = $_REQUEST["usertravel_user"];
            $usertravel_journey_id = $_REQUEST["usertravel_journey_id"];
            $usertravel_journey_data = $_REQUEST["usertravel_journey_data"];
            $usertravel_followed =  $_REQUEST["usertravel_followed"];
            echo $usertravel_user;
            echo $usertravel_journey_id;
            echo $usertravel_journey_data;
            if ($usertravel_user&&$usertravel_journey_id&&$usertravel_journey_data) {
                    create_usertravel($connection,$usertravel_user,$usertravel_journey_id, $usertravel_journey_data,$usertravel_followed);
            } else {
                echo "Erreur POST";
            }
        } elseif ($method == "GET") {
            $usertravel_id = $_REQUEST["usertravel_id"];
            $usertravel_user = $_REQUEST["usertravel_user"];
            $usertravel_journey_id = $_REQUEST["usertravel_journey_id"];
            $usertravel_journey_data = $_REQUEST["usertravel_journey_data"];
            $usertravel_followed =  $_REQUEST["usertravel_followed"];
            find_usertravel($connection, $usertravel_user, $usertravel_journey_id, $usertravel_journey_data, $usertravel_followed, $usertravel_id);
        } elseif ($method == "DELETE") {
            $phpincluderegex="/[\w_]+=[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,\.0-9@\-']*/";
            $data = file_get_contents("php://input");
            $datarray = array();
            $test = preg_match_all($phpincluderegex, $data, $datarray);
            foreach($datarray[0] as $key=>$value){
                $temparray[explode("=", $value)[0]] = explode("=", $value)[1];
            }
            $usertravel_id = check_usertravel_id_exists($connection, $temparray["usertravel_id"]);
            if ($usertravel_id) {
                delete_usertravel($connection, $usertravel_id);
            } else {
                echo "Erreur DELETE ";
            }
        }elseif ($method == "PUT") {
            $phpincluderegex="/[\w_]+=[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,\.0-9@\-']*/";
            $data = file_get_contents("php://input");
            $datarray = array();
            $test = preg_match_all($phpincluderegex, $data, $datarray);
            foreach($datarray[0] as $key=>$value){
                $temparray[explode("=", $value)[0]] = explode("=", $value)[1];
            }
            $usertravel_id = $temparray["usertravel_id"];
            $usertravel_user = $temparray["usertravel_user"];
            $usertravel_journey_id = $temparray["usertravel_journey_id"];
            $usertravel_journey_data = $temparray["usertravel_journey_data"];
            $usertravel_followed =  $temparray["usertravel_followed"];
            if ($usertravel_id&&$usertravel_user&&$usertravel_journey_id&&$usertravel_journey_data) {
                update_usertravel($connection, $usertravel_user, $usertravel_journey_id, $usertravel_journey_data, $usertravel_followed, $usertravel_id);
            } else {
                echo "Erreur PUT";
            }
        } else {
            echo "Erreur : Méthode non reconnue";
        }
    }
    //
    function create_usertravel($connection,$usertravel_user,$usertravel_journey_id,$usertravel_journey_data,$usertravel_followed)
    {
        $query = "INSERT INTO `usertravel`(`usertravel_id`, `usertravel_user`, `usertravel_journey_id`, `usertravel_journey_data`, `usertravel_followed`) VALUES (:usertravel_id, :usertravel_user, :usertravel_journey_id, :usertravel_journey_data, :usertravel_followed);";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindValue(':usertravel_id', null, PDO::PARAM_INT);
        $prepared_query->bindParam(':usertravel_user', $usertravel_user, PDO::PARAM_INT);
        $prepared_query->bindParam(':usertravel_journey_id', $usertravel_journey_id, PDO::PARAM_STR);
        $prepared_query->bindParam(':usertravel_journey_data', $usertravel_journey_data,PDO::PARAM_STR);
        $prepared_query->bindParam(':usertravel_followed', $usertravel_followed,PDO::PARAM_INT);

        $result = $prepared_query->execute();

    }
    //
    function delete_usertravel($connection, $usertravel_id)
    {
        $query = "DELETE FROM `usertravel` WHERE `usertravel_id` = :usertravel_id;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':usertravel_id', $usertravel_id);

        $executed = $prepared_query->execute();

    }
    //
    function update_usertravel($connection, $usertravel_user, $usertravel_journey_id, $usertravel_journey_data, $usertravel_followed, $usertravel_id){
    // {
        $query = "UPDATE `usertravel` SET `usertravel_id` = :usertravel_id, `usertravel_user` = :usertravel_user, `usertravel_journey_id`=:usertravel_journey_id, `usertravel_journey_data`=:usertravel_journey_data, `usertravel_followed`=:usertravel_followed WHERE `usertravel_id`=:usertravel_id;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':usertravel_id', $usertravel_id, PDO::PARAM_INT);
        $prepared_query->bindParam(':usertravel_user', $usertravel_user, PDO::PARAM_INT);
        $prepared_query->bindParam(':usertravel_journey_id', $usertravel_journey_id, PDO::PARAM_STR);
        $prepared_query->bindParam(':usertravel_journey_data', $usertravel_journey_data,PDO::PARAM_STR);
        $prepared_query->bindParam(':usertravel_followed', $usertravel_followed,PDO::PARAM_INT);

        $result = $prepared_query->execute();

        return $result;
    }

    function get_usertravel($connection)
    {
        $query = "SELECT * FROM `usertravel`;";

        $prepared_query = $connection->prepare($query);

        $result = $prepared_query->execute();

        return $result;
    }
    //
    function find_usertravel($connection, $usertravel_user, $usertravel_journey_id, $usertravel_journey_data, $usertravel_followed, $usertravel_id)
    {
        $query = "SELECT * FROM `usertravel` WHERE `usertravel_id`= :usertravel_id OR `usertravel_user` = :usertravel_user OR `usertravel_journey_id`= :usertravel_journey_id OR `usertravel_journey_data` = :usertravel_journey_data OR `usertravel_followed` = :usertravel_followed ;";

        if (is_null($usertravel_user) || empty($usertravel_user)) {
            $usertravel_user = "%";
        }
        if (is_null($usertravel_journey_id) || empty($usertravel_journey_id)) {
            $usertravel_journey_id = "%";
        }
        if (is_null($usertravel_journey_data) || empty($usertravel_journey_data)) {
            $usertravel_journey_data = "%";
        }
        if (is_null($usertravel_followed) || empty($usertravel_followed)) {
            $usertravel_followed = "%";
        }
        if (is_null($usertravel_id) || empty($usertravel_id)) {
            $usertravel_id = "%";
        }

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':usertravel_id', $usertravel_id, PDO::PARAM_INT);
        $prepared_query->bindParam(':usertravel_user', $usertravel_user, PDO::PARAM_INT);
        $prepared_query->bindParam(':usertravel_journey_id', $usertravel_journey_id, PDO::PARAM_STR);
        $prepared_query->bindParam(':usertravel_journey_data', $usertravel_journey_data,PDO::PARAM_STR);
        $prepared_query->bindParam(':usertravel_followed', $usertravel_followed,PDO::PARAM_INT);


        $executed = $prepared_query->execute();
        $result = $prepared_query->fetchAll(PDO::FETCH_ASSOC);

    }
    //
    // function find_usertravel_user($connection, $usertravel_user)
    // {
    //     $query = "SELECT * FROM `usertravel` WHERE `usertravel_user`=:usertravel_user;";
    //
    //     $prepared_query->bindParam(':usertravel_user', $usertravel_user);
    //
    //     $prepared_query = $connction->prepare($query);
    //
    //     $result = $prepared_query->execute();
    //
    //     return $result;
    // }
    //
    function check_usertravel_id_exists($connection, $usertravel_id)
    {
        $query = "SELECT * FROM `usertravel` WHERE `usertravel_id`= :usertravel_id;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':usertravel_id', $usertravel_id, PDO::PARAM_INT);

        $executed = $prepared_query->execute();

        if ($prepared_query->rowCount()>0) {
            return $usertravel_id;
        } else {
            return false;
        }
    }
