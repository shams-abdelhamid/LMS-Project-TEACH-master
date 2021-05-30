<?php
session_start();
if (!$_SESSION['firstname']) {
  header("Location: signin.php");
}
 ?>
<html>
<style>
 .del_but
 {
   margin: 5px;
 }
 form:hover{
   text-decoration: none;
 }
</style>
<link rel="stylesheet" href="static/master.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
.topnav a{
    width: 33.3333333333%;
}
</style>
<div class="navbar navbar-dark bg-dark">
<a class="navbar-brand" href="manageadmins.php">Add Admin</a>
<a class="navbar-brand" href="deleteadmin.php">Delete Admin</a>
<a class="navbar-brand" href="admin.php">Home</a>
<a class="navbar-brand" href="signout.php">Logout</a>
</div>
<?php
include "databasehandler.php";

$sql = "SELECT * FROM students WHERE type='2'";
$result = $mysqli->query($sql);
 echo "<form name='form1' method='post'>";

  echo "<table class='table table-striped'>";
  echo "<tr>";

    echo '<td>Admin ID </td>';
    echo '<td>First name Name </td>';
    echo '<td>Last name </td>';
    echo '<td>email </td>';
    echo '<td>Delete </td>';
  echo "</tr>";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

   $iddel=$row['id'];
   echo "<tr><td>" . $row['id'] . "</td><td>" . $row['firstname'] . "</td><td>" . $row['lastname'] . "</td> <td>" . $row['email'] . "</td> <td> <input type='checkbox' name='checkbox[]' value= $iddel</td> </tr>";

  }
  echo "</table>";
  echo "<input type='submit' name='delete' value='Delete selected courses' class='del_but'> ";

   echo"</form>";
} else {
  echo "0 results";
}
if($_SERVER["REQUEST_METHOD"]=="POST")
{

  $checkbox = $_POST['checkbox'];
 $c=count($checkbox);

for($i=0;$i<$c;$i++){
  $del_id = $checkbox[$i];

  $sql = "DELETE FROM students WHERE id='$del_id'";
  $result = $mysqli->query($sql);


  }
  if ($mysqli->query($sql))
echo "<meta http-equiv=\"refresh\" content=\"0;URL=deleteadmin.php\">";
}



$mysqli->close();
?>

</html>
