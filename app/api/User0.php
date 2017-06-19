<?php
$connection = new PDO('mysql:host=localhost;dbname=TrainAssist_db', 'root', '720153Mg7Jre');

    // function call_user_function($args)
    // {
    //     $method = upper($_SERVER[REQUEST_METHOD]);
    //     if($method == "POST"){
    //         $user_firstname = $args["user_firstname"];
    //         $user_lastname = $args["user_lastname"];
    //         $user_mail = $args["user_mail"];
    //         $user_password = $args["user_password"];
    //         $user_phone = $args["user_phone"];
    //         $user_favstation = $args["user_favstation"];
    //         $user_token = $args["user_token"];
    //         $user_token_time = $args["user_token_time"];
    //         create_user($user_firstname, $user_lastname, $user_mail, $user_password, $user_phone, $user_favstation, $user_token, $user_token_time);
    //     }elseif($method == "DELETE"){
    //         $user_id = $args["user_id"];
    //         delete_user($user_id);
    //     }elseif($method == "PUT"){
    //         $user_id = $args["user_id"];
    //         $user_firstname = $args["user_firstname"];
    //         $user_lastname = $args["user_lastname"];
    //         $user_mail = $args["user_mail"];
    //         $user_password = $args["user_password"];
    //         $user_token = $args["user_token"];
    //         $user_token_time = $args["user_token_time"];
    //         update_user($user_id, $user_firstname, $user_lastname, $user_mail, $user_password, $user_phone, $user_favstation, $user_token, $user_token_time);
    //     }else{
    //         echo "Erreur : Méthode non reconnue";
    //     }
    // }

    function create_user($user_firstname, $user_lastname, $user_mail, $user_password, $user_phone, $user_favstation, $user_token, $user_token_time)
    {
        $connection = new PDO('mysql:host=localhost;dbname=TrainAssist_db', 'root', '720153Mg7Jre');
        $query = "INSERT INTO `user`
        (`user_id`, `user_firstname`, `user_lastname`, `user_mail`,  `user_password`, `user_phone`, `user_favstation`, `user_token`, `user_token_time`)
        VALUES
        (:user_id, :user_firstname, :user_lastname, :user_mail, :user_password, :user_phone, :user_favstation, :user_token, :user_token_time);";
        $user_id = null;
        $prepared_query = $connection->prepare($query);
        $prepared_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $prepared_query->bindParam(':user_firstname', $user_firstname, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_lastname', $user_lastname, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_mail', $user_mail, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_phone', $user_phone, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_password', $user_password, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_favstation', $user_favstation, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_token', $user_token, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_token_time', $user_token_time, PDO::PARAM_STR);

        $executed = $prepared_query->execute();
    }

    function delete_user( $user_id)
    {
        $connection = new PDO('mysql:host=localhost;dbname=TrainAssist_db', 'root', '720153Mg7Jre');
        $query = "DELETE FROM `user` WHERE `user_id` = :user_id";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':user_id', $user_id);

        $executed = $prepared_query->execute();
    }

    function update_user($user_id, $user_firstname, $user_lastname, $user_mail, $user_password, $user_phone, $user_favstation, $user_token, $user_token_time)
    {
        $connection = new PDO('mysql:host=localhost;dbname=TrainAssist_db', 'root', '720153Mg7Jre');
        $query = "UPDATE `user` SET `user_firstname`=:user_firstname, `user_lastname`=:user_lastname, `user_mail`=:user_mail,  `user_password`=:user_password, `user_phone`=:user_phone, `user_favstation`=:user_favstation, `user_token`=:user_token, `user_token_time`=:user_token_time WHERE `user_id`=:user_id;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $prepared_query->bindParam(':user_firstname', $user_firstname, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_lastname', $user_lastname, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_mail', $user_mail, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_phone', $user_phone, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_password', $user_password, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_favstation', $user_favstation, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_token', $user_token, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_token_time', $user_token_time, PDO::PARAM_STR);

        $executed = $prepared_query->execute();
    }

    function get_users()
    {
        $connection = new PDO('mysql:host=localhost;dbname=TrainAssist_db', 'root', '720153Mg7Jre');
        $query = "SELECT * FROM `user`;";

        $prepared_query = $connection->prepare($query);

        $executed = $prepared_query->execute();

        $result = $prepared_query->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($result);
    }

    function find_users($user_id, $user_firstname, $user_lastname, $user_mail, $user_password, $user_phone, $user_favstation, $user_token, $user_token_time)
    {
        $connection = new PDO('mysql:host=localhost;dbname=TrainAssist_db', 'root', '720153Mg7Jre');

        $query = "SELECT * FROM `user` WHERE `user_id`=:user_id OR `user_firstname`=:user_firstname OR `user_lastname`=:user_lastname OR `user_mail`=:user_mail  OR `user_password`=:user_password OR `user_phone`=:user_phone OR `user_favstation`=:user_favstation OR `user_token`=:user_token OR `user_token_time`=:user_token_time;";

        $prepared_query = $connection->prepare($query);

        $prepared_query->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_firstname', $user_firstname, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_lastname', $user_lastname, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_mail', $user_mail, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_phone', $user_phone, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_password', $user_password, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_favstation', $user_favstation, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_token', $user_token, PDO::PARAM_STR);
        $prepared_query->bindParam(':user_token_time', $user_token_time, PDO::PARAM_STR);

        $executed = $prepared_query->execute();

        $result = $prepared_query->fetchAll(PDO::FETCH_ASSOC);

        return json_encode($result);
    }
