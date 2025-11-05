<?php
$servername = "localhost";  // Default for XAMPP
$username   = "root";       // Default MySQL username in XAMPP
$password   = "";           // Leave empty (default in XAMPP)
$dbname     = "fashion";  // <-- Replace with your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Uncomment to confirm connection
// echo "Connected successfully";
?>
