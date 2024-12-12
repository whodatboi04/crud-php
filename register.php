<?php
session_start();
include('assets/header.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);   
?>

<!-- Register Account -->
<div class="container" id="register-container">
    <span class="error-message"><?php include('message.php'); ?></span>
    <h2>Register</h2>
    <form action="includes/register.includes.php" method="POST">
        <div class="form-group">
        <label for="register-firstname">First Name</label>
        <input type="text" id="firstname" name="firstname" >
        </div>
        <div class="form-group">
        <label for="register-lastname">Last Name</label>
        <input type="text" id="lastname" name="lastname" >
        </div>
        <div class="form-group">
        <label for="register-email">Email</label>
        <input type="email" id="email" name="email" >
        </div>
        <div class="form-group">
        <label for="register-pwd">Password</label>
        <input type="password" id="password" name="password" >
        </div>
        <div class="form-group">
        <label for="register-c_pwd">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" >
        </div>
        <button type="submit" name="submit" class="btn">Register</button>
        <a class="toggle-btn" href="index.php">Already have an account? Login</a>
    </form>
</div>
