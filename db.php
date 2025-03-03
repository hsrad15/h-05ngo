<?php
$servername = "localhost";  // Change if using a remote server
$username = "root";         // Default username for XAMPP
$password = "";             // Default password for XAMPP (leave empty)
$dbname = "data_system";    // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
