<?php
// db_connection.php

$host = 'localhost';
$db = 'sitevetdb';    // Replace with your database name
$user = 'root';        // Replace with your database username
$pass = 'root';            // Replace with your database password

// Establishing a connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

