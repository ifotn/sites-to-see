<?php require('header.php'); 
require('auth.php');
?>

<main class="full">
    <h1>My Sites</h1>
    <?php 
    // 1. connect to the db
    require('db.php'); 

    // 2. set up SQL query to fetch site data from the database
    $sql = "SELECT * FROM sites ORDER BY name";

    // 3. execute the query
    $cmd = $db->prepare($sql);
    $cmd->execute();

    // 4. Use the fetchAll() method of the PDO Command variable to store the data into a variable called $sites.  
    $sites = $cmd->fetchAll();

    // 5. Create a grid with a header row
    echo '<table class="table table-striped table-hover sortable"><thead><th>Name</th><th>
        Location</th>
        <th>Photo</th><th>Attribution</th></thead>';

    // 5. Use a foreach loop to iterate (cycle) through all the values in the $artists variable.  Inside this loop, use an echo command to display the name of each person.  See https://www.php.net/manual/en/control-structures.foreach.php for details.
    foreach ($sites as $site) {
        // could use this but it's unclear and error prone: echo $value[1];
        echo '<tr>
            <td>' . $site['name'] . '</td>
            <td>' . $site['location'] . '</td>
            <td><img src="' . $site['photo'] . '" class="thumb" /></td>
            <td>' . $site['attribution'] . '</td>
            </tr>';
    }

    // 7. End the HTML table
    echo '</table>';

    // 8. Disconnect from the database
    $db = null;
    ?>
</main>
<footer class="floating-footer text-white-50">
    <div class="container text-center">
        <small>Copyright &copy; <?php echo date("Y"); ?>  | <a href="https://github.com/ifotn/sites-to-see" alt="View on GitHub">View Source Code</a></small>
    </div>
</footer>
</body>
</html>