
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

?>  
<div class="change-password">
    <span class="error-message"><?php include('message.php'); ?></span>
    <h2>Change Password</h2>
    <form action="includes/updateAcc.includes.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $userID;  ?>">
        <label for="current-password">Current Password</label>
        <input type="password" id="current-password" name="current_password" required>

        <label for="new-password">New Password</label>
        <input type="password" id="new-password" name="new_password" required>

        <label for="confirm-password">Confirm New Password</label>
        <input type="password" id="confirm-password" name="confirm_password" required>

        <button type="submit" name="update_password">Update Password</button>
    </form>
</div>