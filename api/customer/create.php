<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once "classes/database.php";
    include_once "classes/customer.php";
    $db = new Database("pract_ent","webgebruiker","labo2019");
    $link=$db->get_link();
    if($link != false){
        if(isset($_POST["email"]) 
        && isset($_POST["firstname"]) 
        && isset($_POST["lastname"]) 
        && isset($_POST["password"])){
            if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
                die(json_encode(array("message"=>"email not valid", "success"=>false)));
            }
            $cust = new Customer($link, $_POST["lastname"], $_POST["firstname"], $_POST["email"], $_POST["password"]);
            if($cust->create()){
                http_response_code(201);
                echo(json_encode(array("message" => "Successfully added customer.","success"=>true)));        
            }
            else{
                http_response_code(503);
                echo(json_encode(array("message" => "Failed to add customer.","success"=>false)));
            }
        }
        else{
            http_response_code(400);
            echo(json_encode(array("message" => "Failed to add customer, data incomplete.","success"=>false)));
        }
    }
    else{
        http_response_code(404);
        echo(json_encode(array("message" => "No connection with database.","success"=>false)));
    }
?>