<?php
include("config.php");

if (!isset($_SESSION['valid'])) {
    // Handle unauthorized access
    echo "Unauthorized access";
    exit();
}

$id = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT balance FROM users WHERE id=$id");

if ($result = mysqli_fetch_assoc($query)) {
    $balance = $result['balance'];
    echo "$balance";
} else {
    // Handle case where user details are not found
    echo "Error: User details not found";
}
?>
