<?php
// 1. store the login form inputs into variables
$username = $_POST['username'];
$password = $_POST['password'];

// 2. connect to the database
require('db.php');

// 3. set up & execute the SQL query to check if these credentials exist
$sql = "SELECT userId, password FROM users WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$user = $cmd->fetch();

// 4. if the login is invalid, redirect user back to login with a message
if (!password_verify($password, $user['password'])) {
    header('location:login.php?invalid=true');
    exit();
}
else {
    // 5. store the user's identity in the Session object, then redirect to the my-sites page
    $db = null;

    session_start();
    $_SESSION['userId'] = $user['userId'];
    $_SESSION['username'] = $username;

    header('location:my-sites.php');
}
?>