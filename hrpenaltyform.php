<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="functions/photoscript.js"></script>
<?php
include "databasehandler.php";
include"adminnav.php";
if(isset($_GET['id_update']))
{

 $upid=$_GET['id_update'];
 $sql = "SELECT * FROM students where ID='$upid'";
 $result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    if ($row['penalty']=="")
     {
      $pen="None";
    }

    else {
      $pen=$row["penalty"];
    }
  }

}
else {
  echo "0 results";
}
}

echo "<h6 style='margin:7px'>Current penalty status :</h6>";
echo "<form action='hrpenaltyform.php?id_update=$upid' method='POST' enctype='multipart/form-data' class='form-inline'>";
echo "<input type='text' name='penfield' value='$pen' class='form-control' style='width:auto; margin:5px;'>";
echo "<input type='submit' name='subbuton'value='Save information' class='btn btn-primary'>";
echo "</form>";

if(isset ($_POST['penfield']))
{

   $newpen=$_POST['penfield'];
   $sql1 = "UPDATE students SET penalty='$newpen' WHERE Id='$upid'";

   if ($mysqli->query($sql1) === TRUE) {
     echo '<script> alert("Sucess,penalty information updated !")
     window.location = window.location.href
     </script>';
   } else {
     echo "Error: " . $sql1 . "<br>" . $mysqli->error;
   }
 }


?>
