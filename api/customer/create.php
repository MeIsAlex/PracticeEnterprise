<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once "classes/database.php";
    include_once "classes/customer.php";
    $db = new Database("localhost","project_mysql","webgebruiker","labo2019");
    $link=$db->get_link();
    if($link != false){
        if(isset($_POST["email"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["password"])){
            $cust = new Customer($link, $_POST["lastname"], $_POST["firstname"], $_POST["email"], $_POST["password"]);
            if($cust->create()){
                http_response_code(201);
                echo(json_encode(array("message" => "Successfully added customer.","succes"=>true)));        
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