<?php
    include "databasehandler.php";
session_start();
$courseid=$_POST['courseid'];
$coursename1=$_POST['coursename'];
$courselink1=$_POST['courselink'];
$studentid=$_POST['student_id'];
$adminid=$_SESSION['id'];
if ($_POST['respond'] == 1) {
  $message="Your course Suggestion has been approved. <br> Course name: $coursename1 <br> Course link: $courselink1";
  $sql ="UPDATE coursesuggestion SET is_approved=1 WHERE id = '".$courseid."'";
  $result = mysqli_query($mysqli,$sql);
  $sql1= "INSERT INTO chat_message (to_user_id,from_user_id,chat_message,status) VALUES('".$studentid."','".$adminid."','".$message."','1')";
  mysqli_query($mysqli,$sql1);
}
else if ($_POST['respond'] == -1) {
  $message="Your course Suggestion has been Denied. <br> Course name: $coursename1 <br> Course link: $courselink1";
  $sql ="UPDATE coursesuggestion SET is_approved=-1 WHERE id = '".$courseid."'";
  $result = mysqli_query($mysqli,$sql);
  $sql1= "INSERT INTO chat_message (to_user_id,from_user_id,chat_message,status) VALUES('".$hrid."','".$adminid."','".$message."','1')";
  mysqli_query($mysqli,$sql1);
}


?>
