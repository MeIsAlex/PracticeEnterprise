<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once "classes/database.php";
    include_once "classes/customer.php";
    $db = new Database("pract_ent","webgebruiker","labo2019");
    $link=$db->get_link();
    if($link != false){
        if(isset($_POST['email'])){
            $customer = new Customer($link);
            $customer->__set("email",$_POST['email']);
        }
        else{
            die(json_encode(array("message"=>"missing argument: email","success"=>false)));
        }
        $json = $customer->read_one();
        if($json["firstname"] != null){
            echo(json_encode($json));
        }
        else{
            http_response_code(404);
            echo(json_encode(array("message" => "No products found.","success"=>false)));
        }
    }
    else{
        http_response_code(404);
        echo(json_encode(array("message" => "No connection with database.","success"=>false)));
    }
?>