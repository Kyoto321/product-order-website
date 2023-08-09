
<?php
// start session
    session_start();

    define('SITEURL', 'http://localhost/food-design-restaurant/');

/*
// create a constant to store non-repeating values
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-design-restuarant');

// execute query and save data in database

    $conn = mysqli_connect('LOCALHOST', 'DB_USERNAME', 'DB_PASSWORD') or die(mysqli_connect_error());     //database connection
    $db_select = mysqli_select_db($conn, 'DB_NAME') or die(mysqli_connect_error());   //selecting the database

*/

    // execute query and save data in database
    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_connect_error());     //database connection
    $db_select = mysqli_select_db($conn, 'food-design-restuarant') or die(mysqli_connect_error());   //selecting the database

?>