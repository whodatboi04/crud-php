<?php

define('SURVERNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DBNAME', 'crud_db');

include_once 'conn.config.php';
$db = new DbConnect();
date_default_timezone_set('Asia/Manila');
?>