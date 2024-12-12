<?php
session_start();

include('assets/header.php');
include('assets/sidebar.php');
require_once 'config/addtask.config.php';

$userID = $_SESSION['id'];
$firstname = $_SESSION['firstname'];

//Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

//Fetch tasks
$taskHandler = new AddTask();
$tasks = $taskHandler->getAllTasks(); 

?>
<div class="container">
    <span><?php include('message.php'); ?></span>
    <span>Welcome, <?php echo htmlspecialchars($firstname); ?></span>
    <h1>Home Page</h1>

    <div class="todo-container">
        <h2>My To-Do List</h2>
        <form id="todo-form" method="POST" action="includes/addtask.includes.php">
            <input type="hidden" name="user_id" value="<?php echo $userID; ?>">
            <input type="text" name="todo" placeholder="Enter your task..." required>
            <button type="submit" name="addtask" class="btn btn-primary">Add Task</button>
        </form>
        <ul class="todo-list">
            <?php if (!empty($tasks)) : ?>
                <?php foreach ($tasks as $task) : ?>
                    <li>
                        <?php echo htmlspecialchars($task['todo']) ; ?>
                        <form class="icon-todo" method="POST" action="includes/userAction.includes.php">
                            <input type="hidden" name="taskId" value="<?php echo $task['task_id']; ?>">
                            <button class="mark-done" type="submit" name="done">
                                <i class="fa fa-check"></i>
                            </button>
                            <a class="mark-done"  href="viewTask.php?task_id=<?php echo $task['task_id']; ?>">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a class="edit-task" href="editTask.php?task_id=<?php echo $task['task_id']; ?>&task_name=<?php echo $task['todo']; ?>">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button class="delete-task" type="submit" name="trash">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </li>
                    <p><?php echo htmlspecialchars(date("m/d/Y h:i A", strtotime($task['created_at']))); ?></p>
                <?php endforeach; ?>
            <?php else : ?>
                <li>No tasks found</li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<?php require('assets/footer.php'); ?>
