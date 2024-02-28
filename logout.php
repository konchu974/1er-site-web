<?php
// Initialize the session
session_start();

// Unset all session variables
$_SESSION = array();

session_unset();

// Finally, destroy the session
session_destroy();

// Redirect to login page
header("Location: index.html");
exit;
?>