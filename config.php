<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', '172.26.6.170');
define('DB_USERNAME', 'bitnami');
define('DB_PASSWORD', 'password194');
define('DB_NAME', 'Usersinfo');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect('3.130.151.29', 'bitnami', 'password194', 'User_Data');
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
