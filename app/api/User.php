<?php
require_once  'utils.php';
 require_once "Station.php";
 require_once  'Usertravel.php';
echo("Coucou");
try {
    $connection = new PDO('mysql:host=localhost;dbname=TravelInMind', 'root', '720153Mg7Jre');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    call_user_function($connection);
} catch (Exception $i) {
    echo $i;
} catch (PDOException $e) {
    echo $e;
}
//
    function call_user_function($connection)
    {
        $method = $_SERVER[REQUEST_METHOD];
        if ($method == "POST") {
            $user_firstname = format_name($_REQUEST["user_firstname"]);
            $user_lastname = format_name($_REQUEST["user_lastname"]);
            $user_mail = check_mail(check_mail_exists($connection, $_REQUEST["user_mail"]));
            $user_phone = check_phone($_REQUEST["user_phone"]);
            $user_password =  check_password($_REQUEST["user_password"]);
            $user_favstation =  check_station_exists($connection, $_REQUEST["user_favstation"]);
            if (!$user_phone) {
                $user_phone=null;
            }
            if (!$user_favstation) {
                $user_favstation=null;
            }
            if ($user_firstname&&$user_lastname&&$user_mail&&$user_password) {
                    create_user($connection, $user_firstname, $user_lastname, $user_mail, $user_phone, $user_password, $user_favstation);
            } else {
                echo "Erreur POST";
            }
        } elseif ($method == "GET") {
            $user_id = $_REQUEST["user_id"];
            $user_firstname = format_name($_REQUEST["user_firstname"]);
            $user_lastname = format_name($_REQUEST["user_lastname"]);
            $user_mail = check_mail($_REQUEST["user_mail"]);
            $user_phone = check_phone($_REQUEST["user_phone"]);
            $user_password =  check_password($_REQUEST["user_password"]);
            $user_favstation =  check_station_exists($connection, $_REQUEST["user_favstation"]);
            find_users($connection, $user_firstname, $user_lastname, $user_mail, $user_phone, $user_password, $user_favstation, $user_id);
        } elseif ($method == "DELETE") {
            $phpincluderegex="/[\w_]+=[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,\.0-9@\-']*/";
            $data = file_get_contents("php://input");
            $datarray = array();
            $test = preg_match_all($phpincluderegex, $data, $datarray);
            foreach($datarray[0] as $key=>$value){
                $temparray[explode("=", $value)[0]] = explode("=", $value)[1];
            }
            $user_id = check_user_id_exists($connection, $temparray["user_id"]);
            if ($user_id) {
                delete_user($connection, $user_id);
            } else {
                echo "Erreur DELETE";
            }
        }elseif ($method == "PUT") {
            $phpincluderegex="/[\w_]+=[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,\.0-9@\-']*/";
            $data = file_get_contents("php://input");
            $datarray = array();
            $test = preg_match_all($phpincluderegex, $data, $datarray);
            foreach($datarray[0] as $key=>$value){
                $temparray[explode("=", $value)[0]] = explode("=", $value)[1];
            }
            $user_id  =$temparray["user_id"];
            $user_firstname =$temparray["user_firstname"];
            $user_lastname  =$temparray["user_lastname"];
            $user_mail=$temparray["user_mail"]  ;
            $user_phone =$temparray["user_phone"] ;
            $user_password =$temparray["user_password"];
            $user_favstation =$temparray["user_favstation"];
            if (!$user_phone) {
                $user_phone=null;
            }
            if (!$user_favstation) {
                $user_favstation=null;
            }
            if ($user_firstname&&$user_lastname&&$user_mail&&$user_password&&$user_id) {
                update_user($connection, $user_firstname, $user_lastname, $user_mail, $user_phone, $user_password, $user_favstation, $user_id);
            } else {
                echo "Erreur PUT";
            }
        } else {
            echo "Erreur : Méthode non reconnue";
        }
    }
