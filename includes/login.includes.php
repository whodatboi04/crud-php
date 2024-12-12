<?php
require('../config/conn.php');
require('../config/login.config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = new Login();
    $login->loginUser($email, $password);
}

?>