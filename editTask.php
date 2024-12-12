<?php

session_start();

include('assets/header.php');
include('assets/sidebar.php');

//Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$taskID = $_GET['task_id'];
$taskName = $_GET['task_name'];
?>
<div class="edit-container">
    <h1>Edit Task</h1>
    <form method="POST" action="includes/userAction.includes.php">
        <input type="hidden" name="taskId" value="<?php echo $taskID; ?>">
        <label for="task_name">Task Name:</label>
        <input type="text" id="task_name" name="task_name" value="<?php echo $taskName; ?>" required>
        <button type="submit" name="edit_task">Save Changes</button>
    </form>
</div>
