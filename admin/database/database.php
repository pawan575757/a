<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u346044215_property');
define('DB_PASSWORD', '192118sS@');
define('DB_NAME', 'u346044215_property');
 
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if(!$conn){
		echo "Error in connection...";
		exit;
	}
?>

