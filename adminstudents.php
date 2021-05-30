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
if($_SESSION['type'] == 2){
  $sql = "SELECT * FROM students WHERE type= 1 OR type=2";
}
else if($_SESSION['type'] == 3){
  $sql = "SELECT * FROM students WHERE type=2";
}
else {
  $sql = "SELECT * FROM students";
}
$result = $mysqli->query($sql);
  echo "<table class='table table-striped'>";
  echo "<tr>";
   echo '<td> ID </td>';
  echo '<td>Name </td>';
  echo '<td>Role</td>';
  echo '<td>Profile</td>';
  echo '<td>Logs</td>';
   echo "</tr>";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $updateid=$row['id'];
    $updatename=$row['firstname']. ' '. $row['lastname'];
    $updatefnname = $row['firstname'];
    $updatelnname = $row['lastname'];
    if($row['type']==1)
  {
    $role='Student';

  }
  elseif ($row['type']==2)
  {
    $role='Admin';
  }
  elseif ($row['type']==3)
  {
    $role='Auditor';
  }
  elseif ($row['type']==4)
  {
    $role='HR';
  }

    if($_SESSION['type'] == 3){
      echo "<tr><td>" . $row['id'] . "</td><td>" . $row['firstname']." ".$row['lastname'] . "</td><td>".$role. "</td> <td><a href='profile.php?id_update=$updateid'>View Profile</a> </td><td><a href='adminchat.php?id_update=$updateid&update_name=$updatename'>Chat log</a> </td><td><button type=\"button\" class=\"btn btn-danger\" data-id=".$updateid." data-fnname=".$updatefnname." data-lnname=".$updatelnname.">Request Investigation</button> </td>   </tr>";
    }
    else {
      echo "<tr><td>" . $row['id'] . "</td><td>" . $row['firstname']." ".$row['lastname'] . "</td><td>".$role. "</td> <td><a href='profile.php?id_update=$updateid'>View Profile</a> </td><td><a href='adminchat.php?id_update=$updateid&update_name=$updatename'>Chat log</a> </td>   </tr>";
    }


  }
   echo "</table>";
} else {
  echo "0 results";
}






$mysqli->close();
?>
<script type="text/javascript">
var x = document.getElementsByClassName("btn btn-danger");
var numComments = x.length;
  for (var i = 0; i < numComments; i++) {
      x[i].addEventListener("click", function() {
        console.log(this.dataset.fnname);
        console.log(this.dataset.lnname);
        this.innerHTML = "Request Sent";
        this.style.background="#00ff7f";
        jQuery.ajax({
                type: "POST",
                url: "SendRequest.php",
                data: {admin_id:this.dataset.id,admin_fnname:this.dataset.fnname, admin_lnname: this.dataset.lnname }
            }
        );
      });
  }
</script>
</html>
