<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once "classes/database.php";
    include_once "classes/customer.php";
    $db = new Database("localhost","project_mysql","webgebruiker","labo2019");
    $link=$db->get_link();
    if($link != false){
        $customer = new Customer($link);
        $values = $customer->read_all();
        $rowcount=mysqli_num_rows($values);
        if($rowcount > 0){
            $cust_array = array();
            $cust_array["customers"] = array();
            while($cust = mysqli_fetch_array($values)){
                extract($cust);
                $res = array(
                "id"=>$id,
                "lastname"=>$lastname,
                "firstname"=>$firstname,
                "email"=>$email,
                "password"=>$pass);
                array_push($cust_array["customers"],$res);
            }
            http_response_code(200);
            $cust_array["success"] = "true";
            echo(json_encode($cust_array));
        }
        else{
            http_response_code(404);
            echo(json_encode(array("message" => "No products found.","success" => "false")));
        }
    }
    else{
        http_response_code(404);
        echo(json_encode(array("message" => "No connection with database.","success" => "false")));
    }
?>