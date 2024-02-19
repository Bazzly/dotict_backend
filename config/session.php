<?php
// Start the session
session_start();

// Check if the user is logged in, otherwise, redirect to the login page
if (!isset($_SESSION['data'])) {
    header("Location: login.php");
    exit();
}
?>