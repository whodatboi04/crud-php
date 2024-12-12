<?php

require_once 'conn.config.php';

class Register extends DbConnect{

    public function __construct()
    {
        parent::__construct();
    }

    public function registerUser($firstname, $lastname, $email, $password)
    {
        session_start();
        //Empty Input   
        if($this->emptyInput() == false){
            $_SESSION['message'] = "All fields are required.";
            header("Location: ../register.php");
            exit();
        }

        //Password Does not Match
        if($this->passwordMatch() == false){
            $_SESSION['message'] = "Passwords do not match.";
            header("Location: ../register.php");
            exit();
        }
        
        //Email user Exists
        if($this->emailExists() == true){
            $_SESSION['message'] = "Email already exists.";
            header("Location: ../register.php");
            exit();
        }
        
        //Password Must be atleast 8 characters
        if($this->passwordLength() == false){
            $_SESSION['message'] = "Password must be atleast 8 characters.";
            header("Location: ../register.php");
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');
        $stmt = $this->conn->prepare("INSERT INTO users (firstname, lastname, email, password, status, created_at) VALUES (?, ?, ?, ?, 'active', ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $hashed_password, $created_at);
        $stmt->execute();
        $stmt->close();
        header("Location: ../index.php");
    }

    //Validation Function
    private function emptyInput(){
        $result = false; 
        if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    //Password Validation Function
    private function passwordMatch(){
        $result = false;
        if ($_POST['password'] !== $_POST['confirm_password']) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    //Password Must be atleast 8 characters
    private function passwordLength(){
        $result = false;
        if (strlen($_POST['password']) < 8) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    //User Exists Function
    private function emailExists(){
        $result = false;
        $email = $_POST['email'];
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

}

?>