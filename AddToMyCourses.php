<?php
    include "databasehandler.php";
    session_start();
    $sql = "SELECT * FROM cart WHERE student_id='".$_SESSION["id"]."'";
    $result = mysqli_query($mysqli,$sql);

    while($row = mysqli_fetch_array($result)) {
      $sql1="INSERT INTO mycourses (student_id,course_id) VALUES('".$row[1]."','".$row[2]."')";
      $sql2="INSERT INTO groupchat (courseid,student_id) VALUES('".$row[2]."','".$row[1]."')";
      mysqli_query($mysqli,$sql1);
      mysqli_query($mysqli,$sql2);
    }

    $sql1 = "DELETE FROM cart WHERE student_id='".$_SESSION["id"]."'";
    mysqli_query($mysqli,$sql1);
?>
