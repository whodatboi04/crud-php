<?php

require('../config/conn.php');
require_once('../config/userAction.config.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

//Mark Task as Done
if(isset($_POST['done'])){

    $taskId = $_POST['taskId'];

    $userAction = new UserAction();
    $userAction->markDone($taskId);

    header('Location: ../home.php');
    exit();
}

//Edit Task
if(isset($_POST['edit_task'])){
    $taskID = $_POST['taskId'];
    $taskName = $_POST['task_name'];

    $userAction = new UserAction();
    $userAction->editTask($taskID, $taskName);

    header('Location: ../home.php');
    exit();
}

//Undone Task
if(isset($_POST['undone'])){

    $taskId = $_POST['taskId'];

    $userAction = new UserAction();
    $userAction->markUndone($taskId);

    header('Location: ../home.php');
    exit();
}

//Move to Trash
if(isset($_POST['trash'])){

    $taskId = $_POST['taskId'];

    $userAction = new UserAction();
    $userAction->moveToTrash($taskId);

    header('Location: ../trash.php');
    exit();
}

//Permanently Delete
if(isset($_POST['delete'])){

    $taskId = $_POST['taskId'];

    $userAction = new UserAction();
    $userAction->deleteTask($taskId);

    header('Location: ../trash.php');
    exit();
}

?>