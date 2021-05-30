<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php
include"adminmenu.php";
include "databasehandler.php";

$sql = "SELECT * FROM course";
$result = $mysqli->query($sql);
  echo "<table class='table table-striped'>";
  echo "<tr>";
   echo '<td>Course ID </td>';
  echo '<td>Course Name </td>';
  echo '<td>Instructor </td>';
  echo '<td>Price </td>';
  echo '<td>Image path</td>';
   echo "</tr>";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {



	  echo "<tr><td>" . $row['ID'] . "</td><td>" . $row['Name'] . "</td><td>" . $row['Instructor'] . "</td><td>" . $row['Price'] . "</td> <td>" . $row['image'] . "</td></tr>";

  }
   echo "</table>";
} else {
  echo "0 results";
}
$mysqli->close();
?>






</html>
