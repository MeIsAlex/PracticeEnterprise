<?php
//class customer
class Customer {
    private $id;
    private $lastname;
    private $firstname;
    private $email;
    private $conn;

    public function __construct($connection="") {
        $this->conn = $connection;
    }

    public function __set($name, $value)
    {
        $val = mysqli_escape_string($this->conn,$value);
        switch($name){
            case "id":
            $this->id=$val;
            break;
            case "lastname":
            $this->lastname=$val;
            break;
            case "firstname":
            $this->firstname=$val;
            break;
            case 'email':
            $this->email=$val;
            break;
        }
    }

    public function __get($name)
    {
        switch($name){
            case 'id':
            return $this->id;
            break;
            case 'lastname':
            return $this->lastname;
            break;
            case 'firstname':
            return $this->firstname;
            break;
            case 'email':
            return $this->email;
            break;
        }
    }

    public function read_one() {
        $query = "SELECT * FROM customer WHERE email='".$this->email."'";
        $val = mysqli_query($this->conn,$query);
        $row = mysqli_fetch_array($val);
        extract($row);
        $res = array(
            "id"=>$id,
            "lastname"=>$lastname,
            "firstname"=>$firstname,
            "email"=>$email,
            "password" => $pass);
        return $res;
    }


    public function read_all() {
        $query = "SELECT * from customer";
        $val = mysqli_query($this->conn,$query);
        return $val;
    }

}
?>