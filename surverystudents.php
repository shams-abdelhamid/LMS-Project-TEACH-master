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

  $sql = "SELECT * FROM students WHERE type= 1 ";

$result = $mysqli->query($sql);
  echo "<table class='table table-striped'>";
  echo "<tr>";
   echo '<td> ID </td>';
  echo '<td>Name </td>';
  echo '<td>Role</td>';
  echo '<td>Profile</td>';
  echo '<td>Survey</td>';
  echo '<td>Survey results</td>';

   echo "</tr>";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {


    $updateid=$row['id'];
    if($row['type']==1)
  {
    $role='Student';
    $survey = "<a href='surveysent.php?id_update=$updateid'>Send survey</a>";

  }
  elseif ($row['type']==2)
  {
    $role='Admin';
    $survey ="";
    $results ="";
  }
  elseif ($row['type']==3)
  {
    $role='Auditor';
    $survey ="";
    $results ="";


  }
  elseif ($row['type']==4)
  {
    $role='HR';
    $survey ="";
    $results ="";


  }

	  echo "<tr><td>" . $row['id'] . "</td><td>" . $row['firstname']." ".$row['lastname'] . "</td><td>".$role. "</td> <td><a href='profile.php?id_update=$updateid'>View Profile</a> </td><td>".$survey."</td><td><a href='surveyresults.php?id_update=$updateid'>View Results</a> </td>  </tr>";
  }
   echo "</table>";
} else {
  echo "0 results";
}




$mysqli->close();
?>

</html>
