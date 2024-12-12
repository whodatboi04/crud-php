<?php

session_start();

include('assets/header.php');
include('assets/sidebar.php');

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

<div class="profile-container">
    <span class="success-message"><?php include('message.php'); ?></span>
    <div class="profile-header">
        <div class="user-info">
            <h1><?php echo $firstname . ' ' . $lastname; ?></h1>
            <p><?php echo $email; ?></p>    
        </div>
    </div>

    <div class="profile-sections">

        <div class="profile-section">
            <h2>Recent Activities</h2>
            <ul>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </li>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </li>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </li>
            </ul>
        </div>

        <div class="profile-section">
            <h2>Settings</h2>
            <p><a href="change-password.php">Change Password</a></p>
            <p><a href="update-profile.php">Update Profile Picture</a></p>
        </div>
    </div>
</div>
<?php require('assets/footer.php'); ?>