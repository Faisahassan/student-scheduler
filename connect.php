<?php
/* Database credentials. Assuming you are running MySQL server with default setting (user 'root' with no password) */
define('DB_SERVER', 'rei.cs.ndsu.nodak.edu');
define('DB_USERNAME', 'keenan_kuntz_371s24');
define('DB_PASSWORD', 'KqQCJcEGyN0!');
define('DB_NAME', 'keenan_kuntz_db371s24');
 
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{

//echo("db is done");
}
?>
