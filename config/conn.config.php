<?php

Class DbConnect {

    protected $conn;

    public function __construct()
    {

        $this->conn = new mysqli(SURVERNAME, USERNAME, PASSWORD, DBNAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}

?>
