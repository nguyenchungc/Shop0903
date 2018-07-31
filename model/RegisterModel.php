<?php
include_once "DBConnect.php";
class RegisterModel extends DBConnect{

    function saveRegister($password,$email){
        $sql = "INSERT INTO users(password,email)
        VALUE ('$password','$email')";
        //echo $sql; die;
        $result = $this->executeQuery($sql);
        return $result ? $this->getLastId() : false;
    }

}

?>