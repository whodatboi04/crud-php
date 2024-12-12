<?php

session_start();

include('assets/header.php');
include('assets/sidebar.php');
require_once 'config/updateAcc.config.php';

//Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$userID = $_SESSION['id'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$email = $_SESSION['email'];

?> 

<div class="update-container">
    <span class="error-message"><?php include('message.php'); ?></span>
    <h2>Update Profile</h2>
    <form action="includes/updateAcc.includes.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $userID;  ?>">
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo $firstname;  ?>" required>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo $lastname;  ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $email;  ?>" required>
        </div>
        <button type="submit" class="submit-btn" name="profile_update">Update</button>
    </form>
</div>