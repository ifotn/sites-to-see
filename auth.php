<?php
// check if user is authenticated; if not, redirect to login
if (empty($_SESSION['userId'])) {
    header('location:login.php');
    exit();
}
?>