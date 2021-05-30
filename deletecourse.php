<html>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
 .del_but
 {
   margin: 5px;
 }
 form:hover{
   text-decoration: none;
 }
</style>
<?php
include"adminmenu.php";
include "databasehandler.php";

$sql = "SELECT * FROM course";
$result = $mysqli->query($sql);
 echo "<form name='form1' method='post'>";

  echo "<table class='table table-striped'>";
  echo "<tr>";

  echo '<td>Course ID </td>';
 echo '<td>Course Name </td>';
 echo '<td>Instructor </td>';
 echo '<td>Price </td>';
 echo '<td>Image path</td>';
    echo '<td>Delete </td>';
   echo "</tr>";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

   $iddel=$row['ID'];
   echo "<tr><td>" . $row['ID'] . "</td><td>" . $row['Name'] . "</td><td>" . $row['Instructor'] . "</td> <td>" . $row['Price'] . "</td> <td>" . $row['image'] . "</td> <td> <input type='checkbox' name='checkbox[]' value= $iddel</td> </tr>";

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

  $sql = "DELETE FROM course WHERE ID='$del_id'";
  $result = $mysqli->query($sql);


  }
  if ($mysqli->query($sql))
echo "<meta http-equiv=\"refresh\" content=\"0;URL=deletecourse.php\">";
}



$mysqli->close();
?>

</html>
