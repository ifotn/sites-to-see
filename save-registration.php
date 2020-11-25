<?php require('header.php'); ?>

<main class="container">
    <h1>User Registration</h1>
    <?php
    // 1. store the user's form inputs in variables
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $ok = true;
    $errMsg = "";

    // 2. validate the inputs
    if (empty($username)) {
        $ok = false;
        $errMsg = "Username is required<br />";
    }

    if (empty($password)) {
        $ok = false;
        $errMsg .= "Password is required<br />";
    }

    if ($password != $confirm) {
        $ok = false;
        $errMsg .= "Passwords do not match<br />";
    }

    // 3. if the inputs are invalid, show descriptive error
    if ($ok == false) {
        echo '<div class="alert alert-danger">' . $errMsg . '</div>';
        echo '<a href="javascript:history.go(-1);"><< Back</a>';
    }
    else {
        // 4. if inputs are valid, connect to the database
        require('db.php');

        // 4a. check username doesn't already exist
        $sql = "SELECT * FROM users WHERE username = :username";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->execute();
        $user = $cmd->fetch();

        if (!empty($user)) {
            echo '<div class="alert alert-danger">Username already exists</div>';
            echo '<a href="javascript:history.go(-1);"><< Back</a>';
        }
        else {
            // 5. set up the SQL INSERT command
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $cmd->bindParam(':password', $passwordHash, PDO::PARAM_STR, 255);

            // 6. execute the insert to save the new user
            $cmd->execute();

            // 7. show confirmation message
            echo '<div class="alert alert-success">User Saved Successfully</div>';
            echo '<a href="login.php">Click to Login</a>';
        }        

        // 8. disconnect from the database
        $db = null;
    }
    ?>
</main>

<?php require('footer.php'); ?>