<?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
    require_once '../app/api/utils0.php';
    require_once '../app/api/User0.php';
    require_once '../app/api/Station0.php';
    //
    //
    function login()
    {
        if(isset($_REQUEST["mail"], $_REQUEST["password"])){
            $mail = $_REQUEST["mail"];
            $password = $_REQUEST["password"];
            $check_mail = check_mail($mail)&&check_mail_exists($mail);
            if($check_mail){
                $check_password = password_matches($mail,   $password);
                if($check_password){
                    // echo "password ok";
                    $user_id = get_user_id($mail);
                    update_token($user_id);
                    return true;
                }
            }
        }elseif(isset($_REQUEST["mail"], $_REQUEST["mdp"])){
            $mail = $_REQUEST["mail"];
            $password = $_REQUEST["mdp"];
            $check_mail = check_mail($mail)&&check_mail_exists($mail);
            if($check_mail){
                $check_password = password_matches($mail,   $password);
                if($check_password){
                    $user_id = get_user_id($mail);
                    update_token($user_id);
                    return true;
                }
            }
        }
        return false;
    }
    //
    function register()
    {
        echo "on enregistre";
        print_r($_SESSION);
        print_r($_REQUEST);
        if(isset($_REQUEST["prenom"],$_REQUEST["nom"],$_REQUEST["mail"],$_REQUEST["password"])){
            $user_firstname = $_REQUEST["prenom"];
            $user_lastname = $_REQUEST["nom"];
            $user_mail = $_REQUEST["mail"];
            $user_password= $_REQUEST["password"];
            if(isset($_REQUEST["station_id"])&&$_REQUEST["station_id"]!=""){
                if(check_station_exists($_REQUEST["station_id"])){
                    $user_favstation = $_REQUEST["station_id"];
                }else{
                    create_station($_REQUEST["station_id"], $_REQUEST["station_name"]);
                    $user_favstation = $_REQUEST["station_id"];
                }
            }else{
                $user_favstation = null;
            }
            if(isset($_REQUEST["phone"])){
                if(check_phone($_REQUEST["phone"])){
                    $user_phone = $_REQUEST["phone"];
                }else{
                    $user_phone = null;
                }
            }else{
                $user_phone = null;
            }
            $is_mail = check_mail($user_mail);
            $check_mail = check_mail_exists($user_mail);
            if($is_mail&&!$check_mail){
                $user_password = hash_password($user_password);
                $user_firstname = format_name($user_firstname);
                $user_lastname = format_name($user_lastname);
                $user_token = null;
                $user_token_time = null;
                print_r($_SESSION);
                if(isset($_SESSION["user_id"])){
                    update_user($_SESSION["user_id"], $user_firstname, $user_lastname, $user_mail, $user_password, $user_phone, $user_favstation, $user_token, $user_token_time);
                }else{
                    create_user($user_firstname, $user_lastname, $user_mail, $user_password, $user_phone, $user_favstation, $user_token, $user_token_time);
                }

                login();
            }else{
                $user =  json_decode(find_users($_SESSION["user_id"], "%", "%", "%", "%", "%", "%", "%", "%"), true)[0];
                $user_password = hash_password($user_password);
                $user_firstname = format_name($user_firstname);
                $user_lastname = format_name($user_lastname);
                update_user($_SESSION["user_id"], $user_firstname, $user_lastname, $user_mail, $user_password, $user_phone, $user_favstation, $user["user_token"], $user["user_token_time"]);
                update_token($_SESSION["user_id"]);
            }

        }
        // $user_firstname = format_name($_REQUEST["prenom"]);
        // $user_lastname = format_name($_REQUEST["nom"]);
        // $user_mail = check_mail(check_mail_exists( $_REQUEST["mail"]));
        // $user_phone = check_phone($_REQUEST["phone"]);
        // $user_password =  check_password($_REQUEST["password"]);
        // $user_favstation =  check_station_exists($_REQUEST["station_id"]);
        // if (!$user_favstation) {
        //     $user_favstation=null;
        // }
        // if ($user_firstname&&$user_lastname&&$user_mail&&$user_password) {
        //     create_user($user_firstname, $user_lastname, $user_mail, $user_phone, $user_password, $user_favstation);
        // }
    }
    //
    function check_mail_exists($user_mail)
    {
        if($user_mail){
            $user = json_decode(find_users("%", "%", "%", $user_mail, "%", "%", "%", "%", "%"), true)[0];
            if(array_key_exists("user_mail", $user)){
                return true;
            }else{
                return false;
            }
        }
    }

    function check_user_id_exists($user_id)
    {
        if($user_mail){
            $user = json_decode(find_users($user_id, "%", "%", "%", "%", "%", "%", "%", "%"), true)[0];
            if(array_key_exists("user_id", $user)){
                return true;
            }else{
                return false;
            }
        }
    }
    //
    function get_user_id($user_mail)
    {
        $user = json_decode(find_users("%", "%", "%", $user_mail, "%", "%", "%", "%", "%"), true)[0];
        return $user["user_id"];
    }

    function check_login($user_mail, $user_password)
    {
        $db_password = json_decode(find_users("%", "%", "%", $user_mail, "%", "%", "%", "%", "%"), true)[0]["user_password"];
        if($user_password == $db_password){
            return true;
        }else{
            return false;
        }
    }
    //
    function update_token($user_id)
    {
        $token = new_user_token();
        $time = time() + 300000;
        $_SESSION["user_id"] = $user_id;
        //$_SESSION["user_token"] = $token;
        setcookie("user_token" , $token, $time);
        $user = json_decode(find_users($user_id, "%", "%", "%", "%", "%", "%", "%", "%"), true)[0];
        update_user($user_id, $user["user_firstname"], $user["user_lastname"], $user["user_mail"], $user["user_password"], $user["user_phone"], $user["user_favstation"], $token, $time);
    }
    //
    function new_user_token()
    {
        return bin2hex(random_bytes(32)) ;
    }
    //
    function check_logged($user_id, $user_token)
    {
        $user = json_decode(find_users($user_id, "%", "%", "%", "%", "%", "%", "%", "%"), true)[0];
        $token_matches = ($user_token == $user["user_token"]);
        $current_time = time();
        $user_time = $user["user_token_time"];
        $time_difference = ($current_time-$user_time);
        if($token_matches){
            if(($time_difference<300000)){// if($time_matches){
                update_token($user_id);
                return true;
            }
        }
        return false;
    }
    //
    function password_matches($user_mail, $user_password)
    {
        $user = json_decode(find_users("%", "%", "%", $user_mail, "%", "%", "%", "%", "%"), true)[0];
        $db_password = $user["user_password"];
        $user_password = hash_password($user_password);
        if($user_password == $db_password){
            return true;
        }
        return false;
    }
    //
    function check_station_name_exists($station_name)
    {
        $station_id = "%";
        $station = json_decode(find_station($station_id, $station_name), true)[0];
        if(array_key_exists("station_name", $station)){
            return true;
        }else{
            return false;
        }
    }

    function check_station_exists($station_id)
    {
        $station_name = "%";
        $stations = json_decode(find_station($station_id, $station_name), true);
        if(count($stations)>0){
            $station = $stations[0];
        }else{
            return false;
        }
        if(array_key_exists("station_name", $station)){
            return true;
        }else{
            return false;
        }
    }

    function get_user_token($user_id){
        $user = json_decode(find_user($user_id, "%", "%", "%", "%", "%", "%", "%", "%"), true)[0];
        if(array_key_exists("user_token", $user)){
            return $user["user_token"];
        }else{
            return false;
        }
    }
 ?>
