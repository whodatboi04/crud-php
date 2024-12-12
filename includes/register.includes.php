<?php 

require('../config/conn.php');
require_once('../config/register.config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);   

if(isset($_POST['submit'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    //Class Function 
    $register = new Register();
    $register->registerUser($firstname, $lastname, $email, $password);

}

?>