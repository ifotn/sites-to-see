<?php
// access the current session
session_start();

// remove all session variables
session_unset();

// remove the session itself to log the user out
session_destroy();

// redirect to login
header('location:login.php');
?>