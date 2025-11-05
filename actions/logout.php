<?php
session_start(); // Start the session
// Unset all session variables
session_unset();
// Destroy the session completely
session_destroy();
// Optionally, redirect to login page or homepage
header("Location: ../index.php");
exit();
?>
