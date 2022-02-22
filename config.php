<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'bitnami');
// define('DB_PASSWORD', 'password194');
// define('DB_NAME', 'Usersinfo');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect('ls-336b81bab071ebb8e843329caf50c3e20df54d82.cr2wibycqrus.us-east-2.rds.amazonaws.com', 'dbmasteruser', 'password194', 'User_Data');
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