//
    function create_user($connection, $user_firstname, $user_lastname, $user_mail, $user_phone, $user_password, $user_favstation)
    {
        try {
            $query = "INSERT INTO `user` (`user_id`, `user_firstname`, `user_lastname`, `user_mail`, `user_phone`, `user_password`, `user_favstation`) VALUES (null, :user_firstname, :user_lastname, :user_mail, :user_phone, :user_password, :user_favstation);";
            $user_id = null;
            $prepared_query = $connection->prepare($query);
            $prepared_query->bindParam(':user_firstname', $user_firstname, PDO::PARAM_STR);
            $prepared_query->bindParam(':user_lastname', $user_lastname, PDO::PARAM_STR);
            $prepared_query->bindParam(':user_mail', $user_mail, PDO::PARAM_STR);
            $prepared_query->bindParam(':user_phone', $user_phone, PDO::PARAM_STR);
            $prepared_query->bindParam(':user_password', $user_password, PDO::PARAM_STR);
            $prepared_query->bindParam(':user_favstation', $user_favstation, PDO::PARAM_STR);
            print_console($user_firstname);
            print_console($user_lastname);
            print_console($user_mail);
            print_console($user_phone);
            print_console($user_password);
            print_console($user_favstation);

            $result = $prepared_query->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        } catch (PDOException $i) {
            echo $i;
        }
    }
//
    function delete_user($connection, $user_id)
    {
        $query = "DELETE FROM `user` WHERE `user_id` = :user_id";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':user_id', $user_id);

        $executed = $prepared_query->execute();

        $result = $executed->fetchAll();

        return $result;
    }
//
    function update_user($connection, $user_firstname, $user_lastname, $user_mail, $user_phone, $user_password, $user_favstation, $user_id)
    {
        $query = "UPDATE `user` SET `user_firstname` = :user_firstname, `user_lastname` = :user_lastname, `user_mail`=:user_mail, `user_phone`=:user_phone, `user_password`=:user_password, `user_favstation`=:user_favstation WHERE `user_id`=:user_id;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $prepared_query->bindParam(':user_firstname', $user_firstname, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_lastname', $user_lastname, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_mail', $user_mail, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_phone', $user_phone, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_password', $user_password, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_favstation', $user_favstation, PDO::PARAM_STR);

        $result = $prepared_query->execute();

        return $result;
    }
//
    function get_users($connection)
    {
        $query = "SELECT * FROM `user`;";

        $prepared_query = $connection->prepare($query);

        $executed = $prepared_query->execute();

        $result = $prepared_query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
//
    function find_users($connection, $user_firstname, $user_lastname, $user_mail, $user_phone, $user_password, $user_favstation, $user_id)
    {
        $query = "SELECT * FROM `user` WHERE `user_firstname` = :user_firstname OR `user_lastname` = :user_lastname OR `user_mail`=:user_mail OR`user_phone`=:user_phone OR `user_password`=:user_password OR `user_favstation`=:user_favstation OR `user_id`=:user_id;";

        $prepared_query = $connection->prepare($query);

        if (is_null($user_firstname) || empty($user_firstname)) {
            $user_firstname = "%";
        }
        if (is_null($user_lastname) || empty($user_lastname)) {
            $user_lastname = "%";
        }
        if (is_null($user_mail) || empty($user_mail)) {
            $user_mail = "%";
            print_console($user_mail);
        }
        if (is_null($user_phone) || empty($user_phone)) {
            $user_phone = "%";
        }
        if (is_null($user_password) || empty($user_password)) {
            $user_password = "%";
        }
        if (is_null($user_favstation) || empty($user_favstation)) {
            $user_favstation = "%";
        }
        if (is_null($user_id) || empty($user_id)) {
            $user_id = "%";
        }
        $prepared_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $prepared_query->bindParam(':user_firstname', $user_firstname, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_lastname', $user_lastname, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_mail', $user_mail, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_phone', $user_phone, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_password', $user_password, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_favstation', $user_favstation, PDO::PARAM_STR);

        $executed = $prepared_query->execute();

        $result = $prepared_query->fetchAll(PDO::FETCH_ASSOC);

        print_r($result);
        return $result;
    }
//
    function check_mail_exists($connection, $user_mail)
    {
        $query = "SELECT * FROM `user` WHERE `user_mail`= :user_mail;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':user_mail', $user_mail);

        $executed = $prepared_query->execute();
        if ($prepared_query->rowCount()==0) {
            return $user_mail;
        } else {
            return false;
        }
    }
//
    function check_user_id_exists($connection, $user_id)
    {
        $query = "SELECT * FROM `user` WHERE `user_id`= :user_id;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':user_id', $user_id);

        $executed = $prepared_query->execute();
        if ($prepared_query->rowCount()>0) {
            return $user_id;
        } else {
            return false;
        }
    }
