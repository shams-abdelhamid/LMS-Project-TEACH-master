<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style media="screen">
.cell-breakWord {
 word-wrap: break-word;
 max-width: 1px;
}
</style>
<?php
include "adminnav.php";
include "databasehandler.php";

if (!$_SESSION['firstname']) {
  header("Location: signin.php");
}
  $sql = "SELECT * FROM coursesuggestion";

$result = $mysqli->query($sql);
  echo "<table class='table table-striped' style=\"text-align: center;\">";
  echo "<tr>";
   echo '<td> ID </td>';
  echo '<td>Name </td>';
  echo '<td>Link</td>';
  echo '<td>Image</td>';
  echo '<td>Chat</td>';
  echo '<td>Action</td>';
   echo "</tr>";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $courseid=$row['id'];
    $student_id=$row['student_id'];
    $name = $row['name'];
    $link = $row['link'];
    $image = $row['image'];
    $photopath="images/$image";
    $isapproved =$row['is_approved'];

      echo "<tr><td>" . $student_id . "</td><td>" . $name . "</td><td class=\"cell-breakWord\">".$link. "</td><td>" . '<img src="'.$photopath.'" alt="" width="250" align-content="center" class="img-fluid rounded shadow-sm"/>' . "</td><td><a href='chat.php?std_id=$student_id'>Respond</a> </td><td><button type=\"button\" id=\"approve\"class=\"btn btn-success\" data-id =".$isapproved." data-stdid=".$student_id." data-crsid=".$courseid."
      data-crsname=".$name." data-crslink=".$link.">Approve Request</button> <button type=\"button\" id=\"deny\" data-id =".$isapproved." data-stdid=".$student_id." class=\"btn btn-danger\" data-crsid=".$courseid." data-crsname=".$name." data-crslink=".$link.">Deny Request</button> </td>   </tr>";
  }
   echo "</table>";
} else {
  echo "0 results";
}






$mysqli->close();
?>
<script type="text/javascript">
var x = document.getElementsByClassName("btn btn-success");
var y = document.getElementsByClassName("btn btn-danger");
var app=document.getElementById("approve");
var deny=document.getElementById("deny");
var approve=0;
var numComments = x.length;
  for (var i = 0; i < numComments; i++) {
    console.log(x[i].dataset.id);
    if(x[i].dataset.id==1){
      x[i].innerHTML = "Request Approved";
      y[i].style.display="none";
    }
    else if(y[i].dataset.id==-1){
      y[i].innerHTML = "Request Denied";
      x[i].style.display="none";
    }else {
      x[i].addEventListener("click", function() {
        approve=1;
        console.log(this.dataset.crsid);
        this.innerHTML = "Request Approved";
        deny.style.display="none";
        jQuery.ajax({
                type: "POST",
                url: "SuggestionResponse.php",
                data: {student_id:this.dataset.stdid,respond:approve,courseid:this.dataset.crsid,coursename:this.dataset.crsname,courselink:this.dataset.crslink}
              })
      });

      y[i].addEventListener("click", function() {
        approve=-1;
        console.log(this.dataset.crsid);
        this.innerHTML = "Request Denied";
        app.style.display="none";
        jQuery.ajax({
                type: "POST",
                url: "SuggestionResponse.php",
                data: {student_id:this.dataset.stdid,respond:approve,courseid:this.dataset.crsid,coursename:this.dataset.crsname,courselink:this.dataset.crslink}
            })
      });
    }

  }
</script>
</html>
