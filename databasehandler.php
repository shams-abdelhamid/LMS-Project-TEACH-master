
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";



$mysqli = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($mysqli->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

?>
