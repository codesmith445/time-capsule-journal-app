<?php
session_start();
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

// Redirect to login page or home page
header("Location: login.php"); // Change to the path of your login page
exit();
?>