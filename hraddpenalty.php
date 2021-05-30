<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php
include "adminnav.php";
include "databasehandler.php";

if (!$_SESSION['firstname']) {
  header("Location: signin.php");
}

 $sql = "SELECT * FROM students WHERE type= 2 ";
  $result = $mysqli->query($sql);

  echo "<table class='table table-striped'>";
  echo "<tr>";
  echo '<td> ID </td>';
  echo '<td>Name </td>';
  echo '<td>Current penalty </td>';
  echo '<td></td>';
   echo "</tr>";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    if ($row['penalty']=="")
     {
      $pen="None";
    }
    else {
      $pen=$row['penalty'];
    }
    $updateid=$row['id'];
    $updatename=$row['firstname'] . ' ' . $row['lastname'];

	  echo "<tr><td>" . $row['id'] . "</td><td>" . $row['firstname']." ".$row['lastname'] . "</td> <td>" . $pen . "</td> <td><a href='hrpenaltyform.php?id_update=$updateid'>Add/edit Penalty</a> </td>   </tr>";

  }
   echo "</table>";
} else {
  echo "0 results";
}




$mysqli->close();
?>

</html>
