<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</html>
<?php
include "databasehandler.php";
include "adminnav.php";


if(isset($_GET['id_update']))
{

 $upid=$_GET['id_update'];

$sql="INSERT INTO survey (id) VALUES ('".$upid."')";
if (mysqli_query($mysqli,$sql))
{
  $msg="Survey was sent successfully.";
}
else {
    $msg= "Something went wrong. Survey was not sent successfully.";
}

echo $msg;
}

?>