<?php
// Start the session (if not already started)
session_start();

// Destroy the session data
session_destroy();

// Redirect to the login page or any other desired page
header("location: login.php"); // Replace "login.php" with the appropriate URL
exit;
?>