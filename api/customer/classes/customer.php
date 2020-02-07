<?php
//class customer
class Customer {
    private $lastname;
    private $firstname;
    private $email;
    private $password;
    private $conn;

    public function __construct($connection="",$lastname="",$firstname="",$email="",$pass="") {
        $this->conn = $connection;
        $this->lastname = mysqli_escape_string($this->conn,$lastname);
        $this->firstname = mysqli_escape_string($this->conn,$firstname);
        $this->email = mysqli_escape_string($this->conn,$email);
        $this->password = mysqli_escape_string($this->conn,$pass);
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
        if($row != null){
            extract($row);
            $res = array(
                "id"=>$id,
                "lastname"=>$lastname,
                "firstname"=>$firstname,
                "email"=>$email,
                "password" => $pass);
        }
        else{
            $res=null;
        }
        return $res;
    }


    public function read_all() {
        $query = "SELECT * from customer";
        $val = mysqli_query($this->conn,$query);
        return $val;
    }
    public function create() {
        $query = "INSERT INTO customer (firstname,lastname,email,pass) VALUES ('".$this->firstname."','".$this->lastname."','".$this->email."','".$this->password."')";
        $val = mysqli_query($this->conn,$query);
        return $val;
    }

}
?>