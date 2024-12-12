<?php

session_start();

include('assets/header.php');
include('assets/sidebar.php');
require_once 'config/userAction.config.php';

//Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$taskHandler = new UserAction();
$tasks = $taskHandler->getTrashTasks();

?>

<div class="trash-container">
    <span>
        <h1>Trash</h1>
    </span>
    <div class="trash-table">
        <?php if (!empty($tasks)) : ?>
            <table border="1" cellspacing="0" cellpadding="5">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task) : ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($task['todo']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($task['created_at']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($task['status']); ?>
                            </td>
                            <td>
                                <form class="icon-todo" method="POST" action="includes/userAction.includes.php">
                                    <input type="hidden" name="taskId" value="<?php echo $task['task_id']; ?>">
                                    <button class="mark-done" type="submit" name="undone">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </button>
                                    <button class="edit-task"><i class="fa fa-edit"></i></button>
                                    <button class="delete-task" type="submit" name="delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No tasks found.</p>
        <?php endif; ?>
    </div>
</div>
<?php require('assets/footer.php'); ?>