<?php
require_once 'conn.php';

class AddTask extends DbConnect {

    public function __construct() {
        parent::__construct(); // Call the parent constructor to connect to the DB
    }

    // Add Task to the database
    public function addTask($todo, $userId) {
        $query = "INSERT INTO tasks (todo, id, status, created_at) VALUES (?, ?, 'active', NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('si', $todo, $userId);
        $stmt->execute();
        $stmt->close();
    }

    //Get list
    public function getAllTasks() {
        $query = "SELECT * FROM tasks WHERE status = 'active' AND id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $_SESSION['id']);
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
}
