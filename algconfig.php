<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'alg');

// Try connecting to the Database
$conn = mysqli_connect("localhost", "root", "", "alg");

//Check the connection
if($conn == false){
    die('Error: Cannot connect');   
}
?>



