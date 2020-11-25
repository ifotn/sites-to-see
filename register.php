<?php require('header.php'); ?>
<main class="container">
    <h1>User Registration</h1>
    <form method="post" action="save-registration.php">
        <fieldset class="form-group">
            <label for="username" class="col-md-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-md-2">Password:</label>
            <input name="password" id="password" required type="password" 
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <fieldset class="form-group">
            <label for="confirm" class="col-md-2">Confirm Password:</label>
            <input name="confirm" id="confirm" required type="password"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <div class="offset-md-2">
            <button class="btn btn-primary">Register</button>
        </div>        
    </form>
</main>
<?php require('footer.php'); ?>)