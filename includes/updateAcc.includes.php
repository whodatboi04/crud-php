<?php
include('../config/conn.php');
include('../config/updateAcc.config.php');

require('../config/conn.php');
require_once('../config/updateAcc.config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

//Update User Profile
if(isset($_POST['profile_update'])){
    $userID = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    $userAction = new UpdateAccount();
    $userAction->updateProfile($userID, $firstname, $lastname, $email);

}

//Change User Password
if(isset($_POST['update_password'])){
    $userID = $_POST['id'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $userAction = new UpdateAccount();
    $userAction->changePassword($userID, $currentPassword, $newPassword);
}

?>