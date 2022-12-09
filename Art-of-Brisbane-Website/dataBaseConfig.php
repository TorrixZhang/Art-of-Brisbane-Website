<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'test1');
define('DB_PASSWORD', 'test1');
define('DB_NAME', 'publicArts');
 
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>