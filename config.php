<?php
$hostname = "localhost"; // Your MySQL server hostname
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "grip_bank"; // Your MySQL database name

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

$id = $_SESSION['id'];
?>
