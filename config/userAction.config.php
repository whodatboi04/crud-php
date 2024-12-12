<?php
require_once 'conn.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

class UserAction extends DbConnect{

    public function __construct() {
        parent::__construct();
    }

    //Mark Task as Done
    public function markDone($taskId) {
        $query = "UPDATE tasks SET status = 'done' WHERE task_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $taskId);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    //Show All Mark as Done list
    public function getDoneTasks() {
        $query = "SELECT * FROM tasks WHERE status = 'done'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $tasks[] = $row;
            }
            return $tasks;
        } else {            
            return [];
        }
    }

    //View Task
    public function viewTask($taskId) {
        $query = "SELECT * FROM tasks WHERE task_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $taskId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {            
            return null;
        }
    }

    //Undone Task
    public function markUndone($taskId) {
        $query = "UPDATE tasks SET status = 'active' WHERE task_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $taskId);
        $stmt->execute();
        $stmt->close();
        return true;
    }
    
    //Move to Trash
    public function moveToTrash($taskId) {
        $query = "UPDATE tasks SET status = 'inactive' WHERE task_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $taskId);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    //show all tasks in trash
    public function getTrashTasks() {
        $query = "SELECT * FROM tasks WHERE status = 'inactive'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $tasks[] = $row;
            }
            return $tasks;
        } else {            
            return [];
        }
    }

    //Edit Task 
    public function editTask($taskId, $taskName) {
        $query = "UPDATE tasks SET todo = ?, updated_at = NOW() WHERE task_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('si', $taskName, $taskId);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    //Delete Task Permanently
    public function deleteTask($taskId) {
        $query = "DELETE FROM tasks WHERE task_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $taskId);
        $stmt->execute();
        $stmt->close();
        return true;
    }

}
?>