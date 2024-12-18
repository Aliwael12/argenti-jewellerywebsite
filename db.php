<?php
session_start();

$error = '';

    $conn = new mysqli("localhost", "root", "", "argenti");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>
