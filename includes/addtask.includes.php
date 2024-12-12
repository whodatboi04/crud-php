<?php

require('../config/conn.php');
require_once('../config/addtask.config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['addtask'])) {
    $todo = $_POST['todo'];
    $userId = $_POST['user_id'];

    // Add the task
    $addtask = new AddTask();
    $addtask->addTask($todo, $userId);

    header('Location: ../home.php');
    exit();
}
