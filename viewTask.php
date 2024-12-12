<?php
session_start();

include('assets/header.php');
include('assets/sidebar.php');
require_once 'config/userAction.config.php';


if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

if(isset($_GET['task_id'])) {
    $taskId = $_GET['task_id'];

    $userAction = new UserAction();
    $task = $userAction->viewTask($taskId);

}

?>

<div class="view-container">
    <h1>Task Details</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Task ID</th>
            <td><?php echo htmlspecialchars($task['task_id']); ?></td>
        </tr>
        <tr>
            <th>Task Name</th>
            <td><?php echo htmlspecialchars($task['todo']); ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?php echo htmlspecialchars($task['status']);  ?></td>
        </tr>
        <tr>
            <th>Created At</th>
            <td><?php echo htmlspecialchars(date("m/d/Y h:i A", strtotime($task['created_at']))); ?></td>
        </tr>
        <tr>
            <th>Updated At</th>
            <td>
                <?php 
                    if (!empty($task['updated_at'])) {
                        echo htmlspecialchars(date("m/d/Y h:i A", strtotime($task['updated_at'])));
                    } else {
                        echo "Not updated yet";
                    }
                ?>
            </td>
        </tr>
    </table>
    <a href="home.php" class="back-button">Back to Task List</a>
</div>