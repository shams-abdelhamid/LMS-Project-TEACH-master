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


  echo "<table class='table table-striped'>";
  echo "<tr>";
   echo '<td> ID </td>';
   echo '<td>Name </td>';
  echo '<td>Age </td>';
  echo '<td>Level</td>';
  echo '<td>College</td>';
  echo '<td>rateLms</td>';
  echo '<td>missing</td>';
  echo '<td>Recommend</td>';

   echo "</tr>";
$id_update=$_GET['id_update'];
$sql="SELECT * FROM students WHERE id= '".$id_update."'";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $updateid=$row['id'];
    $stdname=$row['firstname'] ." " . $row['lastname'];
    $sql1 = "SELECT * FROM survey";
    $result1 = $mysqli->query($sql1);
    if ($result1->num_rows > 0) {
      while($row1 = $result1->fetch_assoc()) {
        $age=$row1['age'];
        $level=$row1['level'];
        $college=$row1['college'];
        $rateLms=$row1['rateLms'];
        $missing=$row1['missing'];
        $recommend=$row1['recommend'];

        echo "<tr><td>" . $updateid . "</td><td>" . $stdname . "</td><td>".$age. "</td> <td>".$level. "</td> <td>".$college. "</td> <td>".$rateLms. "</td> <td>".$missing. "</td> <td>".$recommend. "</td> </tr>";
      }
    }








  }
   echo "</table>";
} else {
  echo "0 results";
}




$mysqli->close();
?>

</html>
