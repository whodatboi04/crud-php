<?php

session_start();
include('assets/header.php');


?>

<div class="container" id="login-container">
<span class="error-message"><?php include('message.php'); ?></span>
  <h2>Login</h2>
  <form action="includes/login.includes.php" method="POST">
    <div class="form-group">
      <label for="login-email">Email</label>
      <input type="text" id="login-email" name="email">
    </div>
    <div class="form-group">
      <label for="login-password">Password</label>
      <input type="password" id="login-password" name="password" >
    </div>
    <button type="submit" name="submit" class="btn">Login</button>
    <a class="toggle-btn" href="register.php">Don't have an account? Register</a>
  </form>
</div>
